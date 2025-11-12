<?php
/**
 * Archivo: proceso_voto.php
 * Recibe la petición de voto mediante fetch().
 * Inserta el voto si es la primera vez que el usuario valora un producto.
 * Devuelve JSON con la media de valoraciones y el número de votos.
 */
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start(); // Se inicia la sesión

require __DIR__ . '/../bbdd/conexion_bbdd.php';
global $pdo;

$usuario = $_SESSION['usuario'] ?? null;
$idProducto = $_POST['idProducto'] ?? null;
$puntuacion = $_POST['puntuacion'] ?? null;

if (!$usuario || !$idProducto || !$puntuacion) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit();
}

// Se comprueba si el usuario ya ha votado ese producto
$stmt = $pdo->prepare("SELECT * FROM votos WHERE idPr = :idPr AND idUs = :idUs");
$stmt->execute(['idPr' => $idProducto, 'idUs' => $usuario]);
$votoExistente = $stmt->fetch(PDO::FETCH_ASSOC);

// Si ya ha votado, se devuelve un error
if ($votoExistente) {
    echo json_encode(['success' => false, 'message' => 'Ya has valorado este producto']);
    exit();
}

// Si no ha votado en ese producto, se inserta el voto
// manejo de errores con try-catch para capturar errores durante el desarrollo
try{
    $stmt = $pdo->prepare("INSERT INTO votos (idPr, idUs, cantidad) VALUES (:idPr, :idUs, :cantidad)");
    $stmt->execute(['idPr' => $idProducto, 'idUs' => $usuario, 'cantidad' => $puntuacion]);
    
    // Se calcula la media y el número de votos
    $stmt = $pdo->prepare("SELECT ROUND(AVG(cantidad), 0) AS media, COUNT(*) AS votos FROM votos WHERE idPr = :idPr");
    $stmt->execute(['idPr' => $idProducto]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'media' => $resultado['media'],
        'votos' => $resultado['votos']
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en el proceso de voto',
        'error' => $e->getMessage() // opcional para depurar
    ]);
}
