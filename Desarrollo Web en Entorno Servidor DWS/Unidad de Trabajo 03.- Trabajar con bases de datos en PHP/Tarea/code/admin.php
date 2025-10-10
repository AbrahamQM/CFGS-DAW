<?php
/**
 * Archivo: admin.php
 * Descripción: Página de bienvenida para el rol "administrador".
 * Muestra todos los vecinos y ofrece formularios para dar de alta, baja y modificar datos.
 */

session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit;
}

require_once "bbdd/conexion_bbdd.php";
require_once "procesos/funciones.php";

$nombre = $_SESSION['nombre'] ?? $_SESSION['usuario'];

// Procesar modificación si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
    $idVivienda = (int) $_POST['id_vivienda'];
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $fechaUltima = $_POST['fechaUltima'] ?? null;

    // Actualizar datos de contacto del vecino
    actualizarDatosVecino($idVivienda, $telefono, $correo, $pdo);

    // Actualizar cuotas automáticamente a partir de la fecha
    if (!empty($fechaUltima)) {
        actualizarCuotasPorViviendaId($idVivienda, $fechaUltima, $pdo);
    }

    header("Location: admin.php");
    exit;
}

// Leer todos los vecinos con sus viviendas y cuotas
$filas = leerViviendasConVecinos($pdo);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Página del Administrador</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <main>
        <h2>Bienvenido, <?= htmlspecialchars($nombre) ?> (administrador)</h2>
        <p>Listado completo de vecinos registrados en la comunidad:</p>
<!-- se agrupan los campos modificables para mejorar la apariencia y que quepan todos los datos de forma visible -->
        <table>
            <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Vivienda</th>
                <th>Fecha Alta</th>
                <th>Cuotas Pagadas</th>
                <th>Cuotas Pendientes</th>
                <th>Rol</th>
                <th>Datos modificables</th>
                <th>Eliminar</th>
            </tr>
            <?php foreach ($filas as $f): ?>
                <tr>
                    <td><?= htmlspecialchars($f['nombre']) ?></td>
                    <td><?= htmlspecialchars($f['dni']) ?></td>
                    <td><?= htmlspecialchars(($f['bloque'] ?? '') . '-' . ($f['piso'] ?? '') . ($f['letra'] ?? '')) ?></td>
                    <td><?= htmlspecialchars($f['fecha_alta'] ?? '') ?></td>
                    <td><?= htmlspecialchars($f['cuotas_pagadas'] ?? 0) ?></td>
                    <td><?= htmlspecialchars($f['cuotas_impagadas'] ?? 0) ?></td>
                    <td><?= htmlspecialchars($f['rol']) ?></td>

                    <!-- Celda con todos los campos editables -->
                    <td>
                        <form method="post" action="admin.php" style="display:flex; flex-direction:column; gap:6px;">
                            <input type="text" name="telefono" value="<?= htmlspecialchars($f['telefono'] ?? '') ?>"
                                placeholder="Teléfono">
                            <input type="email" name="correo" value="<?= htmlspecialchars($f['email'] ?? '') ?>"
                                placeholder="Correo">
                            <input type="date" name="fechaUltima"
                                value="<?= htmlspecialchars($f['fecha_ultima_cuota'] ?? '') ?>">
                            <input type="hidden" name="id_vivienda" value="<?= htmlspecialchars($f['id_vivienda']) ?>">
                            <input type="submit" name="modificar" value="Modificar">
                        </form>
                    </td>

                    <!-- Celda de eliminación -->
                    <td>
                        <form action="procesos/baja_vecino.php" method="post"
                            onsubmit="return confirm('¿Seguro que quieres eliminar a este vecino?');">
                            <input type="hidden" name="id_vivienda" value="<?= htmlspecialchars($f['id_vivienda']) ?>">
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>


        <h3>Dar de alta un nuevo vecino</h3>
        <form action="procesos/alta_vecino.php" method="post">
            <label>Nombre y Apellidos:</label><br>
            <input type="text" name="nombre" required><br><br>

            <label>DNI:</label><br>
            <input type="text" name="dni" required><br><br>

            <label>Teléfono:</label><br>
            <input type="text" name="telefono"><br><br>

            <label>Correo:</label><br>
            <input type="email" name="correo"><br><br>

            <label>Piso:</label><br>
            <input type="text" name="piso"><br><br>

            <label>Bloque:</label><br>
            <input type="text" name="bloque"><br><br>

            <label>Letra:</label><br>
            <input type="text" name="letra"><br><br>

            <label>Fecha de alta:</label><br>
            <input type="date" name="fechaAlta"><br><br>

            <label>Rol:</label><br>
            <select name="rol">
                <option value="vecino">Vecino</option>
                <option value="presidente">Presidente</option>
            </select><br><br>

            <label>Contraseña:</label><br>
            <input type="password" name="password" required><br><br>

            <input type="submit" value="Dar de alta">
        </form>

        <br>
        <a href="procesos/logout.php" class="boton">Cerrar sesión</a>
    </main>
</body>

</html>