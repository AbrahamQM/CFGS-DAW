<?php
try {
	
	$host="localhost";
	$dbname="ResidenciasEscolares";
	$user="root";
	$pass="";

	$pdo= new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
	
	// Para que genere excepciones a la hora de reportar errores.
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $err) {
	echo $err->getMessage();
	}
?>