<?php
/*
	Crea un nuevo usuario. 
	Se tiene en cuenta que sólo puede haber un único presidente en la tabla usuarios.
	Se tiene en cuenta que solo el administrador puede dar de alta un usuario.
*/


require 'conexion.php';
require 'funciones.php';
require 'auth.php';

if ($_SESSION['rol'] !== 'administrador') {
    echo "<a href=\"usuarios.php\">Volver</a><br/><br/>";
	die('Acceso denegado. Solo administradores.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

	if ($rol === "presidente" && comprobar_rol_presidente ($conn)) {
			echo "<a href=\"usuarios.php\">Volver</a><br/><br/>";
			die('Solo puede haber un presidente.');	
		}


    $stmt = $conn->prepare('INSERT INTO usuarios (usuario, password, rol) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $usuario, $password, $rol);
    $stmt->execute();
    $stmt->close();

    header('Location: usuarios.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Alta de Usuarios</title></head>
<body>
    <h2>Alta de Usuario</h2>
	
    <form method="post">
        Usuario: <input type="text" name="usuario" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        Rol:
        <select name="rol">
            <option value="vecino">vecino</option>
            <option value="presidente">presidente</option>
            <option value="administrador">administrador</option>
        </select><br><br>
        <button type="submit">Insertar</button>
    </form>
	
    <p><a href="usuarios.php">Volver</a></p>
</body>
</html>
