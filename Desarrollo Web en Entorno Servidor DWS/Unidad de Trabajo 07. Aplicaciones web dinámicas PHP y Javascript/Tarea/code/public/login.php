<?php
/**
 * Archivo: login.php
 * Página inicial de acceso a la aplicación de valoración de productos.
 * Formulario donde el usuario introduce su usuario y contraseña.
 * La validación se realiza mediante fetch(), mostrando mensajes de error sin recargar la página.
 * He descartado el uso de la librería Xajax en la práctica ya que no es compatible con PHP 8
 * debido al uso de funciones obsoletas. Directamente no podía cargar la página si usaba la librería.
 */

session_start(); // Se inicia la sesión para poder usar variables de sesión más adelante
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso a la aplicación de valoración</title>
    <!-- Se carga la hoja de estilos principal -->
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <main>
        <h2>Acceso a la aplicación de valoración de productos</h2>
        <!-- Formulario de login -->
        <!-- Al enviar el formulario se llama a la función validarLogin() vía fetch -->
        <form id="formLogin">
            <label for="usuario">Usuario:</label><br>
            <input type="text" id="usuario" name="usuario" required><br><br>

            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Entrar">
        </form>
        <!-- Div donde se mostrarán los mensajes de error o confirmación -->
        <div id="mensaje"></div>
    </main>

    <script>
    // Se añade un listener al formulario para interceptar el envío
    document.getElementById('formLogin').addEventListener('submit', async function(e) {
        e.preventDefault(); // Se evita la recarga de la página

        // Se obtienen los datos del formulario
        const formData = new FormData(this);

        try {
            // Se envían los datos al servidor mediante fetch
            const response = await fetch('../src/proceso_login.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                // Credenciales correctas: se redirige a listado.php
                window.location.href = 'listado.php';
            } else {
                // Credenciales incorrectas: se muestra mensaje de error
                document.getElementById('mensaje').innerHTML =
                    "<span style='color:red'>" + result.message + "</span>";
            }
        } catch (error) {
            document.getElementById('mensaje').innerHTML =
                "<span style='color:red'>Error de conexión con el servidor</span>";
        }
    });
    </script>
</body>
</html>
