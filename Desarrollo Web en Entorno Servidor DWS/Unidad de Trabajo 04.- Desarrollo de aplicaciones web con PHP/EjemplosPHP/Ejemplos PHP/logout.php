<?php
// Continuamos con la sesion
session_start();

// Se destruye la sesion
session_destroy();

// Si hay cookies se deben también destruir
// 

// Se reinicia la variable $_SESSION
$_SESSION = array();

// Se redirige a login.php
header("Location: login.php");

exit();
?>
