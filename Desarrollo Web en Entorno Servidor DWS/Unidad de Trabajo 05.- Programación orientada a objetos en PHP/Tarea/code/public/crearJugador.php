<!--
    Controlador para la inserción de un nuevo jugador
    desde la vista vcrear con el formulario que se carga desde fcrear
-->

<?php
require __DIR__ . '/../vendor/autoload.php';

use Abraham\Code\Jugador;
use Abraham\Code\Conexion;

try {
    // Recogida de datos del formulario
    $nombre = trim($_POST['nombre'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $nacionalidad = trim($_POST['nacionalidad'] ?? '');
    $fechaNacimiento = $_POST['fecha_nacimiento'] ?? null;
    $dorsal = $_POST['dorsal'] ?? null;
    $posicion = $_POST['posicion'] ?? null;
    $barcode = trim($_POST['barcode'] ?? '');

    // Validaciones mínimas
    $errores = [];
    if ($nombre === '' || $apellidos === '' || $nacionalidad === '' || $barcode === '') {
        $errores[] = "Faltan campos obligatorios.";
    }

    $pdo = Conexion::abrir();

    // Validar unicidad del dorsal
    if ($dorsal !== null && $dorsal !== '') {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM jugadores WHERE dorsal = ?");
        $stmt->execute([$dorsal]);
        if ($stmt->fetchColumn() > 0) {
            $errores[] = "El dorsal ya está asignado a otro jugador.";
        }
    }

    // Validar unicidad del barcode
    if ($barcode !== '') {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM jugadores WHERE barcode = ?");
        $stmt->execute([$barcode]);
        if ($stmt->fetchColumn() > 0) {
            $errores[] = "El código de barras ya existe en la base de datos.";
        }
    }

    // Si hay errores, se muestran
    if (!empty($errores)) {
        echo "<h2>Errores en la creación del jugador</h2><ul>";
        foreach ($errores as $e) {
            echo "<li>" . htmlspecialchars($e) . "</li>";
        }
        echo "</ul><a href='fcrear.php'>Volver al formulario</a>";
        exit;
    }

    // Crear objeto Jugador y guardarlo
    $jugador = new Jugador($nombre, $apellidos, $telefono, $nacionalidad, $fechaNacimiento, $dorsal, $posicion, $barcode);
    $jugador->insertar();

    // Redirigir al listado
    header("Location: jugadores.php");
    exit;

} catch (Exception $e) {
    echo "<h2>Error al crear jugador</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<a href='fcrear.php'>Volver al formulario</a>";
}
