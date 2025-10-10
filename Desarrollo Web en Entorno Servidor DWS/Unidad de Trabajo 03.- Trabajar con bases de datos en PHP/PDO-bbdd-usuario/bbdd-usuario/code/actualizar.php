<?php

/*
	Actualiza un registro en la tabla usuarios de la base de datos que se ha conectado en conexion_bbdd.php.
	Realiza la comprobacion de que no existe un presidente en la tabla, sólo puede haber un usuario con el rol presidente.
*/

include_once 'funciones.php';
require 'conexion_bbdd.php';


$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$usuario = comprobar_usuario($pdo, $id);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"];
    $rol = $_POST["rol"];
	$password = $_POST["password"];

	if (($rol == "presidente") && (comprobar_rol_presidente($pdo))) {
		echo "<a href=\"index.php\">Volver</a><br/><br/>";
		die ("No puede haber más de un presidente en la comunidad");
	}
	else {
		$stmt = $pdo->prepare("UPDATE usuarios SET usuario = ?, rol = ?, password = ? WHERE id = ?");
		$stmt->execute([$usuario, $rol, $password, $id]);
	}
    
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Modificar Usuario</title></head>
<body>
    <h2>Modificar Usuario</h2>
    <form method="post">
		Usuario: <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required><br><br>
		Password: <input type="password" name="password" value="<?= htmlspecialchars($usuario['password']) ?>" required><br><br>
		Rol: <select type="rol" name="rol" value="<?= htmlspecialchars($usuario['rol']) ?>" required> <br/><br/>
				<option value="vecino" selected> Vecino </option>
				<option value="presidente" selected> Presidente </option>
				<option value="administrador" selected> Administrador </option>
			</select>
        
        <button type="submit">Actualizar</button>
    </form>
    <br>
    <a href="index.php">Volver</a>
</body>
</html>
