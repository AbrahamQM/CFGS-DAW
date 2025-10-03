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
    $intervalo = ($intervalo->y * 12) + $intervalo->m;
    return $intervalo > 0 ? $intervalo -1 : 0; // Restamos 1 para excluir el mes actual
}

/**
 * Actualiza las cuotas de la vivienda identificada por $dni y $vivienda.
 *
 * $dni: DNI del vecino
 * $vivienda: identificador de la vivienda (ej. B1-2A)
 * $cuotasPagadas: nuevo número de cuotas pagadas
 * $fechaUltima: nueva fecha de la última cuota (formato Y-m-d)
 *
 * Recalcula automáticamente las cuotas pendientes con calcularCuotasPendientes($fechaAlta, $fechaUltima)
 * y reescribe el fichero vecinos.dat.
 */
function actualizarCuotasPorVivienda($dni, $vivienda, $cuotasPagadas, $fechaUltima) {
    $vecinos = leerVecinos();
    $encontrado = false;

    // Modificar en sitio
    foreach ($vecinos as &$v) {
        if ($v[1] === $dni && $v[4] === $vivienda) {
            $v[6] = $cuotasPagadas;
            $v[8] = $fechaUltima;
            $v[7] = calcularCuotasPendientes($v[5], $v[8]);
            $encontrado = true;
            break;
        }
    }
    unset($v); // 🔑 Romper la referencia para evitar sobrescrituras

    if ($encontrado) {
        $lineas = [];
        // Cabecera fija
        $lineas[] = "nombre|dni|telefono|correo|vivienda|fechaAlta|cuotasPagadas|cuotasPendientes|fechaUltima|rol|password";

        foreach ($vecinos as $v) {
            // Saltar la cabecera si leerVecinos() la incluye como primer registro
            if ($v[0] === "nombre" && $v[1] === "dni") {
                continue;
            }
            $lineas[] = implode("|", $v);
        }

        file_put_contents(FICHERO_VECINOS, implode("\n", $lineas) . "\n");
    }

    return $encontrado;
}

