<?php
/*
  Borrar un registro enviado por URL de la tabla de usuarios de la base de datos que se ha conectado en conectar_bbdd.php
*/

require 'conexion_bbdd.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
