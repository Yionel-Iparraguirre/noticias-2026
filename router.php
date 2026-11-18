cat << 'EOF' > router.php
<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

// Si piden una carpeta (ej. /), busca su index.php
if (is_dir($file)) {
    $file = rtrim($file, '/') . '/index.php';
}

// Si el archivo .php existe (ej. /secciones/nosotros.php), ejecútalo
if (file_exists($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    require $file;
    exit;
}

// Si no existe o es la raíz, carga el index.php principal
require __DIR__ . '/index.php';
EOF
