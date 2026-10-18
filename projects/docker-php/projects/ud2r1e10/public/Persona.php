<?php

class Persona
{

    public function __construct(
        private string $nombre,
        private int $edad,
        private string $apellidos
    ) {}

      public function __call($metodo, $argumentos)
    {
        // Comprobar si el método empieza por "get"
        if (str_starts_with($metodo, 'get')) {

            // Obtener el nombre de la propiedad
            $propiedad = lcfirst(substr($metodo, 3));

            // Comprobar si existe la propiedad
            if (property_exists($this, $propiedad)) {
                return $this->$propiedad;
            }
        }

        throw new BadMethodCallException(
            "El método $metodo no existe."
        );
    }
}

?>