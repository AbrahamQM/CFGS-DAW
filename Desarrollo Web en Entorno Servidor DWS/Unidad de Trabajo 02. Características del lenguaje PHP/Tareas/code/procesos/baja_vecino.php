<?php
/**
 * Descripción: Script para dar de baja (eliminar) un vecino del fichero vecinos.dat
 * 
 * Flujo:
 *  1. Recibe el DNI del vecino a eliminar mediante POST.
 *  2. Lee todos los vecinos del fichero usando leerVecinos() de funciones.php.
 *  3. Filtra el array eliminando al vecino cuyo DNI coincida.
 *  4. Reescribe el fichero vecinos.dat con los vecinos restantes.
 *  5. Muestra un mensaje de confirmación.
 */

require_once "funciones.php";

// Solo aceptamos peticiones POST por seguridad
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recogemos el DNI enviado desde el formulario
    $dni = $_POST['dni'] ?? null;

    if (!$dni) {
        die("Error: no se ha proporcionado un DNI válido.");
    }

    // Leemos todos los vecinos actuales
    $vecinos = leerVecinos();

    // Filtramos los que NO coinciden con el DNI a eliminar
    $vecinosRestantes = array_filter($vecinos, function($v) use ($dni) {
        return $v[1] !== $dni; // El campo [1] corresponde al DNI
    });

    // Preparamos las líneas para reescribir el fichero
    $lineas = [];
    // Cabecera (debe coincidir con la estructura de vecinos.dat)
    $lineas[] = "nombre|dni|telefono|correo|vivienda|fechaAlta|cuotasPagadas|cuotasPendientes|fechaUltima|rol|password";

    // Añadimos los vecinos restantes
    foreach ($vecinosRestantes as $v) {
        $lineas[] = implode("|", $v);
    }

    // Sobrescribimos el fichero con los datos actualizados
    file_put_contents(FICHERO_VECINOS, implode("\n", $lineas) . "\n");

    // Mensaje de confirmación
    echo "✅ Vecino con DNI $dni eliminado correctamente.<a href='../admin.php'>Volver</a>";
} else {
    // Si alguien accede por GET, mostramos un error
    echo "Acceso no permitido. Este proceso solo acepta peticiones POST.";
}
