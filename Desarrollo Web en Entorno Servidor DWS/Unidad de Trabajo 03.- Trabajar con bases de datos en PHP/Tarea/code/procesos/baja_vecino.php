<?php
/**
 * Archivo: baja_vecino.php
 * Descripción: Elimina una vivienda concreta de un vecino (DNI + vivienda).
 */

session_start();
require_once "funciones.php";

// Verificamos rol
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dni'], $_POST['vivienda'])) {
    $dni = $_POST['dni'];
    $vivienda = $_POST['vivienda'];

    $vecinos = leerVecinos();
    $nuevos = [];

    foreach ($vecinos as $v) {
        // Saltamos la cabecera si viene en el array
        if ($v[0] === "nombre" && $v[1] === "dni") {
            $nuevos[] = $v;
            continue;
        }

        // Guardamos todas las filas excepto la que coincide con DNI + vivienda
        if (!($v[1] === $dni && $v[4] === $vivienda)) {
            $nuevos[] = $v;
        }
    }

    // Reescribir fichero
    $lineas = [];
    $lineas[] = "nombre|dni|telefono|correo|vivienda|fechaAlta|cuotasPagadas|cuotasPendientes|fechaUltima|rol|password";
    foreach ($nuevos as $v) {
        if ($v[0] === "nombre" && $v[1] === "dni") continue;
        $lineas[] = implode("|", $v);
    }

    file_put_contents(FICHERO_VECINOS, implode("\n", $lineas) . "\n");
}

header("Location: ../admin.php");
exit;
