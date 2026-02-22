<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<h1 align="center">Autor: David</h1>
<h1 align="center">Formulario de alta Residencias Escolares</h1><br>

<form action="altaresidencias.php" method="post">
<p>
Nom. Residencia....<input type="text" name="nomResidencia"><br>

<?php

include 'Conexion.php';

$stmt1=$pdo->prepare('SELECT codUniversidad,nomUniversidad FROM universidades');
$stmt1->execute();

$Universidad = "Cod. Universidad....<select name='codUniversidad'>";

while ($row1 = $stmt1->fetch())
	{if ($row1['codUniversidad']=='Ull')
		{$Universidad = $Universidad."<option value='".$row1['codUniversidad']."' selected>".$row1['nomUniversidad'];}
	else
		{$Universidad = $Universidad."<option value='".$row1['codUniversidad']."'>".$row1['nomUniversidad'];}
	}	
$Universidad = $Universidad."</select>";
echo $Universidad;

?>					

<br>	
Precio Mensual....<input type="text" name="precioMensual"><br>
Comedor....<input type="checkbox" name="Comedor" checked><br>
<input type="submit" value="Dar de alta" name="Alta"><br>
<input type="reset" value="Limpiar Datos" name="Limpiar"><br><br>
<input type="button" value="Cancelar alta" onclick="window.location.replace('ResidenciaEscolares.php');">

</p></form> 

</body>
</html>