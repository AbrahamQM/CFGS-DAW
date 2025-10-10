<?php
// Crear la conexión de forma procedimental
$conn = mysqli_connect("localhost", "root", "", "empresa");

// Comprobar si ha habido un error
if (!$conn) {
    die("Se ha producido un error en la conexión: " . mysqli_connect_error());
}

$sql = "INSERT INTO usuarios (nombre, correo) VALUES ('Juan Pérez', 'juan@example.com')";

if (mysqli_query($conexion, $sql)) {
    echo "Se ha insertado un nuevo registro satisfactoriamente";
} else {
    echo "Se ha producido un error al insertar: " . mysqli_error($conexion);
}

// Cerramos la conexion a la base de datos
mysqli_close($conn);

?>


<?php
// Crear la conexion de forma POO

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

$sql = "INSERT INTO usuarios (nombre, correo) VALUES ('Juan Pérez', 'juan@example.com')";

if ($conn->query($sql) === TRUE) {
        echo "Se ha insertado un nuevo registro satisfactoriamente";
} else {
    echo "Se ha producido un error al insertar: " . $sql . "<br>" . $conn->error;
}

// Cerramos la conexion a la base de datos
$conn->close();

?>

