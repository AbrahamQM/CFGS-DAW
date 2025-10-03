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
    
    if (!file_exists(FICHERO_VECINOS)) {
        return $vecinos;
    }
    
    if (!$archivo = @fopen(FICHERO_VECINOS, "r")) {
        return $vecinos;
    }

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
        // Solo necesitamos nombre, dni, correo, rol y contraseña
        list($nombre_apellidos, $dni, , $correo, , , , , , $rolVecino, $passVecino) = $v;

        if (($usuario === $dni || $usuario === $correo) && $password === $passVecino) {
            return [true, $nombre_apellidos, $rolVecino];
        }
    }

    return [false, null, null];
}


/**
 * Calcula el número de cuotas pendientes desde la fecha de alta o última cuota
 * hasta el primer día del mes en curso (excluyendo el mes actual).
 * $fechaAlta Fecha de alta en formato 'Y-m-d'
 * $fechaUltimaTexto Fecha de última cuota pagada en formato 'Y-m-d' o '---'
 * Devuelve Número de cuotas pendientes
 */
function calcularCuotasPendientes($fechaAlta, $fechaUltimaTexto) {
    // Determinar punto de partida: si no hay cuotas pagadas, usamos fecha de alta
    $fechaInicioTexto = ($fechaUltimaTexto === "---") ? $fechaAlta : $fechaUltimaTexto;

    // Intentamos crear el objeto DateTime
    $fechaInicio = DateTime::createFromFormat('Y-m-d', $fechaInicioTexto);
    if (!$fechaInicio) {
        return 0; // Si el formato es inválido, devolvemos 0 por seguridad
    }

    // Normalizamos al primer día del mes
    $fechaInicio->modify('first day of this month');

    // Calculamos hasta el primer día del mes actual (excluyendo el mes en curso)
    $hoy = new DateTime();
    $hoy->modify('first day of this month');

    $intervalo = $fechaInicio->diff($hoy);
    return ($intervalo->y * 12) + $intervalo->m -1; // Restamos 1 para excluir el mes actual
}
