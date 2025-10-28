<!--
    Generador de código de barras aleatorio
    que comprueba que no sea repetido
    lo devuelve al formulario de creación de jugador automáticamente
 -->

<?php
require __DIR__ . '/../vendor/autoload.php';

use Abraham\Code\Conexion;

// Función para calcular el dígito de control de un EAN-13
function calcularChecksum($codigo12) {
    $suma = 0;
    for ($i = 0; $i < 12; $i++) {
        $digito = (int)$codigo12[$i];
        $suma += ($i % 2 === 0) ? $digito : $digito * 3;
    }
    $resto = $suma % 10;
    return ($resto === 0) ? 0 : 10 - $resto;
}

$pdo = Conexion::abrir();

do {
    $codigo12 = str_pad(strval(random_int(0, 999999999999)), 12, '0', STR_PAD_LEFT);
    $checksum = calcularChecksum($codigo12);
    $codigo13 = $codigo12 . $checksum;

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM jugadores WHERE barcode = ?");
    $stmt->execute([$codigo13]);
    $existe = $stmt->fetchColumn() > 0;

} while ($existe);

// Redirigir directamente al formulario con el código en la URL
header("Location: fcrear.php?barcode=$codigo13");
exit;
