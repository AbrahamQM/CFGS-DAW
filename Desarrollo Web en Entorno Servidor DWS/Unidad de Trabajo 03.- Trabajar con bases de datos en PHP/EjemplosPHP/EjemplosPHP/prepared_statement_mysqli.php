<?php
// Crear la conexión de forma procedimental
$conexion = mysqli_connect("localhost", "root", "", "empresa");

// Comprobar si ha habido un error
if (!$conexion) {
    die("Se ha producido un error en la conexión: " . mysqli_connect_error());
}

// Instrucciones para realizar la insersión de un nuevo usuario
// Consulta deseada: 
// $ins = "INSERT INTO usuarios (nombre, correo) VALUES ('Juan Pérez', 'juan@example.com')";

// Se prepara la sentencia SQL deseada
$ins = mysqli_prepare($conexion, "INSERT INTO usuarios (nombre, correo) VALUES (?, ?)");

// Se deben vincular los parametros nombre y correo
// s: String
// d: float
// i: integer
// b: blob
mysqli_stmt_bind_param($ins, "ss", $nombre, $correo);

// Asignar valores a las variables
$nombre = "Juan Antonio";
$correo = "jfernandez@example.com";

// Ejecutar la consulta ins
mysqli_stmt_execute($ins);

echo "Operación de inserción realizada correctamente";

// Cerramos la consulta y la conexion a la base de datos
mysqli_stmt_close($ins);
mysqli_close($conn);

?>


<?php
// Crear la conexion de forma POO

$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "empresa";

// Crear la conexión con Programación Orientada a Objetos (POO)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($servidor, $usuario, $contraseña, $base_datos);

// Comprobar si ha habido un error
if ($conn->connect_error) {
    die("Se ha producido un error en la conexión: " . $conn->connect_error);
}

// Instrucciones para realizar la insersión de un nuevo usuario
// Consulta deseada: 
// $ins = "INSERT INTO usuarios (nombre, correo) VALUES ('Juan Pérez', 'juan@example.com')";
$stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, correo) VALUES (?, ?)");

// Se deben vincular los parametros nombre y correo 
$stmt->bind_param('ss', $nombre, $correo);

// Asignar valores a las variables
$nombre = "Juan Antonio";
$correo = "jfernandez@example.com";

// Ejecutar la consulta
$stmt->execute();

printf("%d filas insertadas de forma satisfactoria\n", $stmt->affected_rows);


// Cerramos la consulta y la conexion a la base de datos
$stmt->close();
$conn->close();

?>