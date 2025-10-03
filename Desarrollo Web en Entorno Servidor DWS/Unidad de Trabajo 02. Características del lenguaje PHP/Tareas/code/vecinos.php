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
require_once "procesos/funciones.php";
$vecinos = leerVecinos();
$usuario = $_SESSION['usuario'];
$misDatos = [];

foreach ($vecinos as $v) {
    if ($usuario === $v[1] || $usuario === $v[3]) { // DNI o correo
        $misDatos = $v;
        break;
    }
}

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
    <a href="procesos/logout.php" class="boton">Cerrar sesión</a>
</body>
</html>
