<?php
/**
 * Archivo: vecinos.php
 * Descripción: Página de bienvenida para el rol "vecino".
 * Muestra únicamente los datos del vecino que ha iniciado sesión.
 * Ahora permite editar teléfono, correo y contraseña, aplicando los cambios a todas sus viviendas.
 */

session_start();

// Comprobamos que el usuario haya iniciado sesión y que su rol sea vecino
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'vecino') {
    header("Location: login.php");
    exit;
}

$nombre = $_SESSION['nombre'];
$usuario = $_SESSION['usuario']; // puede ser DNI o correo

require_once "procesos/funciones.php";
$vecinos = leerVecinos();
$misViviendas = [];

// Recogemos todas las viviendas del vecino (puede tener varias)
foreach ($vecinos as $v) {
    if ($usuario === $v[1] || $usuario === $v[3]) {
        $misViviendas[] = $v;
    }
}

// Procesamos el formulario si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoTelefono = $_POST['telefono'] ?? '';
    $nuevoCorreo = $_POST['correo'] ?? '';
    $nuevaPassword = $_POST['password'] ?? '';

    // Actualizamos los datos en todas sus viviendas
    actualizarDatosVecino($usuario, $nuevoTelefono, $nuevoCorreo, $nuevaPassword);

    // Redirigimos para evitar reenvío del formulario
    header("Location: vecinos.php");
    exit;
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
    <h2>Bienvenido, <?php echo htmlspecialchars($nombre); ?> (vecino)</h2>
    <p>Estas son tus viviendas registradas:</p>

    <table border="1" style="border-collapse: collapse; padding: 5px;">
        <tr>
            <th>Nombre</th><th>DNI</th><th>Teléfono</th><th>Correo</th>
            <th>Vivienda</th><th>Fecha Alta</th><th>Cuotas Pagadas</th>
            <th>Cuotas Pendientes</th><th>Última Cuota</th>
        </tr>
        <?php foreach ($misViviendas as $v): ?>
        <tr>
            <?php for ($i = 0; $i < 9; $i++): ?>
                <td><?= htmlspecialchars($v[$i]) ?></td>
            <?php endfor; ?>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Actualizar tus datos personales</h3>
    <form method="post" action="vecinos.php">
        <label>Teléfono: <input type="text" name="telefono" value="<?= htmlspecialchars($misViviendas[0][2]) ?>"></label><br>
        <label>Correo: <input type="email" name="correo" value="<?= htmlspecialchars($misViviendas[0][3]) ?>"></label><br>
        <label>Contraseña: <input type="text" name="password" value="<?= htmlspecialchars($misViviendas[0][10]) ?>"></label><br>
        <input type="submit" value="Guardar cambios">
    </form>

    <br>
    <a href="procesos/logout.php" class="boton">Cerrar sesión</a>
</body>
</html>
