<?php
/**
 * Archivo: presidente.php
 * Descripción: Página de bienvenida para el rol "presidente".
 * Muestra todos los datos de los vecinos y permite gestionar cuotas.
 */
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'presidente') {
    header("Location: login.php");
    exit;
}

$nombre = $_SESSION['nombre'];

// Abrimos el fichero de datos
require_once "procesos/funciones.php";
$vecinos = leerVecinos();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página del Presidente</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h2>Bienvenido, <?php echo $nombre; ?> (presidente)</h2>
    <p>Listado de todos los vecinos:</p>

    <table border="1" style="border-collapse: collapse; padding: 5px;">
        <tr>
            <th>Nombre</th><th>DNI</th><th>Teléfono</th><th>Correo</th>
            <th>Vivienda</th><th>Fecha Alta</th><th>Cuotas Pagadas</th>
            <th>Cuotas Pendientes</th><th>Última Cuota</th><th>Rol</th>
        </tr>
        <?php foreach ($vecinos as $v): ?>
        <tr>
            <?php
            // Mostramos todos los campos menos la contraseña que es el campo 10
            for ($i = 0; $i < 10; $i++) {
                echo "<td>" . htmlspecialchars($v[$i]) . "</td>";
            }
            ?>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="procesos/logout.php" class="boton">Cerrar sesión</a>

</body>
</html>
