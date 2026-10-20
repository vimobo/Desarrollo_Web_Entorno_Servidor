
param(
    [Parameter(Mandatory = $true)]
    [string]$Nombre
)

# Escribir archivos UTF-8 sin BOM
function Write-Utf8NoBom {
    param(
        [string]$Path,
        [string]$Content
    )

    $utf8NoBom = New-Object System.Text.UTF8Encoding $false
    [System.IO.File]::WriteAllText($Path, $Content, $utf8NoBom)
}

# Ruta del proyecto
$base = "C:\2DAW\Desarrollo_Web_Entorno_Servidor\projects\docker-php\projects"
$ruta = Join-Path $base $Nombre

# Composer necesita un nombre de paquete válido
$nombrePaquete = $Nombre.ToLowerInvariant() -replace '[^a-z0-9._-]', '-'

if ($nombrePaquete -notmatch '^[a-z0-9]([a-z0-9._-]*[a-z0-9])?$') {
    Write-Host "Nombre de proyecto no válido para Composer." -ForegroundColor Red
    exit 1
}

if (Test-Path $ruta) {
    Write-Host "El proyecto '$Nombre' ya existe en $ruta" -ForegroundColor Red
    exit 1
}

try {
    # Crear estructura
    New-Item -ItemType Directory -Path "$ruta\public" -Force -ErrorAction Stop | Out-Null
    New-Item -ItemType Directory -Path "$ruta\src" -Force -ErrorAction Stop | Out-Null
    New-Item -ItemType Directory -Path "$ruta\tests" -Force -ErrorAction Stop | Out-Null

    # Composer
    $composerJson = @"
{
    "name": "clase/$nombrePaquete",
    "type": "project",
    "require": {},
    "require-dev": {
        "phpunit/phpunit": "^11.0"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
"@

    Write-Utf8NoBom "$ruta\composer.json" $composerJson

    # Punto de entrada
    $indexPhp = @"
<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

echo '<h1>Proyecto: $Nombre</h1>';
echo '<p>PHP ' . phpversion() . '</p>';
"@

    Write-Utf8NoBom "$ruta\public\index.php" $indexPhp

    # Front controller de Apache
    $htaccess = @"
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
"@

    [System.IO.File]::WriteAllText(
        "$ruta\public\.htaccess",
        $htaccess,
        [System.Text.Encoding]::ASCII
    )

    Write-Host "Proyecto '$Nombre' creado correctamente." -ForegroundColor Green
    Write-Host "Ruta: $ruta"
    Write-Host "HTTP: http://$Nombre.localhost/"
    Write-Host "HTTPS: https://$Nombre.localhost/"
    Write-Host ""
    Write-Host "Falta ejecutar Composer para crear vendor/autoload.php."
}
catch {
    Write-Host "Error al crear el proyecto: $_" -ForegroundColor Red
    exit 1
}
