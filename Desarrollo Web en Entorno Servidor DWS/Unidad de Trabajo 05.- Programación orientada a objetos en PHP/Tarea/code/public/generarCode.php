<?php
require __DIR__ . '/../vendor/autoload.php';
use Milon\Barcode\DNS1D;

$code = '1234567890128'; // 13 dígitos; idealmente lo generaremos con checksum correcto
$barcode = new DNS1D();
$barcode->setStorPath(__DIR__ . '/../cache'); // Asegúrate de que exista y tenga permisos
echo '<img src="data:image/png;base64,' . $barcode->getBarcodePNG($code, 'EAN13') . '"/>';
echo '<p>' . $code . '</p>';
//TODO: no te olvides de revisar los comentarios