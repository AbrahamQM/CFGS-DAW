<?php

/*
	Contiene funciones a ser llamadas por las diferentes acciones que el usuario desea realizar.
*/

// Se comprueba que existe en la tabla usuarios un username recogido y devuelve el array $user del resultado del SELECT
function comprobar_username ($conn, $username) {
	
	$stmt = $conn->prepare('SELECT * FROM usuarios WHERE usuario = ? LIMIT 1');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
	
	return $user;
}

// Se comprueba que existe en la tabla usuarios un id recogido y devuelve el array $user del resultado del SELECT
function comprobar_id ($conn, $id) {

	$stmt = $conn->prepare('SELECT id, usuario, rol FROM usuarios WHERE id = ? LIMIT 1');
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$user = $stmt->get_result()->fetch_assoc();
	$stmt->close();
	
	return $user;
}


// Comprueba que haya un usuario con rol presidente
function comprobar_rol_presidente ($conn) {
	// Consulto los usuarios
	$sql = 'SELECT COUNT(*) as total FROM usuarios WHERE rol = "presidente"';
	$result = $conn->query($sql);
	
	if ($result) {
		$row = $result->fetch_assoc();
		return $row['total'] > 0;
	}
	
	return false;
}
