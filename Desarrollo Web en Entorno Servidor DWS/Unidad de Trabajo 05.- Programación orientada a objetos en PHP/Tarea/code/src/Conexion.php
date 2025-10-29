<?php
//Clase conexion encargada de establecer y devolver conexión .
namespace Abraham\Code;

use PDO;
use PDOException;

class Conexion {
    private static $conexion = null;

    public static function abrir() {
        if (self::$conexion === null) {
            try {
                self::$conexion = new PDO(
                    "mysql:host=localhost;dbname=practicaUnidad5;charset=utf8",
                    "gestor",
                    "12345"
                );
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conexion;
    }

}
