<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<h1 align="center">Autor: David</h1>
<h1 align="center">Residencias Escolares</h1>

<?php

include 'Conexion.php';

$datos= array($_POST['codResidencia']);

$stmt=$pdo->prepare('SELECT codResidencia,nomResidencia,codUniversidad,precioMensual,Comedor FROM residencias WHERE codResidencia=?');
$stmt->execute($datos);

$row= $stmt->fetch();
echo "Deseas realmente eliminar los datos de la siguiente Residencia:<br>";
echo "codResidencia: ".$row['codResidencia']."<br>";
echo "nomResidencia: ".$row['nomResidencia']."<br>";
echo "codUniversidad: ".$row['codUniversidad']."<br>";
echo "precioMensual: ".$row['precioMensual']."<br>";

if ($row['Comedor']=='0')
	{echo "Comedor: SI<br><br>";
	}
else
	{echo "Comedor: NO<br><br>";
	};

$pdo=null;

/*echo "<a href='borrarresidencias.php?codResidencia=".$row['codResidencia']."'>Aceptar Borrado</a><br><br>";
echo "<a href='ResidenciaEscolares.php'>Cancelar Borrado</a><br>";*/

echo "<br><form action='borrarresidencias.php' method='post'>
			<p>
			<input type='hidden' value='".$row['codResidencia']."' name='codResidencia'>
			<input type='submit' value='Borrar Residencia' name='Borra'><br>";
echo "";

?>
<input type="button" value="Cancelar Borrado" onclick="window.location.replace('ResidenciaEscolares.php');">
<br/>
</p></form> 

</body>
</html>