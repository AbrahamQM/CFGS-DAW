<?php
// Se continua con la sesion
session_start();

// Bloqueo acceso sin login
// Si NO existe la variable de sesión 'usuario' no ha pasado por el login.php
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!-- Se usa validación y limpieza con htmlspecialchars -->
<h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
<p>En esta página puedes realizar las acciones programadas para tu usuario. </p>

<a href="logout.php">Salir</a>
