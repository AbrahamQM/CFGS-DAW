<?php
/**
 * Archivo: procesos/logout.php
 * Descripción: Cierra la sesión del usuario y lo devuelve al login.
 */
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión
header("Location: ../login.php"); // Subimos un nivel para ir al login
exit;
