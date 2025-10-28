<?php
require __DIR__ . '/../vendor/autoload.php';

use League\Plates\Engine;

try {
    $templates = new Engine(__DIR__ . '/../views');
    echo $templates->render('vinstalacion', ['titulo' => 'Instalación']);
} catch (Exception $e) {
    echo "Error al cargar la vista: " . $e->getMessage();
}
