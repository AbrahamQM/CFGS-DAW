<?php
/**
 * Archivo: funciones.php
 * Descripción: Funciones comunes para trabajar con vecinos.dat
 */

// Ruta al fichero de datos
define("FICHERO_VECINOS", __DIR__ . "/../data/vecinos.dat");

/**
 * Lee todos los vecinos del fichero .dat
 * Devuelve un array de arrays (cada vecino es un array de campos)
 */
function leerVecinos() {
    $vecinos = [];
    $archivo = fopen(FICHERO_VECINOS, "r");
    $linea_num = 0;

    while (($linea = fgets($archivo)) !== false) {
        $linea_num++;
        if ($linea_num == 1) {
            continue; // saltar cabecera
        }
        $campos = explode("|", trim($linea));
        if (count($campos) < 11) {
            continue;
        }
        $vecinos[] = $campos;
    }
    fclose($archivo);
    return $vecinos;
}

/**
 * Añade un nuevo vecino al fichero
 */
function altaVecino($datos) {
    $nuevaLinea = implode("|", $datos) . "\n";
    file_put_contents(FICHERO_VECINOS, $nuevaLinea, FILE_APPEND);
}

/**
 * Valida un login contra el fichero vecinos.dat
 * Devuelve un array con [ok, nombre, rol] si es correcto
 * o [false, null, null] si falla
 */
function validarLogin($usuario, $password) {
    $vecinos = leerVecinos();

    foreach ($vecinos as $v) {
        list($nombre_apellidos, $dni, $telefono, $correo, $vivienda, $fechaAlta,
             $cuotasPagadas, $cuotasPendientes, $fechaUltima, $rolVecino, $passVecino) = $v;

        if (($usuario === $dni || $usuario === $correo) && $password === $passVecino) {
            return [true, $nombre_apellidos, $rolVecino];
        }
    }

    return [false, null, null];
}
