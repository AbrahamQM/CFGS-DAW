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
	 * Formulario de confirmación de borrado de una residencia escolar.
	 *
	 * Este script recibe el código de una residencia mediante POST, consulta sus datos
	 * en la base de datos y muestra un resumen para que el usuario confirme si desea
	 * eliminarla. El formulario resultante envía los datos a borrarresidencias.php.
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
	 * @var array $datos Contiene el código de la residencia a consultar
	 */
	$datos = array($_POST['codResidencia']);

	/**
	 * Consulta SQL para obtener los datos completos de la residencia seleccionada.
	 *
	 * @var PDOStatement $stmt Sentencia preparada para recuperar la residencia
	 */
	$stmt = $pdo->prepare('SELECT codResidencia,nomResidencia,codUniversidad,precioMensual,Comedor FROM residencias WHERE codResidencia=?');
	$stmt->execute($datos);

	/**
	 * Recuperación del registro encontrado.
	 *
	 * @var array $row Datos de la residencia
	 */
	$row = $stmt->fetch();

	echo "Deseas realmente eliminar los datos de la siguiente Residencia:<br>";
	echo "codResidencia: " . $row['codResidencia'] . "<br>";
	echo "nomResidencia: " . $row['nomResidencia'] . "<br>";
	echo "codUniversidad: " . $row['codUniversidad'] . "<br>";
	echo "precioMensual: " . $row['precioMensual'] . "<br>";

	/**
	 * Visualización del estado del comedor.
	 */
	if ($row['Comedor'] == '0') {
		echo "Comedor: SI<br><br>";
	} else {
		echo "Comedor: NO<br><br>";
	}
	;

	$pdo = null;

	/**
	 * Formulario para confirmar el borrado.
	 *
	 * Envía el código de residencia a borrarresidencias.php mediante POST.
	 */
	echo "<br><form action='borrarresidencias.php' method='post'>
            <p>
            <input type='hidden' value='" . $row['codResidencia'] . "' name='codResidencia'>
            <input type='submit' value='Borrar Residencia' name='Borra'><br>";
	echo "";

	?>
	<input type="button" value="Cancelar Borrado" onclick="window.location.replace('ResidenciaEscolares.php');">
	<br />
	</p>
	</form>

</body>

</html>