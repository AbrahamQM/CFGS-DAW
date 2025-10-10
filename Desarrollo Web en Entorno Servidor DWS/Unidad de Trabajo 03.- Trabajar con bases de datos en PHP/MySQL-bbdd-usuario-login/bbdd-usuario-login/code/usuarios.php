<?php

/*
	Muestra todos los usuarios y acciones que puede realizar el administrador
*/

require 'conexion.php';
require 'auth.php';

if ($_SESSION['rol'] === 'vecino') {
    header('Location: ver_usuario.php?id=' . $_SESSION['userId']);
    exit;
}

// Consulta a realizar para mostrar a todos los usuarios de la tabla
$result = $conn->query('SELECT id, usuario, rol FROM usuarios ORDER BY id ASC');

?>

<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Usuarios</title></head>
<body>
    <h2>Listar todos los Usuarios - Bienvenido <?= $_SESSION['user'] ?>, ha entrado con el rol (<?= $_SESSION['rol'] ?>) </h2>
	
	<!-- El administrador puede realizar algunas acciones -->

    <?php if ($_SESSION['rol'] === 'administrador'): ?>
        <p><a href="crear_usuario.php">+ Añadir Usuario</a></p>
    <?php endif; ?>

    <table border="1" cellpadding="6">
        <tr><th>ID</th><th>Nombre</th><th>Rol</th><th>Acciones</th></tr>
        <?php while ($u = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= $u['usuario'] ?></td>
            <td><?= $u['rol'] ?></td>
            <td>
                <a href="ver_usuario.php?id=<?= $u['id'] ?>">Mostrar</a>
				
                <?php if ($_SESSION['rol'] === 'administrador'): ?>
                    | <a href="editar_usuario.php?id=<?= $u['id'] ?>">Editar</a>
                    | <a href="eliminar_usuario.php?id=<?= $u['id'] ?>" onclick="return confirm('¿Desea eliminar el usuario?')">Eliminar</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
	<br/><br/>
	<a href="logout.php">Salir</a>
</body>
</html>
