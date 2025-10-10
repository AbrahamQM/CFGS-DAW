<?php
// Conexion con una base de datos usando MySQLi

$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "empresa";

// Crear la conexión con Programación Orientada a Objetos (POO)
$conn = new mysqli($servidor, $usuario, $contraseña, $base_datos);

// Comprobar si ha habido un error
if ($conn->connect_error) {
    die("Se ha producido un error en la conexión: " . $conn->connect_error);
}
echo "Se ha conectado correctamente";
// Cerramos la conexion a la base de datos
$conn->close();

// Crear la conexión de forma procedimental
$conn = mysqli_connect("localhost", "root", "", "empresa");

// Comprobar si ha habido un error
if (!$conn) {
    die("Se ha producido un error en la conexión: " . mysqli_connect_error());
}
echo "Se ha conectado correctamente";

// Cerramos la conexion a la base de datos
mysqli_close($conn);


