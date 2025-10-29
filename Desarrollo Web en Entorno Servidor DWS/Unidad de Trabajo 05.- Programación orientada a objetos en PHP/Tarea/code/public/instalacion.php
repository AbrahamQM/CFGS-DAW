<!--
    Vista de instalación usando Plates
    renderiza la vista vinstalacion  que se encarga de llamar a crearDatos
    le define el título Instalación a la vista
    también maneja errores si los hay
  -->

<?php
require __DIR__ . '/../vendor/autoload.php';

use League\Plates\Engine;

try {
    $templates = new Engine(__DIR__ . '/../views');
    echo $templates->render('vinstalacion', ['titulo' => 'Instalación']);
} catch (Exception $e) {
    echo "Error al cargar la vista: " . $e->getMessage();
}
