<?php
/*
	Contiene funciones a ser llamadas por las diferentes acciones que el usuario desea realizar.
*/

/*
	Se comprueba que existe en la tabla usuarios un id recogido en $_GET['id']
*/
function comprobar_usuario ($pdo, $id) {
	$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
	$stmt->execute([$id]);
	$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$usuario) {
		die("Usuario no existe!");
	}
	return $usuario;
}

/*
	Comprueba que haya un usuario con rol presidente
*/
function comprobar_rol_presidente ($pdo) {
	// Consulto los usuarios
	$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id ASC");
	$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	if (empty($usuarios)) {
		echo "No se encontraron resultados en Usuarios";
	} elseif (in_array("presidente", array_column($usuarios, 'rol'))) {
		return true;
	}
	return false;
}



