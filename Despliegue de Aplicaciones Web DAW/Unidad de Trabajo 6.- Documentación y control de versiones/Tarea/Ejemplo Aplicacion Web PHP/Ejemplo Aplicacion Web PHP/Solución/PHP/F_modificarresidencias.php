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
	 * Formulario de modificación de residencias escolares.
	 *
	 * Este script recibe un código de residencia mediante POST, consulta sus datos
	 * actuales en la base de datos y genera un formulario con los valores precargados
	 * para que el usuario pueda modificarlos. El formulario resultante se envía a
	 * modificarresidencias.php.
	 *
	 * También genera dinámicamente el combo de universidades y el checkbox de comedor.
	 *
	 * @author Abraham
	 * @version 1.0
	 * @since 2026
	 */

	/** Conexión a la base de datos */
	include 'Conexion.php';

	/**
	 * Datos recibidos desde el formulario anterior.
	 *
	 * @var array $datos Contiene el código de residencia a modificar
	 */
	$datos = array($_POST['codResidencia']);

	/**
	 * Consulta SQL para obtener los datos actuales de la residencia.
	 *
	 * @var PDOStatement $stmt
	 */
	$stmt = $pdo->prepare('SELECT codResidencia,nomResidencia,codUniversidad,precioMensual,Comedor FROM residencias WHERE codResidencia=?');
	$stmt->execute($datos);

	/**
	 * Registro de la residencia seleccionada.
	 *
	 * @var array $row
	 */
	$row = $stmt->fetch();

	/**
	 * Consulta SQL para obtener todas las universidades.
	 *
	 * @var PDOStatement $stmt1
	 */
	$stmt1 = $pdo->prepare('SELECT codUniversidad,nomUniversidad FROM universidades');
	$stmt1->execute();

	/**
	 * Construcción del combo de universidades.
	 *
	 * @var string $Universidad HTML del <select> con las universidades
	 */
	$Universidad = "Cod. Universidad....<select name='codUniversidad'>";

	/**
	 * Construcción del checkbox de comedor según el valor actual.
	 *
	 * @var string $Comedor HTML del checkbox
	 */
	if ($row['Comedor'] == '0') {
		$Comedor = "Comedor....<input type='checkbox' checked name='Comedor'><br>";
	} else {
		$Comedor = "Comedor<input type='checkbox' name='Comedor'><br>";
	}
	;

	$Universidad = "Cod. Universidad....<select name='codUniversidad'>";

	while ($row1 = $stmt1->fetch()) {
		if ($row1['codUniversidad'] == $row['codUniversidad']) {
			$Universidad = $Universidad . "<option value='" . $row1['codUniversidad'] . "' selected>" . $row1['nomUniversidad'];
		} else {
			$Universidad = $Universidad . "<option value='" . $row1['codUniversidad'] . "'>" . $row1['nomUniversidad'];
		}
	}
	$Universidad = $Universidad . "</select>";

	/**
	 * Generación del formulario con los datos precargados.
	 */
	echo "<br><form action='modificarresidencias.php' method='post'>
            Cod. Residencia...." . $row['codResidencia'] . "
            <input type='hidden' value='" . $row['codResidencia'] . "' name='codResidencia'><br>
            Nom. Residencia....<input type='text' value='" . $row['nomResidencia'] . "' name='nomResidencia'><br>" . $Universidad . "<br>
            Precio Mensual....<input type='text' value='" . $row['precioMensual'] . "'name='precioMensual'><br>" . $Comedor . "
            <input type='submit' value='Modifica Residencia' name='Modifica'><br>";

	$pdo = null;

	?>
	<input type="button" value="Cancelar Modificación" onclick="window.location.replace('ResidenciaEscolares.php');">
	<br />
	</p>
	</form>

</body>

</html>