<?php
/**
 * Archivo: procesos/proceso.php
 * Descripción: Procesa el formulario de login.
 * - Valida usuario y contraseña contra vecinos.dat usando funciones.php.
 * - Si el login es correcto, guarda datos en sesión y redirige según el rol.
 * - Si falla, muestra un mensaje de error y enlace para volver al login.
 */

session_start(); // Iniciamos la sesión para poder guardar datos del usuario

require_once "funciones.php"; // Importamos funciones comunes (leer datos, validar login)

// Recogemos los datos enviados por el formulario de login
$usuario = $_POST['usuario'] ?? '';   // Puede ser DNI o correo
$password = $_POST['password'] ?? ''; // Contraseña en texto plano (mejorar más adelante)

// Validamos el login contra el fichero .dat (encapsulado en funciones.php)
list($login_ok, $nombre, $rol) = validarLogin($usuario, $password);

// Si la validación es correcta, guardamos en sesión y redirigimos según rol
if ($login_ok) {
    // Guardamos datos mínimos necesarios para el resto de páginas
    $_SESSION['usuario'] = $usuario; // Identificador (DNI o correo)
    $_SESSION['nombre'] = $nombre;   // Nombre completo para saludo
    $_SESSION['rol'] = $rol;         // Rol para control de acceso

    // Redirección a la página correspondiente del rol
    if ($rol === "vecino") {
        header("Location: ../vecinos.php");
    } elseif ($rol === "presidente") {
        header("Location: ../presidente.php");
    } elseif ($rol === "administrador") {
        header("Location: ../admin.php");
    }
    exit; // Cortamos la ejecución tras redirigir
} else {
    // Si las credenciales no son válidas, informamos y ofrecemos volver al login
    echo "❌ Usuario o contraseña incorrectos. <a href='../login.php'>Volver</a>";
}
