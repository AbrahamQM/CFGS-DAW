<?php
/*
  Fichero inicial que lista todos los usuarios que se encuentran en la la tabla usuarios y realiza las acciones de:
	- Añadir nuevos usuarios (teniendo en cuenta que sólo puede haber un único presidente).
	- Modificar: Un usuario (teniendo en cuenta que sólo puede haber un único presidente).
	- Borrar: Un usuario si existe.
	
	El id seleccionado es enviado por URL y se recoge con la variable $_GET
*/

require 'conexion_bbdd.php';

// Consulto los usuarios
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id ASC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ejemplo CRUD usando PDO DSW</title>
</head>
<body>
    <h2>Lista de usuarios</h2>
    <a href="nuevo.php">Añadir Usuarios</a><br/><br/>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th><th>Nombre</th><th>Rol</th><th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= htmlspecialchars($usuario['id']) ?></td>
            <td><?= htmlspecialchars($usuario['usuario']) ?></td>
            <td><?= htmlspecialchars($usuario['rol']) ?></td>
            <td>
                <a href="actualizar.php?id=<?= $usuario['id'] ?>"> Modificar</a>
                <a href="borrar.php?id=<?= $usuario['id'] ?>" onclick="return confirm('Esta usted seguro de borrar el registro?')"> Borrar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
	<br/><br/>
	<a href="salir.php">Cerrar sesi&oacute;n</a>
</body>
</html>
