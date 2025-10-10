<?php
// Crear la conexión de forma procedimental
$conexion = mysqli_connect("localhost", "root", "", "empresa");

// Comprobar si ha habido un error
if (!$conexion) {
    die("Se ha producido un error en la conexión: " . mysqli_connect_error());
}

// Instrucciones para realizar la insersión de un nuevo usuario
$ins = "INSERT INTO usuarios (nombre, correo) VALUES ('Juan Pérez', 'juan@example.com')";

if (mysqli_query($conexion, $ins)) {
    echo "Operación de inserción realizada correctamente";
} else {
    echo "Se ha producido un error al insertar: " . mysqli_error($conexion);
}

// Instrucciones para realizar la actualización del correo del identificador 1 de la tabla de usuarios
$upd = "UPDATE usuarios SET correo='nuevo@example.com' WHERE id=1";

if (mysqli_query($conexion, $sql)) {
    echo "Operación de actualización realizada correctamente";
} else {
    echo "Se ha producido un error al actualizar: " . mysqli_error($conexion);
}

// Instrucciones para realizar el borrado del usuario con identificador 1
$del = "DELETE FROM usuarios WHERE id=1";

if (mysqli_query($conexion, $sql)) {
    echo "Operación de borrado realizada correctamente";
} else {
    echo "Se ha producido un error al eliminar: " . mysqli_error($conexion);
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

// Instrucciones para realizar la insersión de un nuevo usuario
$ins = "INSERT INTO usuarios (nombre, correo) VALUES ('Juan Pérez', 'juan@example.com')";

if ($conn->query($ins) === TRUE) {
        echo "Operación de inserción realizada correctamente";
} else {
    echo "Se ha producido un error al insertar: " . $sql . "<br>" . $conn->error;
}

// Instrucciones para realizar la actualización del correo del identificador 1 de la tabla de usuarios
$upd = "UPDATE usuarios SET correo='nuevo@example.com' WHERE id=1";

if ($conn->query($upd) === TRUE) {
    echo "Operación de actualización realizada correctamente";
} else {
    echo "Se ha producido un error al actualizar: " . $conn->error;
}

// Instrucciones para realizar el borrado del usuario con identificador 1
$del = "DELETE FROM usuarios WHERE id=1";

if ($conn->query($del) === TRUE) {
    echo "Operación de borrado realizada correctamente";
} else {
    echo "Se ha producido un error al eliminar: " . $conn->error;
}

// Cerramos la conexion a la base de datos
$conn->close();

?>