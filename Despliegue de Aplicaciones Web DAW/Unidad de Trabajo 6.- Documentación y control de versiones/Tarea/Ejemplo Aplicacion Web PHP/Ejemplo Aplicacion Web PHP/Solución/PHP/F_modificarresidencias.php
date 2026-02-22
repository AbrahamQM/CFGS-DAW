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

$stmt1=$pdo->prepare('SELECT codUniversidad,nomUniversidad FROM universidades');
$stmt1->execute();

$Universidad = "Cod. Universidad....<select name='codUniversidad'>";

if ($row['Comedor']=='0')
	{$Comedor="Comedor....<input type='checkbox' checked name='Comedor'><br>";}
	else
	{$Comedor="Comedor<input type='checkbox' name='Comedor'><br>";};	

$Universidad = "Cod. Universidad....<select name='codUniversidad'>";

while ($row1 = $stmt1->fetch())
	{if ($row1['codUniversidad']==$row['codUniversidad'])
		{$Universidad = $Universidad."<option value='".$row1['codUniversidad']."' selected>".$row1['nomUniversidad'];}
	else
		{$Universidad = $Universidad."<option value='".$row1['codUniversidad']."'>".$row1['nomUniversidad'];}
	}	
$Universidad = $Universidad."</select>";

echo "<br><form action='modificarresidencias.php' method='post'>
			Cod. Residencia....".$row['codResidencia']."
			<input type='hidden' value='".$row['codResidencia']."' name='codResidencia'><br>
			Nom. Residencia....<input type='text' value='".$row['nomResidencia']."' name='nomResidencia'><br>".$Universidad."<br>
			Precio Mensual....<input type='text' value='".$row['precioMensual']."'name='precioMensual'><br>".$Comedor."
			<input type='submit' value='Modifica Residencia' name='Modifica'><br>";


$pdo=null;

?>
<input type="button" value="Cancelar Modificación" onclick="window.location.replace('ResidenciaEscolares.php');">
<br/>
</p></form> 

</body>
</html>