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

/*$stmt=$pdo->query('SELECT codResidencia,nomResidencia,codUniversidad,precioMensual,Comedor FROM residencias ORDER BY codResidencia');*/
$stmt=$pdo->prepare('SELECT codResidencia,nomResidencia,codUniversidad,precioMensual,Comedor FROM residencias ORDER BY codResidencia');
$stmt->execute();

echo "<table align='center' border='2' cellpadding='5'>";
echo "<tr><th>codResidencia</th><th>nomResidencia</th>
             <th>codUniversidad</th>  <th>precioMensual</th>
						 <th>Comedor</th>  
						 <th>Borrado</th>
						<th>Modificación</th>						 
		 </tr>";

while ($row = $stmt->fetch())
	{  echo "<tr bgcolor='#FFFF99'>";
	   echo "<td>".$row['codResidencia']."</td>";
        echo "<td>".$row['nomResidencia']."</td>";
		echo "<td>".$row['codUniversidad']."</td>";
		echo "<td>".$row['precioMensual']."</td>";
		
		if ($row['Comedor']=='0')
			{echo "<td>SI</td>";
			}
		else
			{echo "<td>NO</td>";};
		
		
		echo "<td><form action='F_borrarresidencias.php' method='post'>
			<p>
			<input type='hidden' value='".$row['codResidencia']."' name='codResidencia'>
			<input type='submit' value='Borrar' name='Borra'>
</p></form></td>";
echo "<td><form action='F_modificarresidencias.php' method='post'>
			<p>
			<input type='hidden' value='".$row['codResidencia']."' name='codResidencia'>
			<input type='submit' value='Modificar' name='Modifica'>
</p></form></td>";
        echo "</tr>";
	
}
echo"</table></center>";
echo "<br/><center>Numero de residencias escolares: <b>".$stmt->rowCount()."</b><center>"; 
$pdo=null;
?>
<br/>

<form action="F_altaresidencias.php" method="post">
<p align="center"><input type="submit" value="Alta Residencias" name="Alta">
</p>
</form>

</body>
</html>