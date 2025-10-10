<?php
/**
 * Archivo: presidente.php
 * Descripción: Página de bienvenida para el rol "presidente".
 * Muestra todos los datos de los vecinos y permite gestionar cuotas
 * (cuotas pagadas y fecha de la última cuota pagada).
 */

session_start();
require_once "bbdd/conexion_bbdd.php"; // Conexión a la base de datos
require_once "procesos/funciones.php"; // Para leer vecinos y actualizar

// Verificamos rol
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'presidente') {
    header("Location: login.php");
    exit;
}

$nombre = $_SESSION['usuario']; //usuario en sesión

// --- Procesamiento de actualización de cuotas ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_vivienda'])) {
    $idVivienda = (int) $_POST['id_vivienda'];
    $cuotasPagadas = isset($_POST['cuotasPagadas']) ? (int) $_POST['cuotasPagadas'] : 0;
    $fechaUltima = $_POST['fechaUltima'] ?? date("Y-m-d");

    actualizarCuotasPorViviendaId($idVivienda, $fechaUltima, $pdo);
    // Redirigir para evitar reenvío del formulario al refrescar
    header("Location: presidente.php");
    exit;
}

// Leemos los datos de todos los vecinos, sus viviendas y sus cuotas desde bbdd
$filas = leerViviendasConVecinos($pdo);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Página del Presidente</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <main>
        <h2>Bienvenido, <?php echo htmlspecialchars($nombre); ?> (presidente)</h2>
        <p>
            Desde esta página puedes visualizar todos los datos de los vecinos y gestionar las cuotas.
            <br>Recuerda que <strong>solo necesitas indicar la fecha de la última cuota pagada; el sistema calculará
                automáticamente el número de cuotas pagadas y las pendientes.</strong>.
            <br>Las cuotas pendientes no incluyen el mes en curso.
        </p>

        <table>
            <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Vivienda</th>
                <th>Fecha Alta</th>
                <th>Cuotas Pagadas</th>
                <th>Cuotas Pendientes</th>
                <th>Última Cuota</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($filas as $f): ?>
                <tr>
                    <td><?= htmlspecialchars($f['nombre'] ?? '---') ?></td>
                    <td><?= htmlspecialchars($f['dni'] ?? '---') ?></td>
                    <td><?= htmlspecialchars($f['telefono'] ?? '---') ?></td>
                    <td><?= htmlspecialchars($f['email'] ?? '---') ?></td>
                    <td><?= htmlspecialchars(($f['bloque'] ?? '') . '-' . ($f['piso'] ?? '') . ($f['letra'] ?? '')) ?></td>
                    <td><?= htmlspecialchars($f['fecha_alta'] ?? '---') ?></td>

                    <form action="presidente.php" method="post">
                        <td><?= htmlspecialchars($f['cuotas_pagadas'] ?? 0) ?></td>
                        <td><?= htmlspecialchars($f['cuotas_impagadas'] ?? 0) ?></td>
                        <td>
                            <input type="date" name="fechaUltima"
                                value="<?= htmlspecialchars($f['fecha_ultima_cuota'] ?? '') ?>">
                        </td>
                        <td><?= htmlspecialchars($f['rol'] ?? '---') ?></td>
                        <td>
                            <input type="hidden" name="id_vivienda" value="<?= htmlspecialchars($f['id_vivienda'] ?? 0) ?>">
                            <input type="submit" value="Actualizar">
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <a href="procesos/logout.php" class="boton">Cerrar sesión</a>
    </main>
</body>

</html>