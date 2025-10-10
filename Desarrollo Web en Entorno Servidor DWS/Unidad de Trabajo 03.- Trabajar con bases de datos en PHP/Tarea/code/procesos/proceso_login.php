<?php
/**
 * Archivo: procesos/proceso_login
 * Descripción: Procesa el formulario de login.
 * - Valida usuario y contraseña contra vecinos.dat usando funciones.php.
 * - Si el login es correcto, guarda datos en sesión y redirige según el rol.
 * - Si falla, muestra un mensaje de error y enlace para volver al login.
 */

// Iniciamos la sesión para poder guardar datos del usuario

//Muestro errores si los hay
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Incluimos la conexión a la base de datos
require_once __DIR__ . '/../bbdd/conexion_bbdd.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recogemos los datos enviados por el formulario de login
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? ''; // Contraseña en texto plano

    $stmt = $pdo->prepare("SELECT id, usuario, rol FROM usuario where usuario=:usuario and pass=:pass");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':pass', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $rol = $row['rol'];
        // Guardamos datos mínimos necesarios para el resto de páginas
        $_SESSION['id'] = $row['id'];    // ID del usuario
        $_SESSION['usuario'] = $usuario; // Identificador (DNI o correo)
        $_SESSION['rol'] = $rol;         // Rol para control de acceso
        $_SESSION['password'] = $password; // Contraseña en texto plano

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
        echo "❌ Usuario o contraseña incorrectos. <a href='../login.php'>Volver</a>";
        exit;
    }
}