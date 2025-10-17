<?php
	session_start();    // unirse a la sesión
	// Borrar todos los elementos almacenados de $_SESSION
	$_SESSION = array();
	session_destroy();	// eliminar la sesion
	setcookie(session_name(), 123, time() - 1000); // eliminar la cookie
	// redirigimos a login.php
	header("Location: login.php");