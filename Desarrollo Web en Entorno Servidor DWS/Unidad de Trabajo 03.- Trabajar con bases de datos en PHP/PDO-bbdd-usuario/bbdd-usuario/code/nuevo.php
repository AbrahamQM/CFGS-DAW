<?php
/*
	Inserta un nuevo registro en la tabla usuarios de la base de datos que se ha configurado en conexion_bbdd.php
	Realiza la comprobacion de que no existe un presidente en la tabla, sólo puede haber un usuario con el rol presidente.
*/

include_once 'funciones.php';
require 'conexion_bbdd.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"];
    $rol = $_POST["rol"];
	$password = $_POST["password"];

	if (($rol == "presidente") && (comprobar_rol_presidente($pdo))) {
			echo "<a href=\"index.php\">Volver</a><br/><br/>";
			die ("No puede haber más de un presidente en la comunidad");
	}
	else {
		$stmt = $pdo->prepare("INSERT INTO usuarios (usuario, rol, password) VALUES (?, ?, ?)");
		$stmt->execute([$usuario, $rol, $password]);
	}

    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head><title>Insertar Usuario</title></head>
<body>
    <h2>Insertar usuario</h2>
    <form method="post">
        Usuario: <input type="text" name="usuario" required><br><br>
		Password: <input type="password" name="password" required><br><br>
		Rol: <select type="rol" name="rol" required> <br/><br/>
				<option value="vecino" selected> Vecino </option>
				<option value="presidente" selected> Presidente </option>
				<option value="administrador" selected> Administrador </option>
			</select>
        
        <button type="submit">Nuevo</button>
    </form>
    <br>
      <a href="index.php">Volver</a>
</body>
</html>
