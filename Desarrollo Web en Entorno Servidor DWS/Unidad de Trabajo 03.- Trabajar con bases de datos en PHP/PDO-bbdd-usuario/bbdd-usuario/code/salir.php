<?php

/*
	Elimina la sesión abierta en conexion_bbdd.php
*/

session_start();        

$_SESSION = [];				// Borra todas las variables creadas

session_destroy();			// Destruye la sesion iniciada con session_start() en conexion_bbdd.php

echo "Usted ha salido correctamente de la aplicación";

exit;
?>
