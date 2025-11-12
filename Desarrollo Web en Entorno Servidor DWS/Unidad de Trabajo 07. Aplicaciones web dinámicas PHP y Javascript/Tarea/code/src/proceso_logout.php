<?php
/**
 * Archivo: proceso_logout.php
 * Se encarga de cerrar la sesión del usuario.
 * Se destruye la sesión y se devuelve al login.
 */

session_start(); // Se inicia la sesión para poder destruirla
session_unset(); // Se eliminan todas las variables de sesión
session_destroy(); // Se destruye la sesión

// Se redirige al login
header("Location: ../public/login.php");
exit();
