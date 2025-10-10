<?php

// Datos de conexión
$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'root';
$clave = '';

try {
	// Realizamos la conexión con la base de datos empresa
	$bd = new PDO($cadena_conexion, $usuario, $clave);
	echo "Conexión realizada con éxito<br>";

	// Comenzar con la transacción
	$bd->beginTransaction();

	$ins = "insert into usuarios(nombre, clave, rol) values('Alberto', '33333', '1');";
	$resul = $bd->query($ins);
	// Al realizar la consulta falla porque el nombre es UNIQUE y ya se ha insertado 'Alberto'
	$resul = $bd->query($ins);

	// Se comprueban si hubieron errores a la hora de ejecutar la consulta
	if ($resul) {
		echo "Operación de insersión realizada correctamente <br>";
		echo "Filas insertadas: " . $resul->rowCount() . "<br>";
		$bd->commit();
	} else {
		print_r($bd->errorinfo());
		$bd->rollback();
		echo "Transacción anulada <br>";
	}

} catch (PDOException $e) {
	echo 'Error con la base de datos: ' . $e->getMessage();
}