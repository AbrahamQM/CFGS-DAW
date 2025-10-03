<?php
/**
 * Archivo: presidente.php
 * Descripción: Página de bienvenida para el rol "presidente".
 * Muestra todos los datos de los vecinos y permite gestionar cuotas
 * (cuotas pagadas y fecha de la última cuota pagada).
 */

session_start();
require_once "procesos/funciones.php"; // Para leer vecinos y actualizar

// Verificamos rol
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'presidente') {
    header("Location: login.php");
    exit;
}

$nombre = $_SESSION['nombre'];

// --- Procesamiento de actualización de cuotas ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dni'], $_POST['vivienda'])) {
    $dni = $_POST['dni'];
    $vivienda = $_POST['vivienda'];
    $cuotasPagadas = isset($_POST['cuotasPagadas']) ? (int)$_POST['cuotasPagadas'] : 0;
    $fechaUltima = $_POST['fechaUltima'] ?? date("Y-m-d");

    actualizarCuotasPorVivienda($dni, $vivienda, $cuotasPagadas, $fechaUltima);

    // Redirigir para evitar reenvío del formulario al refrescar
    header("Location: presidente.php");
    exit;
}

// Abrimos el fichero de datos
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
    <h2>Bienvenido, <?php echo htmlspecialchars($nombre); ?> (presidente)</h2>
    <p>
        Desde esta página puedes visualizar todos los datos de los vecinos y gestionar las cuotas. 
        Recuerda que <strong>si actualizas el número de cuotas pagadas, también debes actualizar la fecha de la última cuota pagada y viceversa</strong>.
    </p>

    <table border="1" style="border-collapse: collapse; padding: 5px;">
        <tr>
            <th>Nombre</th><th>DNI</th><th>Teléfono</th><th>Correo</th>
            <th>Vivienda</th><th>Fecha Alta</th><th>Cuotas Pagadas</th>
            <th>Cuotas Pendientes</th><th>Última Cuota</th><th>Rol</th><th>Acciones</th>
        </tr>
        <?php foreach ($vecinos as $v): ?>
        <tr>
            <?php
            // Mostramos los primeros 6 campos tal cual
            for ($i = 0; $i < 6; $i++) {
                echo "<td>" . htmlspecialchars($v[$i]) . "</td>";
            }
            ?>
            <!-- Formulario de edición de cuotas -->
            <form action="presidente.php" method="post">
                <td>
                    <input type="number" name="cuotasPagadas" value="<?= htmlspecialchars($v[6]) ?>" min="0">
                </td>
                <td><?= htmlspecialchars($v[7]) ?></td> <!-- Cuotas pendientes -->
                <td>
                    <input type="date" name="fechaUltima" value="<?= $v[8] !== '---' ? htmlspecialchars($v[8]) : '' ?>">
                </td>
                <td><?= htmlspecialchars($v[9]) ?></td> <!-- Rol -->
                <td>
                    <input type="hidden" name="dni" value="<?= htmlspecialchars($v[1]) ?>">
                    <input type="hidden" name="vivienda" value="<?= htmlspecialchars($v[4]) ?>">
                    <input type="submit" value="Actualizar">
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="procesos/logout.php" class="boton">Cerrar sesión</a>
</body>
</html>
