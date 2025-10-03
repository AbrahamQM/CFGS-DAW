<?php
/**
 * Archivo: alta_vecino.php
 * Descripción: Procesa el formulario de alta de un nuevo vecino.
 * Valida los datos y añade una nueva línea al fichero vecinos.dat.
 */

session_start();
require "funciones.php";

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
//asignación de fecha alta teniendo en cuenta que por defecto es hoy y validando el formato
$fechaAltaTexto = $_POST['fechaAlta'] ?? null;
$fechaAltaObj = DateTime::createFromFormat('Y-m-d', $fechaAltaTexto) ?: new DateTime();
$fechaAlta = $fechaAltaObj->format('Y-m-d');
$cuotasPagadas = $_POST['cuotasPagadas'] ?? 0;
//asignación de fecha ultima cuota teniendo en cuenta que puede no existir y validando el formato
$fechaUltimaTexto = $_POST['fechaUltima'] ?? null;
$fechaUltimaObj = DateTime::createFromFormat('Y-m-d', $fechaUltimaTexto);
$fechaUltima = $fechaUltimaObj ? $fechaUltimaObj->format('Y-m-d') : "---";
$rol = $_POST['rol'] ?? 'vecino';
$password = $_POST['password'] ?? '';

//Validaciones básicas
if ($nombre === '' || $dni === '' || $password === '') {
    die("❌ Error: Nombre, DNI y contraseña son obligatorios. <a href='../admin.php'>Volver</a>");
}

// validación si esa vivienda ya existe, y cumplimos con que el rol sea vecino o presidente(que tambien puede tener vivienda)
if($rol === 'vecino' || $rol === 'presidente') {
    $vecinos = leerVecinos();
    foreach ($vecinos as $v) {
        if ($v[4] === $vivienda) {
            die("❌ Error: La vivienda ya está asignada a otro vecino. <a href='../admin.php'>Volver</a>");
        }
    }
}

//validacion si el rol es vecino la vivienda no puede estar vacia
if($rol === 'vecino' && $vivienda === '') {
    die("❌ Error: La vivienda es obligatoria para el rol vecino. <a href='../admin.php'>Volver</a>");
}

//validacicion  si la fecha de alta no es mayor a feche de ultima cuota
if($fechaUltima !== "---" && strtotime($fechaUltima) < strtotime($fechaAlta)) {
    die("❌ Error: La fecha de la última cuota no puede ser anterior a la fecha de alta. <a href='../admin.php'>Volver</a>");
}

// Calculamos cuotas pendientes la fecha de la última cuota
echo "entra en el calculo de cuotas pendientes fecha alta = $fechaAlta, fecha última $fechaUltima<br>";
$cuotasPendientes = calcularCuotasPendientes($fechaAlta, $fechaUltima) ;
echo "<br>cuotas pendientes calculadas: $cuotasPendientes<br>";


// Construimos la línea a añadir
// $nuevaLinea = $nombre . "|" . $dni . "|" . $telefono . "|" . $correo . "|" . $vivienda . "|" .
//               $fechaAlta . "|" . $cuotasPagadas . "|" . $cuotasPendientes . "|" . $fechaUltima . "|" .
//               $rol . "|" . $password . "\n";

// Añadimos al fichero
// file_put_contents("../data/vecinos.dat", $nuevaLinea, FILE_APPEND);

// Redirigimos de vuelta al admin
// header("Location: ../admin.php");
// exit;
?>
