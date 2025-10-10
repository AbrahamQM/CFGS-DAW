<?php
// Datos de conexión
$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'root';
$clave = '';

try {
    $bd = new PDO($cadena_conexion, $usuario, $clave);
	echo "Conexión realizada con éxito<br>";		
	
	// Primera forma de realizar la consulta y mostrar los datos usando un foreach
	$sql = 'SELECT nombre, clave, rol FROM usuarios';
	$usuarios = $bd->query($sql);
	echo "Número de usuarios: " . $usuarios->rowCount() . "<br>";
	foreach ($usuarios as $usu) {
		print "Nombre : " . $usu['nombre'];
		print " Clave : " . $usu['clave'] . "<br>";
	}
	
	// Otra forma de realizar la consulta.
	// Uso de consultas preparadas : el orden de los parámetros es importante
	// Se ponen interrogaciones y se prepara la consulta con el valor deseado
	$preparada = $bd->prepare("select nombre from usuarios where rol = ?");
	$preparada->execute( array(0));				// Sustituimos array por la variable que contiene el valor del rol 
	
	echo "Usuarios con rol 0: " .  $preparada->rowCount() . "<br>";
	foreach ($preparada as $usu) {
		print "Nombre : " . $usu['nombre'] . "<br>";
	}
	
	// Otra forma de realizar la consulta.
	// Uso de consultas preparadas : en este caso los parametros se pasan por nombre
	$preparada_nombre = $bd->prepare("select nombre from usuarios where rol = :rol");
	$preparada_nombre->execute( array(':rol' => 0));		// Sustituimos array por la variable que contiene el valor de rol 
	
	echo "Usuarios con rol 0: " .  $preparada->rowCount() . "<br>";
	foreach ($preparada_nombre  as $usu) {
		print "Nombre : " . $usu['nombre'] . "<br>";
	}
	
} catch (PDOException $e) {
	echo 'Error con la base de datos: ' . $e->getMessage();
}