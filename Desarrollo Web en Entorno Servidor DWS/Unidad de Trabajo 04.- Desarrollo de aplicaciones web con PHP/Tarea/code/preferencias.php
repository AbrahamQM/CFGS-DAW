<?php
/**
 * Archivo: preferencias.php
 * Descripción: Página inicial de la aplicacion donde se pueden establecer las preferencias de usuario.
 * una vez guardadas en la sesión, se establecen las preferencias seleccionadas como opciones por defecto.
 */
session_start(); // Iniciamos sesión para poder usar variables de sesión más adelante

// --- Procesamiento de actualización ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guardar preferencias en la sesión
    $_SESSION['preferencias'] = [
        'idioma' => $_POST['idioma'] ?? '',
        'perfil' => $_POST['perfil'] ?? '',
        'zona_horaria' => $_POST['zona_horaria'] ?? ''
    ];

    // Marcar que se han guardado
    $_SESSION['mensaje_preferencias'] = "Preferencias de usuario guardadas";

    // Redirigir para evitar reenvío del formulario
    header("Location: preferencias.php");
    exit;
}


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
        <h2>Preferencias de usuario</h2>

        <?php
        if (isset($_SESSION['mensaje_preferencias'])) {
            echo "<p style='color: green; font-weight: bold; text-align: center;'>" . $_SESSION['mensaje_preferencias'] . "</p>";
            unset($_SESSION['mensaje_preferencias']); // Elimino para que no se repita al acceder de nuevo
        }
        ?>

        <!-- Formulario de preferencias -->
        <form action="preferencias.php" method="post">
            <!-- Selección de idioma -->
            <label for="idioma">Idioma:</label><br>
            <select name="idioma" id="idioma">
                <option value="español" <?= ($_SESSION['preferencias']['idioma'] ?? '') === 'español' ? 'selected' : '' ?>>
                    Español</option>
                <option value="ingles" <?= ($_SESSION['preferencias']['idioma'] ?? '') === 'ingles' ? 'selected' : '' ?>>
                    Inglés</option>
            </select><br><br>

            <!-- Selección de perfil -->
            <label for="perfil">Perfil público:</label><br>
            <select name="perfil" id="perfil">
                <option value="si" <?= ($_SESSION['preferencias']['perfil'] ?? '') === 'si' ? 'selected' : '' ?>>
                    Sí</option>
                <option value="no" <?= ($_SESSION['preferencias']['perfil'] ?? '') === 'no' ? 'selected' : '' ?>>
                    No</option>
            </select><br><br>

            <!-- Selección de zona horaria -->
            <label for="zona_horaria">Zona horaria:</label><br>
            <select name="zona_horaria" id="zona_horaria">
                <option value="GMT-2" <?= ($_SESSION['preferencias']['zona_horaria'] ?? '') === 'GMT-2' ? 'selected' : '' ?>>
                    GMT-2</option>
                <option value="GMT-1" <?= ($_SESSION['preferencias']['zona_horaria'] ?? '') === 'GMT-1' ? 'selected' : '' ?>>
                    GMT-1</option>
                <option value="GMT" <?= ($_SESSION['preferencias']['zona_horaria'] ?? '') === 'GMT' ? 'selected' : '' ?>>
                    GMT</option>
                <option value="GMT+1" <?= ($_SESSION['preferencias']['zona_horaria'] ?? '') === 'GMT+1' ? 'selected' : '' ?>>
                    GMT+1</option>
                <option value="GMT+2" <?= ($_SESSION['preferencias']['zona_horaria'] ?? '') === 'GMT+2' ? 'selected' : '' ?>>
                    GMT+2</option>
            </select><br><br>


            <!-- Botones -->
            <input type="submit" value="Guardar preferencias">
            <br><br>
            <a href="mostrar.php">Mostrar preferencias</a>
        </form>

    </main>
</body>

</html>