<?php
/**
 * Archivo: mostrar.php
 * Descripción: Muestra las preferencias almacenadas en la sesión del usuario.
 * Si se pulsa "Borrar", se eliminan y se muestra el mensaje correspondiente.
 */
session_start(); // Activamos sesión para acceder a las preferencias

// Post del botón "Borrar"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar'])) {
    if(!isset($_SESSION['preferencias'])) { //si no están seteadas las preferencias mensaje de error
        $_SESSION['mensaje_borrado'] = "Debes fijar primero las preferencias";
    }else{ //si lo están, las borramos y mensaje de éxito
        unset($_SESSION['preferencias']); // Elimina los datos preferencias de la sesion
        $_SESSION['mensaje_borrado'] = "Preferencias borradas";
    }

    header("Location: mostrar.php");
    exit;
}

// constante para valor no establecido
define('NO_ESTABLECIDO', 'No establecido');
// Preparar valores a mostrar
$idioma = $_SESSION['preferencias']['idioma'] ?? NO_ESTABLECIDO;
$perfil = $_SESSION['preferencias']['perfil'] ?? NO_ESTABLECIDO;
$zona = $_SESSION['preferencias']['zona_horaria'] ?? NO_ESTABLECIDO;

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Preferencias</title>
    <!-- Hoja de estilos principal -->
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <main>
        <h2>Preferencias</h2>

        <?php
        // Mensaje si se han borrado las preferencias
        if (isset($_SESSION['mensaje_borrado'])) {
            echo "<p style='color: red; font-weight: bold; text-align: center;'>" . $_SESSION['mensaje_borrado'] . "</p>";
            unset($_SESSION['mensaje_borrado']); // Lo quitamos para que no se repita
        }
        ?>

        <!-- Listado de preferencias -->
        <div style="margin-top: 20px;">
            <p><strong>Idioma:</strong> <?= htmlspecialchars($idioma) ?></p>
            <p><strong>Perfil público:</strong> <?= htmlspecialchars($perfil) ?></p>
            <p><strong>Zona horaria:</strong> <?= htmlspecialchars($zona) ?></p>
        </div>

        <!-- Botones de acción -->
        <form method="post" style="margin-top: 30px;">
            <input type="submit" name="borrar" value="Borrar" class="borrar">
            <a href="preferencias.php">Establecer</a>
        </form>

    </main>
</body>

</html>