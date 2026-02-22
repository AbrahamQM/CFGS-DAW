<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>

	<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>

	<?php
	/**
	 * Procesa la modificación de una residencia escolar.
	 *
	 * Este script recibe los datos enviados desde F_modificarresidencias.php,
	 * prepara los parámetros necesarios y ejecuta la sentencia UPDATE para
	 * modificar la residencia en la base de datos. Si la modificación no se
	 * realiza, muestra un mensaje de error; si es correcta, redirige al listado.
	 *
	 * @author Abraham
	 * @version 1.0
	 * @since 2026
	 */

	try {
		/** Conexión a la base de datos */
		include 'Conexion.php';

		/**
		 * Conversión del checkbox "Comedor".
		 *
		 * @var int $Comedor 0 = comedor disponible, 1 = no disponible
		 */
		if ($_POST['Comedor'] == true) {
			$Comedor = 0;
		} elseif ($_POST['Comedor'] == null) {
			$Comedor = 1;
		}

		/**
		 * Datos enviados al UPDATE.
		 *
		 * @var array $datos Contiene: nombre, universidad, precio, comedor, codResidencia
		 */
		$datos = array($_POST['nomResidencia'], $_POST['codUniversidad'], $_POST['precioMensual'], $Comedor, $_POST['codResidencia']);

		/**
		 * Sentencia SQL para modificar la residencia.
		 *
		 * @var PDOStatement $stmt
		 */
		$stmt = $pdo->prepare('UPDATE residencias SET nomResidencia=?,codUniversidad=?,precioMensual=?,Comedor=? WHERE codResidencia=?');
		$stmt->execute($datos);

		/**
		 * Comprobación del resultado de la modificación.
		 */
		if ($stmt->rowcount() == 0) {
			$pdo = null;

			echo "Error: modificacion no realizada.";
			echo "<meta http-equiv='refresh' content='2; url=http://localhost/PHP/ResidenciaEscolares.php'>";
		} else {
			$pdo = null;

			header('Location: http://localhost/PHP/ResidenciaEscolares.php');
		}
	} catch (PDOException $err) {
		/**
		 * Captura de errores SQL o de conexión.
		 *
		 * @param PDOException $err
		 */
		echo "Error: ejecutando SQL.";
		echo $err->getMessage();
	}

	?>

</body>

</html>