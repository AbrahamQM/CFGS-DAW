<?php
/**
 * Archivo de conexión a la base de datos mediante PDO.
 *
 * Establece la conexión con la base de datos ResidenciasEscolares usando MySQL.
 * La conexión se realiza dentro de un bloque try/catch para capturar errores.
 *
 * @author Abraham
 * @version 1.0
 * @since 2026
 */

try {
    
    /**
     * Parámetros de conexión a la base de datos.
     *
     * @var string $host Servidor de base de datos
     * @var string $dbname Nombre de la base de datos
     * @var string $user Usuario de conexión
     * @var string $pass Contraseña del usuario
     */
    $host="localhost";
    $dbname="ResidenciasEscolares";
    $user="root";
    $pass="";

    /**
     * Objeto PDO que representa la conexión activa con la base de datos.
     *
     * @var PDO $pdo
     */
    $pdo= new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
    
    // Para que genere excepciones a la hora de reportar errores.
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $err) {

    /**
     * Captura de errores de conexión o ejecución SQL.
     *
     * @param PDOException $err Excepción lanzada por PDO
     */
    echo $err->getMessage();
    }
?>
