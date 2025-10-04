<?php
/**
 * Archivo: login.php
 * Descripción: Página inicial de acceso a la aplicación.
 * Muestra un formulario donde el usuario introduce su DNI/correo y contraseña.
 * Los datos se envían a proceso_login para validación.
 */
session_start(); // Iniciamos sesión para poder usar variables de sesión más adelante
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso a la Comunidad</title>
    <!-- Hoja de estilos principal -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h2>Acceso a la aplicación</h2>
    <!-- Formulario de login -->
   <form action="procesos/proceso_login.php" method="post">
        <label for="usuario">Usuario (DNI o correo):</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
