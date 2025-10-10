<?php
/**
 * Archivo: vecinos.php
 * Descripción: Página de bienvenida para el rol "vecino".
 * Muestra únicamente los datos del vecino que ha iniciado sesión.
 * Permite editar teléfono, correo y contraseña, aplicando los cambios a todas sus viviendas.
 */
//Muestro errores si los hay para depurar
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Incluimos la conexión a la base de datos y funciones
require_once __DIR__ . '/bbdd/conexion_bbdd.php';
require_once __DIR__ . '/procesos/funciones.php';

// Comprobamos que el usuario haya iniciado sesión y que su rol sea vecino
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'vecino') {
    header("Location: login.php");
    exit;
}


$vecino = leerVecino($_SESSION['id'], $pdo);
$nombre = $vecino['nombre'];
$viviendas = leerViviendasVecino($_SESSION['id'], $pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';

    // Actualizar datos personales
    actualizarVecino($_SESSION['id'], $telefono, $correo, $pdo);

    // Actualizar contraseña solo si se ha cambiado
    if (!empty($password) && $password !== $_SESSION['password']) {
        actualizarPassword($_SESSION['id'], $password, $pdo);
        $_SESSION['password'] = $password; // actualizamos el dato de la sesión
    }

    // Refrescar datos del vecino
    $vecino = leerVecino($_SESSION['id'], $pdo);
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
    <main>
        <h2>Bienvenido, <?php echo htmlspecialchars($nombre); ?> (vecino/a)</h2>
        <h3>Estas son tus viviendas registradas:</h3>

        <table border="1" style="border-collapse: collapse; padding: 5px;">
            <tr>
                <th>ID Vivienda</th>
                <th>Piso</th>
                <th>Bloque</th>
                <th>Letra</th>
                <th>Cuotas Pagadas</th>
                <th>Cuotas Impagadas</th>
                <th>Última Cuota</th>
            </tr>
            <?php foreach ($viviendas as $v): ?>
                <tr>
                    <td><?= htmlspecialchars($v['id_vivienda'] ?? '---') ?></td>
                    <td><?= htmlspecialchars($v['piso'] ?? '---') ?></td>
                    <td><?= htmlspecialchars($v['bloque'] ?? '---') ?></td>
                    <td><?= htmlspecialchars($v['letra'] ?? '---') ?></td>
                    <td><?= htmlspecialchars($v['cuotas_pagadas'] ?? '---') ?></td>
                    <td><?= htmlspecialchars($v['cuotas_impagadas'] ?? '---') ?></td>
                    <td><?= htmlspecialchars($v['fecha_ultima_cuota'] ?? '---') ?></td>

                </tr>
            <?php endforeach; ?>
        </table>
        <h3>Tus datos personales</h3>
        <form method="post" action="vecinos.php">
            <label>Teléfono:
                <input type="text" name="telefono" value="<?= htmlspecialchars($vecino['telefono'] ?? '') ?>">
            </label><br>

            <label>Correo:
                <input type="email" name="correo" value="<?= htmlspecialchars($vecino['email'] ?? '') ?>">
            </label><br>

            <label>Contraseña:
                <input type="password" name="password" value="<?= htmlspecialchars($_SESSION['password'] ?? '') ?>">
            </label><br>
            <input type="submit" value="Guardar cambios">
        </form>

        <br>
        <a href="procesos/logout.php" class="boton">Cerrar sesión</a>
    </main>
</body>

</html>