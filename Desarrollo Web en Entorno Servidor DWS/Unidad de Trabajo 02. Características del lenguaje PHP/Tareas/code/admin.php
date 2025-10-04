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

require_once "procesos/funciones.php";

$vecinos = leerVecinos();
$nombre = $_SESSION['nombre'];

// Procesar modificación si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
    $dni = $_POST['dni'];
    $viviendaOriginal = $_POST['vivienda_original']; // la vivienda original (clave)
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $nuevaVivienda = $_POST['vivienda'];             // la nueva vivienda (editable)
    $cuotasPagadas = (int)$_POST['cuotasPagadas'];
    $fechaUltima = $_POST['fechaUltima'];

    // Actualizamos cuotas y datos de esa unidad
    actualizarCuotasPorVivienda($dni, $viviendaOriginal, $cuotasPagadas, $fechaUltima);
    actualizarDatosUnidad($dni, $viviendaOriginal, $telefono, $correo, $nuevaVivienda);

    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página del Administrador</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($nombre); ?> (administrador)</h2>
    <p>Listado completo de vecinos registrados en la comunidad:</p>

    <table border="1" style="border-collapse: collapse; padding: 5px;">
        <tr>
            <th>Nombre</th><th>DNI</th><th>Teléfono</th><th>Correo</th>
            <th>Vivienda</th><th>Fecha Alta</th><th>Cuotas Pagadas</th>
            <th>Cuotas Pendientes</th><th>Última Cuota</th><th>Rol</th>
            <th>Modificar</th><th>Eliminar</th>
        </tr>
        <?php foreach ($vecinos as $v): ?>
        <tr>
            <!-- Formulario de modificación -->
            <form method="post" action="admin.php">
                <?php for ($i = 0; $i < 10; $i++): ?>
                    <td>
                        <?php
                        if ($i === 2 || $i === 3 || $i === 4 || $i === 6 || $i === 8) {
                            // Campos editables: teléfono, correo, vivienda, cuotas pagadas, fecha última cuota
                            $nameMap = [
                                2 => "telefono",
                                3 => "correo",
                                4 => "vivienda",
                                6 => "cuotasPagadas",
                                8 => "fechaUltima"
                            ];
                            $type = ($i === 6) ? "number" : (($i === 8) ? "date" : "text");
                            echo "<input type='$type' name='{$nameMap[$i]}' value='" . htmlspecialchars($v[$i]) . "'>";
                        } else {
                            echo htmlspecialchars($v[$i]);
                        }
                        ?>
                    </td>
                <?php endfor; ?>
                <td>
                    <input type="hidden" name="dni" value="<?= htmlspecialchars($v[1]) ?>">
                    <input type="hidden" name="vivienda_original" value="<?= htmlspecialchars($v[4]) ?>">
                    <input type="submit" name="modificar" value="Modificar">
                </td>
            </form>
            <!-- Formulario de eliminación -->
            <td>
                <form action="procesos/baja_vecino.php" method="post" 
                      onsubmit="return confirm('¿Seguro que quieres eliminar a este vecino?');">
                    <input type="hidden" name="dni" value="<?= htmlspecialchars($v[1]) ?>">
                    <input type="hidden" name="vivienda" value="<?= htmlspecialchars($v[4]) ?>">
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

        <label>Vivienda (ej: B1-2A):</label><br>
        <input type="text" name="vivienda"><br><br>

        <label>Fecha de alta:</label><br>
        <input type="date" name="fechaAlta"><br><br>

        <label>Cuotas pagadas:</label><br>
        <input type="number" name="cuotasPagadas" value="0"><br><br>

        <label>Fecha última cuota pagada:</label><br>
        <input type="date" name="fechaUltima"><br><br>

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
</body>
</html>
