<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>

	<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
	<h1 align="center">Autor: David</h1>
	<h1 align="center">Residencias Escolares</h1>

	<?php
	/**
	 * Página principal del sistema de gestión de residencias escolares.
	 *
	 * Este script muestra un listado completo de las residencias almacenadas en la base de datos.
	 * Cada fila incluye opciones para borrar o modificar la residencia seleccionada.
	 * También muestra el número total de residencias y un botón para dar de alta una nueva.
	 *
	 * La tabla se genera dinámicamente mediante una consulta SQL con PDO.
	 *
	 * @author Abraham
	 * @version 1.0
	 * @since 2026
	 * @copyright © 2026 Abraham. Todos los derechos reservados.
	 */

	/** Conexión a la base de datos */
	include 'Conexion.php';

	/**
	 * Consulta SQL para obtener todas las residencias.
	 *
	 * @var PDOStatement $stmt Sentencia preparada para recuperar residencias
	 */
	/*$stmt=$pdo->query('SELECT codResidencia,nomResidencia,codUniversidad,precioMensual,Comedor FROM residencias ORDER BY codResidencia');*/
	$stmt = $pdo->prepare('SELECT codResidencia,nomResidencia,codUniversidad,precioMensual,Comedor FROM residencias ORDER BY codResidencia');
	$stmt->execute();

	/** Inicio de la tabla HTML */
	echo "<table align='center' border='2' cellpadding='5'>";
	echo "<tr><th>codResidencia</th><th>nomResidencia</th>
             <th>codUniversidad</th>  <th>precioMensual</th>
                         <th>Comedor</th>  
                         <th>Borrado</th>
                        <th>Modificación</th>                        
         </tr>";

	/**
	 * Bucle que recorre todas las residencias y genera una fila por cada una.
	 *
	 * @var array $row Datos de cada residencia
	 */
	while ($row = $stmt->fetch()) {
		echo "<tr bgcolor='#FFFF99'>";
		echo "<td>" . $row['codResidencia'] . "</td>";
		echo "<td>" . $row['nomResidencia'] . "</td>";
		echo "<td>" . $row['codUniversidad'] . "</td>";
		echo "<td>" . $row['precioMensual'] . "</td>";

		/** Visualización del estado del comedor */
		if ($row['Comedor'] == '0') {
			echo "<td>SI</td>";
		} else {
			echo "<td>NO</td>";
		}
		;


		/** Botón de borrado */
		echo "<td><form action='F_borrarresidencias.php' method='post'>
            <p>
            <input type='hidden' value='" . $row['codResidencia'] . "' name='codResidencia'>
            <input type='submit' value='Borrar' name='Borra'>
</p></form></td>";

		/** Botón de modificación */
		echo "<td><form action='F_modificarresidencias.php' method='post'>
            <p>
            <input type='hidden' value='" . $row['codResidencia'] . "' name='codResidencia'>
            <input type='submit' value='Modificar' name='Modifica'>
</p></form></td>";
		echo "</tr>";

	}
	echo "</table></center>";

	/** Muestra el número total de residencias */
	echo "<br/><center>Numero de residencias escolares: <b>" . $stmt->rowCount() . "</b><center>";

	$pdo = null;
	?>
	<br />

	<form action="F_altaresidencias.php" method="post">
		<p align="center"><input type="submit" value="Alta Residencias" name="Alta">
		</p>
	</form>

</body>

</html>