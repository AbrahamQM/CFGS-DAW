<?php
/**
 * Archivo: vecinos.php
 * Descripción: Página de bienvenida para el rol "vecino".
 * Muestra únicamente los datos del vecino que ha iniciado sesión.
 */
session_start();

// Comprobamos que el usuario haya iniciado sesión y que su rol sea vecino
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'vecino') {
    header("Location: login.php");
    exit;
}

$nombre = $_SESSION['nombre'];
$usuario = $_SESSION['usuario']; // puede ser DNI o correo

// Abrimos el fichero de datos
$archivo = fopen("data/vecinos.dat", "r");
$linea_num = 0;
$misDatos = [];

while (($linea = fgets($archivo)) !== false) {
    $linea_num++;
    if ($linea_num == 1) {
        continue; // saltar cabecera
    }

    $campos = explode("|", trim($linea));
    if (count($campos) < 11) {
        continue;
    }

    list($nombre_apellidos, $dni, $telefono, $correo, $vivienda, $fechaAlta,
         $cuotasPagadas, $cuotasPendientes, $fechaUltima, $rolVecino, $passVecino) = $campos;

    // Si coincide con el usuario logueado (DNI o correo), guardamos sus datos
    if ($usuario === $dni || $usuario === $correo) {
        $misDatos = $campos;
        break;
    }
}
fclose($archivo);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página del Vecino</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h2>Bienvenido, <?php echo $nombre; ?> (vecino)</h2>
    <p>Estos son tus datos registrados:</p>

    <table border="1" style="border-collapse: collapse; padding: 5px;">
        <tr>
            <th>Nombre</th><th>DNI</th><th>Teléfono</th><th>Correo</th>
            <th>Vivienda</th><th>Fecha Alta</th><th>Cuotas Pagadas</th>
            <th>Cuotas Pendientes</th><th>Última Cuota</th>
        </tr>
        <tr>
            <?php
            // Mostramos todos los campos menos el rol y la contraseña
            for ($i = 0; $i < 9; $i++) {
                echo "<td>" . htmlspecialchars($misDatos[$i]) . "</td>";
            }
            ?>
        </tr>
    </table>

    <br>
    <a href="procesos/logout.php">Cerrar sesión</a>
</body>
</html>
