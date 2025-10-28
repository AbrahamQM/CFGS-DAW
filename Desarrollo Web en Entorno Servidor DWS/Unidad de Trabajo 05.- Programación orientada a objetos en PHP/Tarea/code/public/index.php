<!-- Página de inicio: comprueba si la tabla 'jugadores' tiene datos y redirige en consecuencia -->

<?php
require __DIR__ . '/../vendor/autoload.php';

use Abraham\Code\Conexion;

session_start(); // Usaremos sesión para mostrar mensajes simples

try {
    $pdo = Conexion::abrir();

    // Consulta rápida para saber si hay jugadores (0 = no hay datos)
    $total = (int)$pdo->query("SELECT COUNT(*) FROM jugadores")->fetchColumn();

    if ($total === 0) {
        // No hay datos: vamos a la instalación
        header('Location: instalacion.php');
        exit;
    } else {
        // Hay datos: vamos al listado de jugadores
        header('Location: jugadores.php');
        exit;
    }
} catch (Throwable $e) {
    // Si hay algún problema de conexión, mostramos un mensaje básico
    echo "<h2>Error de aplicación</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
