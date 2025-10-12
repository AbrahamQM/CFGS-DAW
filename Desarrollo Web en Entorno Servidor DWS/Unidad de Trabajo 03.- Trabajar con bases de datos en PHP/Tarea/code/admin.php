<?php
/**
 * Archivo: admin.php
 * Descripción: Página de bienvenida para el rol "administrador".
 * Muestra todos los vecinos y ofrece formularios para dar de alta, baja y modificar datos.
 */
//Muestro errores si los hay para depurar
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Incluimos la conexión a la base de datos y funciones
require_once __DIR__ . '/bbdd/conexion_bbdd.php';
require_once __DIR__ . '/procesos/funciones.php';


if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit;
}


$nombre = $_SESSION['nombre'] ?? $_SESSION['usuario'];

// Procesar modificación si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
    $idVivienda = (int) $_POST['id_vivienda'];
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $fechaUltima = $_POST['fechaUltima'] ?? null;
    $idVecino = (int) $_POST['id_vecino'];

    // Actualizar datos de contacto del vecino
    actualizarVecino($idVecino, $telefono, $correo, $pdo);

    // Actualizar cuotas automáticamente a partir de la fecha
    if (!empty($fechaUltima)) {
        actualizarCuotasPorViviendaId($idVivienda, $fechaUltima, $pdo);
    }

    header("Location: admin.php");
    exit;
}

// Procesar alta si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alta'])) {
    // Recogemos datos del formulario
    $datos = [
        'usuario' => trim($_POST['usuario'] ?? ''),
        'password' => trim($_POST['password'] ?? ''),
        'nombre' => trim($_POST['nombre'] ?? ''),
        'apellidos' => trim($_POST['apellidos'] ?? ''),
        'dni' => trim($_POST['dni'] ?? ''),
        'telefono' => trim($_POST['telefono'] ?? ''),
        'correo' => trim($_POST['correo'] ?? ''),
        'piso' => trim($_POST['piso'] ?? ''),
        'bloque' => trim($_POST['bloque'] ?? ''),
        'letra' => trim($_POST['letra'] ?? ''),
        'vivienda' => trim($_POST['vivienda'] ?? ''),
        //asignación de fecha alta teniendo en cuenta que por defecto es hoy
        'fechaAlta' => $_POST['fechaAlta'] ? new DateTime($_POST['fechaAlta']) : new DateTime(),
        'fechaUltima' => $_POST['fechaUltima'] ? new DateTime($_POST['fechaAlta']) : null,
        'rol' => $_POST['rol'] ?? 'vecino'
    ];

    $error = altaVecino($datos, $pdo);
    if ($error) {
        die($error);
    }

    header("Location: admin.php");
    exit;
}

// Procesar baja si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['baja'])) {
    $idVivienda = (int) $_POST['id_vivienda'];
    $idVecino = (int) $_POST['id_vecino'];

    $error = bajaVecinoOVivienda($idVivienda, $idVecino, $pdo);
    if ($error) {
        die($error);
    }

    header("Location: admin.php");
    exit;
}



// Leer todos los vecinos con sus viviendas y cuotas
$viviendasConVecinos = leerViviendasConVecinos($pdo);
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
        <p>Listado completo de vecinos registrados en la comunidad.</p>
        <p>*La fecha modificable corresponde a la fecha de la última cuota.</p>
        <!-- se agrupan los campos modificables para mejorar la apariencia y que quepan todos los datos de forma visible -->
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Vivienda</th>
                <th>Fecha Alta</th>
                <th>Cuotas Pagadas</th>
                <th>Cuotas Pendientes</th>
                <th>Rol</th>
                <th>Datos modificables</th>
                <th>Eliminar</th>
            </tr>
            <?php foreach ($viviendasConVecinos as $registro): ?>
                <tr>
                    <td><?= htmlspecialchars($registro['nombre']) ?></td>
                    <td><?= htmlspecialchars($registro['apellidos']) ?></td>
                    <td><?= htmlspecialchars($registro['dni']) ?></td>
                    <td><?= htmlspecialchars(($registro['bloque'] ?? '') . '-' . ($registro['piso'] ?? '') . ($registro['letra'] ?? '')) ?>
                    </td>
                    <td><?= htmlspecialchars($registro['fecha_alta'] ?? '') ?></td>
                    <td><?= htmlspecialchars($registro['cuotas_pagadas'] ?? 0) ?></td>
                    <td><?= htmlspecialchars($registro['cuotas_impagadas'] ?? 0) ?></td>
                    <td><?= htmlspecialchars($registro['rol']) ?></td>

                    <!-- Celda con todos los campos editables -->
                    <td>
                        <form method="post" action="admin.php" style="display:flex; flex-direction:column; gap:6px;">
                            <input type="text" name="telefono" value="<?= htmlspecialchars($registro['telefono'] ?? '') ?>"
                                placeholder="Teléfono">
                            <input type="email" name="correo" value="<?= htmlspecialchars($registro['email'] ?? '') ?>"
                                placeholder="Correo">
                            <input type="date" name="fechaUltima"
                                value="<?= htmlspecialchars($registro['fecha_ultima_cuota'] ?? '') ?>">
                            <input type="hidden" name="id_vivienda"
                                value="<?= htmlspecialchars($registro['id_vivienda']) ?>">
                            <input type="hidden" name="id_vecino" value="<?= htmlspecialchars($registro['id_vecino']) ?>">
                            <input type="submit" name="modificar" value="Modificar">
                        </form>
                    </td>

                    <!-- Celda de eliminación -->
                    <td>
                        <form method="post" action="admin.php"
                            onsubmit="return confirm('¿Seguro que quieres eliminar esta vivienda? \nAtención, si es la única vivienda de este propietario, se eliminará también el propietario!');">
                            <input type="hidden" name="id_vivienda"
                                value="<?= htmlspecialchars($registro['id_vivienda']) ?>">
                            <input type="hidden" name="id_vecino" value="<?= htmlspecialchars($registro['id_vecino']) ?>">
                            <input type="submit" name="baja" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>


        <h3>Dar de alta un nuevo vecino</h3>

        <form action="admin.php" method="post">

            <label>*Usuario:</label><br>
            <input type="text" name="usuario" required><br><br>

            <label>*Contraseña:</label><br>
            <input type="password" name="password" required><br><br>

            <label>*Nombre:</label><br>
            <input type="text" name="nombre" required><br><br>

            <label>*Apellidos:</label><br>
            <input type="text" name="apellidos" required><br><br>

            <label>*DNI:</label><br>
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

            <label>Fecha de última cuota:</label><br>
            <input type="date" name="fechaUltima"><br><br>

            <label>Rol:</label><br>
            <select name="rol">
                <option value="vecino">Vecino</option>
                <option value="presidente">Presidente</option>
            </select><br><br>


            <input type="submit" name="alta" value="alta">
        </form>

        <br>
        <a href="procesos/logout.php" class="boton">Cerrar sesión</a>
    </main>
</body>

</html>