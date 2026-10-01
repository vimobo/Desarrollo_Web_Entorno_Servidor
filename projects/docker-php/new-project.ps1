param(
[Parameter(Mandatory=$true)]
[string]$Nombre
)
# Escribe texto en UTF-8 SIN BOM (Out-File -Encoding utf8 añade BOM en
# Windows PowerShell 5.1, y esa marca invisible rompe el parser JSON de
# Composer y puede causar errores raros en PHP). Se usa esta función para
# cualquier fichero de texto/código del proyecto.
function Write-Utf8NoBom {
param([string]$Path, [string]$Content)
$utf8NoBom = New-Object System.Text.UTF8Encoding $false
[System.IO.File]::WriteAllText($Path, $Content, $utf8NoBom)
}
$ruta = "C:\2DAW\Desarrollo_Web_Entorno_Servidor\projects\docker-php\projects\$Nombre"
if (Test-Path $ruta) {
Write-Host "El proyecto '$Nombre' ya existe en $ruta" -ForegroundColor Red
exit 1
}
# --- Estructura de carpetas (separando lo público de lo privado) ---
New-Item -ItemType Directory -Path "$ruta\public" | Out-Null
# New-Item -ItemType Directory -Path "$ruta\src" | Out-Null
# New-Item -ItemType Directory -Path "$ruta\tests" | Out-Null
# --- index.php de entrada en public/ ---
$indexPhp = @"
<?php
require_once __DIR__ . '/../vendor/autoload.php';
echo '<h1>Proyecto: $Nombre</h1>';
echo '<p>PHP ' . phpversion() . '</p>';
"@
Write-Utf8NoBom "$ruta\public\index.php" $indexPhp
# --- .htaccess en public/ con mod_rewrite ya activo (front controller) ---
@"
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
"@ | Out-File -Encoding ascii "$ruta\public\.htaccess"
# --- composer.json en la raíz del proyecto ---
<#
$composerJson = @"
{
"name": "clase/$Nombre",
"type": "project",
"require": {},
"require-dev": {
InstalacionEntornoTrabajo-v2.md 2026-09-15
16 / 21
"phpunit/phpunit": "^11.0"
},
"autoload": {
"psr-4": { "App\\": "src/" }
}
}
"@
Write-Utf8NoBom "$ruta\composer.json" $composerJson
#>
# --- Git y Composer dentro del contenedor ---
#docker compose exec -w "/var/www/projects/$Nombre" web git init -q
# docker compose exec -w "/var/www/projects/$Nombre" web composer install -q
Write-Host "Proyecto '$Nombre' creado correctamente." -ForegroundColor Green
Write-Host "HTTP: http://$Nombre.localhost/"
Write-Host "HTTPS: https://$Nombre.localhost/"