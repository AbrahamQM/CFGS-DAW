<?php
/**
 * Archivo: proceso_login.php
 * Descripción: Contiene la función validarLogin().
 * Se encarga de comprobar las credenciales del usuario contra la base de datos.
 * Si son correctas, se inicia la sesión y se devuelve JSON con success=true.
 * Si son incorrectas, se devuelve JSON con success=false y un mensaje de error.
 */

session_start(); // Se inicia la sesión

require __DIR__ . '/../bbdd/conexion_bbdd.php'; // Se carga la conexión a la base de datos
global $pdo;

// Se obtienen los datos enviados por fetch
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

// Se consulta la tabla usuarios para comprobar credenciales
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password");
$stmt->execute(['usuario' => $usuario, 'password' => $password]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Credenciales correctas: se inicia sesión y se devuelve success=true
    $_SESSION['usuario'] = $usuario;
    echo json_encode(['success' => true]);
} else {
    // Credenciales incorrectas: se devuelve success=false y mensaje de error
    echo json_encode(['success' => false, 'message' => 'Credenciales erróneas']);
}
