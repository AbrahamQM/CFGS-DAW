<!--
    página del formuario para creación de un nuevo jugador
    con datos introducidos por el usuario mediante la vista vcrear.php
    que se procesa en el controlador crearJugador.php
-->

<?php
require __DIR__ . '/../vendor/autoload.php';

use League\Plates\Engine;

$templates = new Engine(__DIR__ . '/../views');

// Si llega un código de barras por GET, lo pasamos a la vista
$barcode = $_GET['barcode'] ?? '';

echo $templates->render('vcrear', ['barcode' => $barcode]);
