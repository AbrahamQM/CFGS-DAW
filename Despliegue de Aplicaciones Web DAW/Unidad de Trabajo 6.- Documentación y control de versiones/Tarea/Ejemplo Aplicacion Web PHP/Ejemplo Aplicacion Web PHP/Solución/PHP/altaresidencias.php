<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<?php
try
	{
	include 'Conexion.php';
	
	switch($_POST['Comedor'])
		{case true:
		$Comedor = 0; 
		break;
		case null:
		$Comedor = 1;
		break;
		}
		
	$datos= array($_POST['nomResidencia'],$_POST['codUniversidad'],$_POST['precioMensual'],$Comedor);

	$stmt=$pdo->prepare("Call Insertarresidencia(?,?,?,?,@UniversidadExiste,@InsercionCorreta)");

	$stmt->execute($datos);
	
	if ($stmt->rowcount() == 0) 
		{$pdo=null;
	
		echo "Error: inserción no realizada."; 
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