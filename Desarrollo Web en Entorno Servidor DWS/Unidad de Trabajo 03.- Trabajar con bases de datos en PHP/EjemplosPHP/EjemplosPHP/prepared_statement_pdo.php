<?php
// Crear la conexión con PDO
$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'root';
$clave = '';

try {
    $conexion = new PDO($cadena_conexion, $usuario, $clave);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar la consulta con marcadores o placeholders
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo) VALUES (:nombre, :correo)");

    // Asignar valores a los parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':correo', $correo);
	

    // Asignar valores y ejecutar
    $nombre = "Juan Antonio";
    $correo = "jfernandez@example.com";
    $stmt->execute();
	
	/* Otra forma de realizar execute es la siguiente:
	
		$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo) VALUES (:nombre, :correo)");
		$stmt->execute([
				':nombre' => 'Juan Antonio',
				':correo' => 'jfernandez@example.com'
		]);
	*/

	// Otra forma de hacerlo
	$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo) VALUES (?, ?)");

	// Ejecutar directamente pasando un arreglo con los valores
	$stmt->execute([
		"Juan Antonio",
		"jfernandez@example.com"
	]);

    echo "Operación de inserción realizada correctamente <br>";
	
} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
}
?>
