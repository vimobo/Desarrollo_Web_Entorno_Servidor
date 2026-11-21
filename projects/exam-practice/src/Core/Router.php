<?php

namespace Core;

use Controllers\ErrorController;

/**
 * Enrutador de la aplicaciÃ³n.
 *
 * Asocia una URL y un mÃ©todo HTTP a una acciÃ³n de un controlador.
 * Admite parÃ¡metros dinÃ¡micos con la sintaxis ":nombre" (p. ej. "productos/:id").
 *
 * Ejemplos de registro de rutas:
 *   Router::add('get', 'contacto', [ContactoController::class, 'mostrarFormulario']);
 *   Router::add('get', 'productos/:id', [ProductoController::class, 'mostrar']);
 *   Router::add('get', 'inicio', function () { echo 'Hola'; });
 */
class Router
{
    /**
     * Rutas registradas, agrupadas por mÃ©todo HTTP.
     *
     * Si se registra Router::add('get', 'contacto', [ContactoController::class, 'mostrarFormulario']),
     * se almacena como self::$routes['GET']['contacto'] = [ContactoController::class, 'mostrarFormulario'].
     *
     * @var array<string, array<string, callable|array>>
     */
    private static array $routes = [];

    /**
     * Registra una ruta en el sistema.
     *
     * @param string         $method     MÃ©todo HTTP (GET, POST...). No distingue mayÃºsculas.
     * @param string         $action     PatrÃ³n de la URL, p. ej. "contacto" o "productos/:id".
     * @param callable|array $controller [Clase::class, 'metodo'] (estÃ¡tico o no estÃ¡tico) o una funciÃ³n anÃ³nima.
     */
    public static function add(string $method, string $action, callable|array $controller): void
    {
        // Se eliminan las barras inicial y final para que 'contacto' y '/contacto/' sean la misma ruta
        self::$routes[strtoupper($method)][trim($action, '/')] = $controller;
    }

    /**
     * Busca la ruta que coincide con la peticiÃ³n actual y ejecuta su acciÃ³n.
     *
     * Si ninguna ruta registrada coincide, responde con un error 404.
     */
    public static function dispatch(): void
    {
        // MÃ©todo HTTP de la peticiÃ³n: GET, POST...
        $method = $_SERVER['REQUEST_METHOD'];
        $uri    = self::getUri();

        // Se recorren solo las rutas registradas para el mÃ©todo de la peticiÃ³n
        foreach (self::$routes[$method] ?? [] as $action => $controller) {
            // Cada marcador ":nombre" (dos puntos + letras, nÃºmeros o guion bajo) se sustituye
            // por un grupo de captura que admite cualquier texto excepto "/".
            // Ejemplo: 'user/:id' => 'user/([^/]+)', que coincide con 'user/15'
            $pattern = preg_replace('#:\w+#', '([^/]+)', $action);

            if (preg_match('#^' . $pattern . '$#i', $uri, $matches)) {
                // $matches[0] es la coincidencia completa; el resto son los parÃ¡metros capturados
                array_shift($matches);
                self::run($controller, $matches);
                return;
            }
        }

        // Ninguna ruta coincide: error 404
        http_response_code(404);
        ErrorController::show_error404();
    }

    /**
     * Obtiene la ruta solicitada sin la query string ni las carpetas del proyecto.
     *
     * Ejemplo: /tienda/public/productos/10?x=1 => productos/10
     *
     * @return string Ruta limpia, sin barras al inicio ni al final.
     */
    private static function getUri(): string
    {
        // Solo la ruta de la URL; se descartan los parÃ¡metros GET (?id=1)
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Directorio pÃºblico (p. ej. /tienda/public) y raÃ­z del proyecto (/tienda),
        // con "/" como separador tambiÃ©n en Windows (donde dirname puede devolver "\")
        $publicDir  = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $projectDir = str_replace('\\', '/', dirname($publicDir));

        // Se elimina el primer prefijo que coincida con un segmento completo de la URI
        // (hasta la siguiente "/" o el final). Cubre dos casos:
        //   - /tienda/public/productos/10 (se escribe "public" explÃ­citamente)
        //   - /tienda/productos/10        (el .htaccess redirige a public)
        foreach ([$publicDir, $projectDir] as $prefix) {
            if ($prefix !== '/' && preg_match('#^' . preg_quote($prefix, '#') . '(?=/|$)#i', $uri)) {
                $uri = substr($uri, strlen($prefix));
                break;
            }
        }

        return trim($uri, '/');
    }

    /**
     * Ejecuta la acciÃ³n de un controlador pasÃ¡ndole los parÃ¡metros extraÃ­dos de la URL.
     *
     * Si se indica una clase ([Clase::class, 'metodo']), se instancia antes de la llamada.
     * PHP permite invocar un mÃ©todo estÃ¡tico desde una instancia, por lo que
     * el mismo cÃ³digo sirve para mÃ©todos estÃ¡ticos y no estÃ¡ticos.
     *
     * @param callable|array $controller AcciÃ³n registrada en la ruta.
     * @param array          $params     ParÃ¡metros dinÃ¡micos, en el orden en que aparecen en la URL.
     */
    private static function run(callable|array $controller, array $params): void
    {
        if (is_array($controller) && is_string($controller[0])) {
            $controller[0] = new $controller[0]();
        }

        call_user_func_array($controller, $params);
    }
}