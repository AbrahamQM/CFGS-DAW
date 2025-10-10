<?php

/*
	Elimina el usuario utilizando MySQLi.
	Sólo el rol administrador puede eleminar el usuario.
*/


require 'conexion.php';
require 'auth.php';

if ($_SESSION['rol'] !== 'administrador') {
	echo "<a href=\"usuarios.php\">Volver</a><br/><br/>";
    die('Acceso denegado.');
}

$id = intval($_GET['id'] ?? 0);

if ($id) {
    $stmt = $conn->prepare('DELETE FROM usuarios WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}

header('Location: usuarios.php');
exit;

