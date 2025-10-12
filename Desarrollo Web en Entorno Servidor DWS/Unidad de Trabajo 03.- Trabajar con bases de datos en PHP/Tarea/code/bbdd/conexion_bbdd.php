<?php
/*
 Conecta con la base de datos usando el objeto de PDO e inicia la sesión una vez conectada.
 Se activan los errores y las excepciones que puedan ocurrir en el trato de PDO.

 Las variables se deben cambiar si fuera necesario.
*/

$host = "localhost";        //equipo donde está la base de datos
$dbname = "comunidad";		// Nombre de la base de datos
$username = "root";			// Usuario con permisos
$password = "root";			// Contraseña

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La conexion con la base de datos $dbname ha fallado: " . $e->getMessage());
}