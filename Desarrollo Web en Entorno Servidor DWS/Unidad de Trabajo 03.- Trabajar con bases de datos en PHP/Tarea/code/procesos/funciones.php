<?php
/**
 * Archivo: funciones.php
 * Descripción: Funciones comunes para trabajar con las diferentes páginas y la base de datos.
 */


/**
 * Lee los datos de un vecino específico identificado por id.
 * Devuelve un array con los datos del vecino, viviendas y cuotas o null si no se encuentra.
 */
function leerVecino($id, $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM vecino where id_usuario=:id"); // JOIN vivienda on vivienda.id_vecino=vecino.id
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


/**
 * Lee todas las viviendas y las cuotas de cada una para un vecino específico identificado por id.
 * Devuelve un array de arrays con los datos de las viviendas o vacío si no tiene.
 */
function leerViviendasVecino($id, $pdo)
{
    $stmt = $pdo->prepare("
        SELECT
            v.id AS id_vivienda,
            v.piso,
            v.bloque,
            v.letra,
            c.cuotas_pagadas,
            c.cuotas_impagadas,
            c.fecha_ultima_cuota
        FROM vivienda v
        LEFT JOIN cuota c ON v.id = c.id_vivienda
        WHERE v.id_vecino = :id
    ");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Actualiza los datos personales de un vecino (teléfono y correo).
 */
function actualizarVecino($idUsuario, $telefono, $correo, $pdo)
{
    $stmt = $pdo->prepare("
        UPDATE vecino
        SET telefono = :telefono,
            email = :correo
        WHERE id_usuario = :id
    ");
    return $stmt->execute([
        ':telefono' => $telefono,
        ':correo' => $correo,
        ':id' => $idUsuario
    ]);
}

/**
 * Actualiza la contraseña de un usuario.
 */
function actualizarPassword($idUsuario, $password, $pdo)
{
    $stmt = $pdo->prepare("
        UPDATE usuario
        SET pass = :pass
        WHERE id = :id
    ");
    return $stmt->execute([
        ':pass' => $password,
        ':id' => $idUsuario
    ]);
}


/**
 * Devuelve todas las viviendas con los datos del vecino asociado y sus cuotas.
 * Estructura para pantalla del presidente.
 */
function leerViviendasConVecinos($pdo)
{
    $stmt = $pdo->prepare("
        SELECT
            v.id           AS id_vecino,
            v.nombre,
            v.dni,
            v.telefono,
            v.email,
            v.fecha_alta,
            u.rol,
            viv.id         AS id_vivienda,
            viv.piso,
            viv.bloque,
            viv.letra,
            c.cuotas_pagadas,
            c.cuotas_impagadas,
            c.fecha_ultima_cuota
        FROM vecino v
        JOIN usuario u        ON u.id = v.id_usuario
        LEFT JOIN vivienda viv ON viv.id_vecino = v.id
        LEFT JOIN cuota c      ON c.id_vivienda = viv.id AND c.id_vecino = v.id
        ORDER BY v.nombre, viv.id
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Actualiza o inserta el registro de cuotas asociado a una vivienda concreta.
 *
 * A partir de la fecha de alta del vecino y la fecha de la última cuota pagada,
 * calcula automáticamente el número de cuotas pagadas y las pendientes.
 * Recibe:
 * idVivienda   → identificador único de la vivienda en la tabla vivienda
 * fechaUltima  → fecha de la última cuota pagada (formato 'Y-m-d')
 * pdo          → conexión activa a la base de datos
 *
 * El método persiste en la tabla cuota los valores de cuotas_pagadas,
 * cuotas_impagadas y fecha_ultima_cuota, manteniéndolos consistentes.
 */

function actualizarCuotasPorViviendaId($idVivienda, $fechaUltima, $pdo) {
    // Resolver id_vecino y fecha_alta asociada a esa vivienda
    $stmt = $pdo->prepare("
        SELECT v.id AS id_vecino, v.fecha_alta
        FROM vivienda viv
        JOIN vecino v ON v.id = viv.id_vecino
        WHERE viv.id = :idVivienda
        LIMIT 1
    ");
    $stmt->execute([':idVivienda' => $idVivienda]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) { // Vivienda no encontrada
        return false;
    }

    $idVecino  = (int)$row['id_vecino'];
    $fechaAlta = $row['fecha_alta'];

    // Calcular cuotas pagadas = meses entre alta y fechaUltima
    $pagadas = 0;
    if (!empty($fechaUltima)) {
        $inicio = new DateTime($fechaAlta);
        $fin    = new DateTime($fechaUltima);
        if ($fin >= $inicio) {
            $diff = $inicio->diff($fin);
            $pagadas = $diff->y * 12 + $diff->m + 1; // +1 para contar el mes de la última cuota
        }
    }

    // Calcular cuotas pendientes con la función auxiliar
    $pendientes = calcularCuotasPendientes($fechaAlta, $fechaUltima);

    // Comprobar si existe registro de cuota
    $stmt = $pdo->prepare("
        SELECT id FROM cuota
        WHERE id_vivienda = :idVivienda AND id_vecino = :idVecino
        LIMIT 1
    ");
    $stmt->execute([':idVivienda' => $idVivienda, ':idVecino' => $idVecino]);
    $existe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existe) {
        $stmt = $pdo->prepare("
            UPDATE cuota
            SET cuotas_pagadas = :pagadas,
                cuotas_impagadas = :pendientes,
                fecha_ultima_cuota = :fechaUltima
            WHERE id = :idCuota
        ");
        return $stmt->execute([
            ':pagadas'     => $pagadas,
            ':pendientes'  => $pendientes,
            ':fechaUltima' => $fechaUltima,
            ':idCuota'     => $existe['id']
        ]);
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO cuota (id_vivienda, id_vecino, cuotas_pagadas, cuotas_impagadas, fecha_ultima_cuota)
            VALUES (:idVivienda, :idVecino, :pagadas, :pendientes, :fechaUltima)
        ");
        return $stmt->execute([
            ':idVivienda'  => $idVivienda,
            ':idVecino'    => $idVecino,
            ':pagadas'     => $pagadas,
            ':pendientes'  => $pendientes,
            ':fechaUltima' => $fechaUltima
        ]);
    }
}



/**
 * Calcula el número de cuotas pendientes desde la fecha de alta o última cuota
 * hasta el primer día del mes en curso (excluyendo el mes actual).
 *
 * $fechaAlta Fecha de alta en formato 'Y-m-d'
 * $fechaUltima Fecha de última cuota pagada en formato 'Y-m-d' o null
 * devuelve Número de cuotas pendientes o 0
 */
function calcularCuotasPendientes($fechaAlta, $fechaUltima = null) {
    // Determinar punto de partida: si no hay cuotas pagadas, usamos fecha de alta
    $fechaInicioTexto = (empty($fechaUltima) || $fechaUltima === '---') ? $fechaAlta : $fechaUltima;

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
    $meses = ($intervalo->y * 12) + $intervalo->m;

    return $meses > 0 ? $meses - 1 : 0;
}


// /**
//  * Añade un nuevo vecino al fichero
//  */
// function altaVecino($datos) {
//     $nuevaLinea = implode("|", $datos) . "\n";
//     file_put_contents(FICHERO_VECINOS, $nuevaLinea, FILE_APPEND);
// }

// /**
//  * Calcula el número de cuotas pendientes desde la fecha de alta o última cuota
//  * hasta el primer día del mes en curso (excluyendo el mes actual).
//  * $fechaAlta Fecha de alta en formato 'Y-m-d'
//  * $fechaUltimaTexto Fecha de última cuota pagada en formato 'Y-m-d' o '---'
//  * Devuelve Número de cuotas pendientes
//  */
// function calcularCuotasPendientes($fechaAlta, $fechaUltimaTexto) {
//     // Determinar punto de partida: si no hay cuotas pagadas, usamos fecha de alta
//     $fechaInicioTexto = ($fechaUltimaTexto === "---") ? $fechaAlta : $fechaUltimaTexto;

//     // Intentamos crear el objeto DateTime
//     $fechaInicio = DateTime::createFromFormat('Y-m-d', $fechaInicioTexto);
//     if (!$fechaInicio) {
//         return 0; // Si el formato es inválido, devolvemos 0 por seguridad
//     }

//     // Normalizamos al primer día del mes
//     $fechaInicio->modify('first day of this month');

//     // Calculamos hasta el primer día del mes actual (excluyendo el mes en curso)
//     $hoy = new DateTime();
//     $hoy->modify('first day of this month');

//     $intervalo = $fechaInicio->diff($hoy);
//     $intervalo = ($intervalo->y * 12) + $intervalo->m;
//     return $intervalo > 0 ? $intervalo -1 : 0; // Restamos 1 para excluir el mes actual
// }

// /**
//  * Actualiza los datos de una vivienda concreta identificada por $dni y $vivienda.
//  *
//  * $dni: DNI del vecino
//  * $vivienda: vivienda actual (clave única junto con el DNI)
//  * $nuevoTelefono: nuevo teléfono
//  * $nuevoCorreo: nuevo correo
//  * $nuevaVivienda: nueva vivienda (si se quiere modificar)
//  */
// function actualizarDatosUnidad($dni, $vivienda, $nuevoTelefono, $nuevoCorreo, $nuevaVivienda) {
//     $vecinos = leerVecinos();
//     $encontrado = false;

//     foreach ($vecinos as &$v) {
//         if ($v[1] === $dni && $v[4] === $vivienda) {
//             $v[2] = $nuevoTelefono;
//             $v[3] = $nuevoCorreo;
//             $v[4] = $nuevaVivienda;
//             $encontrado = true;
//             break;
//         }
//     }
//     unset($v);

//     if ($encontrado) {
//         $lineas = [];
//         $lineas[] = "nombre|dni|telefono|correo|vivienda|fechaAlta|cuotasPagadas|cuotasPendientes|fechaUltima|rol|password";
//         foreach ($vecinos as $v) {
//             if ($v[0] === "nombre" && $v[1] === "dni") continue;
//             $lineas[] = implode("|", $v);
//         }
//         file_put_contents(FICHERO_VECINOS, implode("\n", $lineas) . "\n");
//     }

//     return $encontrado;
// }
