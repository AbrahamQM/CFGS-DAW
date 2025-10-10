<?php

/*
  Realiza la modificacion de un usuario de la base de datos que se conecta en conexion 	
  
  ** mysqli_stmt::bind_param(string $types, mixed &$var, mixed &...$vars): bool
		string $types: i -> integer : d -> float : s -> string : b : blob
*/

require 'conexion.php';
require 'funciones.php';
require 'auth.php';

$id = intval($_GET['id'] ?? 0);

$user = comprobar_id ($conn, $id);


// Si el usuario $_GET['id'] no existe no se puede modificar
if (!$user) {
	echo "<a href=\"usuarios.php\">Volver</a><br/><br/>";
    die('Usuario no encontrado.');
}

// Un vecino solo puede ver sus datos 
if ($_SESSION['rol'] === 'vecino') {
	echo "<a href=\"usuarios.php\">Volver</a><br/><br/>";
    die('Acceso denegado.');
}

// Rol: Administrador - Si los datos vienen del formulario los recojo en las variables y realizo el UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['rol'] === 'administrador') {
        $nombre = $_POST['nombre'];
        $rol = $_POST['rol'];

		if ($rol === "presidente" && comprobar_rol_presidente ($conn)) {
			echo "<a href=\"usuarios.php\">Volver</a><br/><br/>";
			die('Solo puede haber un presidente.');	
		}			
		
		$stmt = $conn->prepare('UPDATE usuarios SET usuario = ?, rol = ? WHERE id = ?');
        $stmt->bind_param('ssi', $nombre, $rol, $id);
		$stmt->execute();
        $stmt->close();		
    }

    header('Location: usuarios.php');
    exit;
}
?>


<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Editar Usuario</title></head>
<body>
    <h2>Editar Usuario</h2>
    <form method="post">
        <?php if ($_SESSION['rol'] === 'administrador'): ?>
            Nombre: <input type="text" name="nombre" value="<?= $user['usuario'] ?>" required><br><br>
        <?php else: ?>
            Nombre: <?= $user['usuario'] ?><br><br>
        <?php endif; ?>

        <?php if ($_SESSION['rol'] === 'administrador'): ?>
            Rol: <?= $user['rol'] ?><br>
			Nuevo rol:
            <select name="rol">
                <option value="vecino">vecino</option>
                <option value="presidente">presidente</option>
                <option value="administrador">administrador</option>
            </select><br><br>
        <?php else: ?>
            Rol: <?= $user['rol'] ?><br><br>
        <?php endif; ?>

        <button type="submit">Guardar</button>
    </form>
    <p><a href="usuarios.php">Volver</a></p>
</body>
</html>
