<?php
/*
 Conecta con la base de datos usando MySQLi e inicia la sesión una vez conectada. 
  
 Las variables se deben cambiar si es necesario.
*/

$host = "localhost";
$dbname = "dsw_usuarios";		// Nombre de la base de datos
$username = "root";				// Usuario con permisos
$password = "";					// Contraseña
 

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error && $_SERVER['REQUEST_METHOD'] != 'OPTIONS') {
    die("La conexion con la base de datos $dbname ha fallado: " . $conn->connect_error);
}
session_start();
?>
