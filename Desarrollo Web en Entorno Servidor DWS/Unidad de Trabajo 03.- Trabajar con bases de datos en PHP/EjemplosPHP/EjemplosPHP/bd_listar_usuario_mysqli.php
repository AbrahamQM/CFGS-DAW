<?php
// Datos de conexión
$servidor = 'localhost';
$usuario = 'root';
$clave = '';
$base_datos = "empresa";

// Se crea la conexion de forma procedimental
$conexion = mysqli_connect($servidor, $usuario, $clave, $base_datos);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Si la conexión ha sido correcta se realiza la consulta

$sql = "SELECT id, nombre, correo FROM usuarios";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $fila["id"] . " - Nombre: " . $fila["nombre"] . " - Correo: " . $fila["correo"] . "<br>";
    }
} else {
    echo "La tabla Usuarios se encuentra vacía";
}

mysqli_close($conexion);

?>

<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "empresa";

// Crear conexión de forma POO
$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Si la conexión ha sido correcta se realiza la consulta
$sql = "SELECT id, nombre, correo FROM usuarios";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila["id"]. " - Nombre: " . $fila["nombre"]. " - Correo: " . $fila["correo"]. "<br>";
    }
} else {
	echo "La tabla Usuarios se encuentra vacía";
}

$conexion->close();
?>
