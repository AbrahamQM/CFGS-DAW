<?php
require __DIR__ . '/../vendor/autoload.php';

use League\Plates\Engine;
use Abraham\Code\Jugador;

try {
    $jugadores = Jugador::obtenerTodos();

    $templates = new Engine(__DIR__ . '/../views');
    echo $templates->render('vjugadores', ['jugadores' => $jugadores]);
} catch (Exception $e) {
    echo "Error al cargar jugadores: " . $e->getMessage();
}
