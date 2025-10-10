<?php

// Datos de conexión
$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'root';
$clave = '';

try {
	// Realizamos la conexión con la base de datos empresa
	$bd = new PDO($cadena_conexion, $usuario, $clave);
	echo "Conexión realizada con éxito<br>";

	// Instrucciones para realizar la insersión de un nuevo usuario
	$ins = "insert into usuarios(nombre, clave, rol) values('Alberto', '33333', '1');";
	$resul = $bd->query($ins);

	// Se comprueban si hubieron errores a la hora de ejecutar la consulta
	if ($resul) {
		echo "Operación de inserción realizada correctamente <br>";
		echo "Filas insertadas: " . $resul->rowCount() . "<br>";
	} else {
		print_r($bd->errorinfo());
	}

	// Mostramos el identificador de la última fila insertada con éxito
	echo "Código de la fila insertada" . $bd->lastInsertId() . "<br>";

	// Instrucciones para realizar la actualización de la tabla de usuarios
	$upd = "update usuarios set rol =  0 where rol = 1";
	$resul = $bd->query($upd);

	// Se comprueban si hubieron errores a la hora de ejecutar la consulta
	if ($resul) {
		echo "Operación de actualización realizada correctamente <br>";
		echo "Filas actualizadas: " . $resul->rowCount() . "<br>";
	} else{
		print_r($bd->errorinfo());
	}


	// Instrucciones para realizar el borrado de la usuaria 'Luisa'
	$del = "delete from usuarios where nombre = 'Luisa'";
	$resul = $bd->query($del);

	// Se comprueban si hubieron errores a la hora de ejecutar la consulta
	if ($resul) {
		echo "Operación de borrado realizada correctamente <br>";
		echo "Filas borradas: " . $resul->rowCount() . "<br>";
	} else{
		print_r($bd->errorinfo());
	}

} catch (PDOException $e) {
	echo 'Error con la base de datos: ' . $e->getMessage();
}
