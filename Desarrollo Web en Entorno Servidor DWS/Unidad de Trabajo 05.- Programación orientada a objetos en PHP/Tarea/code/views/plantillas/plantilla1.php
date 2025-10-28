<!-- Esta es la plantilla del proyecto que se usa en todas las vístas
    porque tiene el título de la página, el H1 y el contenido dinámicos
     que se pasen desde la vista que la use.
     además importa los estilos comunes para que se vean atractivas todas las vistas
-->
<?php
// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $this->e($titulo) ?></title>
     <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>Aplicación de Jugadores</h1>
    </header>
    <main>
        <?= $this->section('contenido') ?>
    </main>
</body>
</html>
