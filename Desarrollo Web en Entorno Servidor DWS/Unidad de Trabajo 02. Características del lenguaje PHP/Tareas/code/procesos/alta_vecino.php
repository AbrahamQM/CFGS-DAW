<?php
/**
 * Archivo: alta_vecino.php
 * Descripción: Procesa el formulario de alta de un nuevo vecino.
 * Valida los datos y añade una nueva línea al fichero vecinos.dat.
 */

session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit;
}

// Recogemos datos del formulario
$nombre = trim($_POST['nombre'] ?? '');
$dni = trim($_POST['dni'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$vivienda = trim($_POST['vivienda'] ?? '');
$fechaAlta = $_POST['fechaAlta'] ?? date("Y-m-d");
$cuotasPagadas = $_POST['cuotasPagadas'] ?? 0;
$fechaUltima = $_POST['fechaUltima'] ?? "---";
$rol = $_POST['rol'] ?? 'vecino';
$password = $_POST['password'] ?? '';

// Validaciones básicas
if ($nombre === '' || $dni === '' || $password === '') {
    die("❌ Error: Nombre, DNI y contraseña son obligatorios. <a href='admin.php'>Volver</a>");
}

// Calculamos cuotas pendientes (simplificado: 0 al dar de alta)
$cuotasPendientes = 0;

// Construimos la línea a añadir
$nuevaLinea = $nombre . "|" . $dni . "|" . $telefono . "|" . $correo . "|" . $vivienda . "|" .
              $fechaAlta . "|" . $cuotasPagadas . "|" . $cuotasPendientes . "|" . $fechaUltima . "|" .
              $rol . "|" . $password . "\n";

// Añadimos al fichero
file_put_contents("../data/vecinos.dat", $nuevaLinea, FILE_APPEND);

// Redirigimos de vuelta al admin
header("Location: ../admin.php");
exit;
?>
