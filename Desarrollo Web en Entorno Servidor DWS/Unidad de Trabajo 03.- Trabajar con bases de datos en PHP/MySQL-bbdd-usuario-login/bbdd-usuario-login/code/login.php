<?php

/*
	Solicita un usuario y contraseña y comprueba que esta es correcta, si lo es, redirije la aplicación a usuarios.php
*/

require 'conexion.php';
require 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user'];
    $password = $_POST['password'];
	
	$user = comprobar_username ($conn, $username);

	if ($user && ($password == $user['password'])) {
		// Recojo las variables en $_SESSION
        $_SESSION['userId'] = $user['id'];
        $_SESSION['user'] = $username;
        $_SESSION['rol'] = $user['rol'];
		
        header('Location: usuarios.php');
        exit;
    } else {
        $error = 'Credenciales inválidas';
    }
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Acceso a la aplicaci&oacute;n</title></head>
<body>
    <h2>Acceso a la aplicaci&oacute;n</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>Se ha producido el error: $error</p>"; ?>
	
	<!-- Formulario simplificado de login-password -->
    <form method="post">
        Usuario: <input type="text" name="user" required><br><br>
        Contrase&ntilde;a: <input type="password" name="password" required><br><br>
        <button type="submit">Acceder</button>
    </form>
	
</body>
</html>
