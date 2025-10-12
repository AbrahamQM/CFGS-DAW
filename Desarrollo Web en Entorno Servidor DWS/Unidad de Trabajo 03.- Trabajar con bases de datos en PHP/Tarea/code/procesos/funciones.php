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
 * Aparecen actualizados en todas las viviendas asociadas.
 */
function actualizarVecino($idVecino, $telefono, $correo, $pdo)
{
    $stmt = $pdo->prepare("
        UPDATE vecino
        SET telefono = :telefono,
            email = :correo
        WHERE id = :id
    ");
    $stmt->execute([
        ':telefono' => $telefono,
        ':correo' => $correo,
        ':id' => $idVecino
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
            COALESCE (v.apellidos, '---') AS apellidos,
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

function actualizarCuotasPorViviendaId($idVivienda, $fechaUltima, $pdo)
{
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

    $idVecino = (int) $row['id_vecino'];
    $fechaAlta = $row['fecha_alta'];

    // Calcular cuotas pagadas = meses entre alta y fechaUltima
    $pagadas = 0;
    if (!empty($fechaUltima)) {
        $inicio = new DateTime($fechaAlta);
        $fin = new DateTime($fechaUltima);
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
            ':pagadas' => $pagadas,
            ':pendientes' => $pendientes,
            ':fechaUltima' => $fechaUltima,
            ':idCuota' => $existe['id']
        ]);
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO cuota (id_vivienda, id_vecino, cuotas_pagadas, cuotas_impagadas, fecha_ultima_cuota)
            VALUES (:idVivienda, :idVecino, :pagadas, :pendientes, :fechaUltima)
        ");
        return $stmt->execute([
            ':idVivienda' => $idVivienda,
            ':idVecino' => $idVecino,
            ':pagadas' => $pagadas,
            ':pendientes' => $pendientes,
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
function calcularCuotasPendientes($fechaAlta, $fechaUltima = null)
{
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



/**
 * Añade un nuevo vecino
 * recibe todos los datos del formulario en el array $datos
 * pdo: conexión activa a la base de datos
 * Devuelve mensaje de error si hay problema o null si se ha dado de alta correctamente.
 * valida los requisitos de la tarea (único presidente, vivienda única, campos obligatorios, etc.)
 */
function altaVecino($datos, $pdo)
{
    // Validación: solo puede existir un presidente
    if ($datos['rol'] === 'presidente' && existePresidente($pdo)) {
        return "❌ Error: Ya existe un presidente en la comunidad.";
    }

    // Validación: vivienda ya asignada
    if (viviendaExistente($pdo, $datos['piso'], $datos['bloque'], $datos['letra'])) {
        return "❌ Error: La vivienda ya está asignada a otro vecino.";
    }

    // Buscar usuario existente
    $stmt = $pdo->prepare("SELECT id FROM usuario WHERE usuario = :usuario AND rol IN ('vecino','presidente')");
    $stmt->execute([':usuario' => $datos['usuario']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $idUsuario = $row['id'] ?? null;

    if (!$idUsuario) {
        // Validaciones básicas
        if ($datos['nombre'] === '' || $datos['apellidos'] === '' || $datos['dni'] === '' || $datos['password'] === '') {
            return "❌ Error: Nombre, apellidos, DNI y contraseña son obligatorios.";
        }

        // Crear usuario
        $stmt = $pdo->prepare("INSERT INTO usuario (usuario, pass, rol) VALUES (:usuario, :pass, :rol)");
        $stmt->execute([
            ':usuario' => $datos['usuario'],
            ':pass' => $datos['password'],
            ':rol' => $datos['rol']
        ]);
        $idUsuario = $pdo->lastInsertId();
    } else {// Usuario ya existe → actualizar rol si procede
        $stmt = $pdo->prepare("UPDATE usuario SET rol = :rol WHERE id = :id");
        $stmt->execute([':rol' => $datos['rol'], ':id' => $idUsuario]);
    }

    // Comprobación de vecino existente
    $stmt = $pdo->prepare("SELECT id FROM vecino WHERE id_usuario = :id LIMIT 1");
    $stmt->execute([':id' => $idUsuario]);
    $yaEsVecino = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$yaEsVecino) {
        // Insertar en vecino
        $stmt = $pdo->prepare("INSERT INTO vecino (id_usuario, nombre, apellidos, dni, telefono, email, fecha_alta)
                               VALUES (:id_usuario, :nombre, :apellidos, :dni, :telefono, :email, :fecha_alta)");
        $stmt->execute([
            ':id_usuario' => $idUsuario,
            ':nombre' => $datos['nombre'],
            ':apellidos' => $datos['apellidos'],
            ':dni' => $datos['dni'],
            ':telefono' => $datos['telefono'],
            ':email' => $datos['correo'],
            ':fecha_alta' => $datos['fechaAlta'] instanceof DateTime
                ? $datos['fechaAlta']->format('Y-m-d')
                : $datos['fechaAlta']
        ]);
        $idVecino = $pdo->lastInsertId();
    } else {
        // Ya existe vecino → usar su id
        $idVecino = $yaEsVecino['id'];
    }

    // Insertar en vivienda
    $stmt = $pdo->prepare("INSERT INTO vivienda (id_vecino, piso, bloque, letra)
                           VALUES (:id_vecino, :piso, :bloque, :letra)");
    $stmt->execute([
        ':id_vecino' => $idVecino,
        ':piso' => $datos['piso'],
        ':bloque' => $datos['bloque'],
        ':letra' => $datos['letra']
    ]);
    $idVivienda = $pdo->lastInsertId();

    // Crear cuotas iniciales si hay fecha última
    if (!empty($datos['fechaUltima'])) {
        $fechaUltima = $datos['fechaUltima'] instanceof DateTime ? $datos['fechaUltima']->format('Y-m-d') : $datos['fechaUltima'];
        actualizarCuotasPorViviendaId($idVivienda, $fechaUltima, $pdo);
    }

    return null; // correcto/sin errores
}


/**
 * Busca si ya existe un presidente en la comunidad.
 * Devuelve true si existe, false si no.
 */
function existePresidente($pdo)
{
    $stmt = $pdo->prepare("SELECT id FROM usuario WHERE rol = 'presidente' LIMIT 1");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
}


/**
 * Comprueba si ya existe una vivienda con la misma combinación de piso, bloque y letra.
 * Devuelve true si existe, false si no.
 */
function viviendaExistente($pdo, $piso, $bloque, $letra)
{
    $stmt = $pdo->prepare("
        SELECT id 
        FROM vivienda 
        WHERE piso = :piso AND bloque = :bloque AND letra = :letra
        LIMIT 1
    ");
    $stmt->execute([
        ':piso' => $piso,
        ':bloque' => $bloque,
        ':letra' => $letra
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
}



/**
 * Elimina una vivienda.
 * Si el vecino solo tiene esa vivienda, elimina también al vecino (y opcionalmente al usuario).
 * Devuelve null si todo va bien, o un mensaje de error si falla.
 */
function bajaVecinoOVivienda($idVivienda, $idVecino, $pdo)
{
    try {
        $pdo->beginTransaction();

        // Contar cuántas viviendas tiene este vecino
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM vivienda WHERE id_vecino = :idVecino");
        $stmt->execute([':idVecino' => $idVecino]);
        $numViviendas = (int)$stmt->fetchColumn();

        // Borrar cuotas asociadas a la vivienda
        $stmt = $pdo->prepare("DELETE FROM cuota WHERE id_vivienda = :idVivienda");
        $stmt->execute([':idVivienda' => $idVivienda]);

        // Borrar la vivienda
        $stmt = $pdo->prepare("DELETE FROM vivienda WHERE id = :idVivienda");
        $stmt->execute([':idVivienda' => $idVivienda]);

        if ($numViviendas <= 1) {
            // Si era la única vivienda → borrar también al vecino
            $stmt = $pdo->prepare("DELETE FROM vecino WHERE id = :idVecino");
            $stmt->execute([':idVecino' => $idVecino]);

            //borrar usuario si ya no tiene un registro de vecino
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM vecino WHERE id_usuario = (
                                      SELECT id_usuario FROM vecino WHERE id = :idVecino LIMIT 1
                                   )");
            $stmt->execute([':idVecino' => $idVecino]);
            $numVecinos = (int)$stmt->fetchColumn();

            if ($numVecinos == 0) {
                $stmt = $pdo->prepare("DELETE FROM usuario
                                       WHERE id = (SELECT id_usuario FROM vecino WHERE id = :idVecino LIMIT 1)");
                $stmt->execute([':idVecino' => $idVecino]);
            }
        }

        $pdo->commit();
        return null; //  correcto
    } catch (Exception $e) {
        $pdo->rollBack();
        return "Error al eliminar: " . $e->getMessage();
    }
}
