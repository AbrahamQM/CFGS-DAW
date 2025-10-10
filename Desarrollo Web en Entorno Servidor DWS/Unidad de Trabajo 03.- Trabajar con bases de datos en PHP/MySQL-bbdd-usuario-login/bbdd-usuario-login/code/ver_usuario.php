<?php

/*
	Se muestran los datos del usuario id pasado por URL
*/

require 'conexion.php';
require 'funciones.php';
require 'auth.php';

$id = intval($_GET['id'] ?? 0);

if ($_SESSION['rol'] === 'vecino' && $id !== intval($_SESSION['userId'])) {
	echo "<a href=\"usuarios.php\">Volver</a><br/><br/>";
    die('Acceso denegado.');
}

$user = comprobar_id ($conn, $id);

if (!$user) {
	echo "<a href=\"usuarios.php\">Volver</a><br/><br/>";
    die('Usuario no encontrado.');
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Mostrar datos de Usuario</title></head>
<body>
	<h2>Mostrar datos de Usuario - Bienvenido <?= ($_SESSION['user'])  ?>, ha entrado con el rol (<?= ($_SESSION['rol']) ?>)</h2>
	<table border="1" cellpadding="6">
        <tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Rol</th>
		</tr>
		<tr>
			<td> <?= $user['id'] ?></td>
			<td><?= $user['usuario'] ?></td>
			<td> <?= $user['rol'] ?></td>
		</tr>
	</table>
			
    <p><a href="logout.php">Salir</a> | <a href="usuarios.php">Volver</a></p>
</body>
</html>
