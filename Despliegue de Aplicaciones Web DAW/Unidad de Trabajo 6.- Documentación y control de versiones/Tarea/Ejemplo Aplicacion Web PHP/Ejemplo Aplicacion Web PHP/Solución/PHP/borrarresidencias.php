<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<?php
try
	{include 'Conexion.php';

	echo $_POST['codResidencia'];

	$datos= array($_POST['codResidencia']);

	$stmt=$pdo->prepare('DELETE FROM residencias WHERE codResidencia=?');
	$stmt->execute($datos);

	if ($stmt->rowcount() == 0) 
		{$pdo=null;
	
		echo "Error: borrado no realizada."; 
		echo "<meta http-equiv='refresh' content='2; url=http://localhost/PHP/ResidenciaEscolares.php'>";
		}
	else
		{$pdo=null;
	
		header('Location: http://localhost/PHP/ResidenciaEscolares.php');}
	}
catch(PDOException $err)
	{
	// Mostramos un mensaje genérico de error.
	echo "Error: ejecutando SQL."; 
	echo $err->getMessage();
	}

?>

</body>
</html>