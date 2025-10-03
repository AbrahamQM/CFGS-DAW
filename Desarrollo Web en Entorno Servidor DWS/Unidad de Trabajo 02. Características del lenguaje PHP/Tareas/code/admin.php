<?php
/**
 * Archivo: admin.php
 * Descripción: Página de bienvenida para el rol "administrador".
 * Muestra todos los vecinos y ofrece un formulario para dar de alta nuevos.
 */

session_start();

// Comprobamos que el usuario haya iniciado sesión y que su rol sea administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit;
}

// Importamos las funciones comunes
require_once "procesos/funciones.php";

// Obtenemos todos los vecinos desde el fichero .dat
$vecinos = leerVecinos();

$nombre = $_SESSION['nombre'];
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
            <th>Eliminar</th>
        </tr>
        <?php foreach ($vecinos as $v) { ?>
        <tr>
            <?php
                // Mostramos todos los campos menos la contraseña
                for ($i = 0; $i < 10; $i++) {
                    echo "<td>" . htmlspecialchars($v[$i]) . "</td>";
                    if ($i === 9) {
                        // Añadimos columna de acciones solo en la última iteración
                        echo "<td>
                            <form action='procesos/baja_vecino.php' method='post' 
                                onsubmit=\"return confirm('¿Seguro que quieres eliminar a este vecino?');\">
                                <input type='hidden' name='dni' value='" . htmlspecialchars($v[1]) . "'>
                                <input type='submit' value='Eliminar'>
                            </form>
                        </td>";
                    }
                }
            ?>
        </tr>
        <?php } ?>
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
