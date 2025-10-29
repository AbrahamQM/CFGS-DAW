<?php
// Clase Jugador con el constructor, método para insertar nuevo y obtenerTodos
namespace Abraham\Code;

use PDO;

class Jugador
{
    private $nombre;
    private $apellidos;
    private $telefono;
    private $nacionalidad;
    private $fechaNacimiento;
    private $dorsal;
    private $posicion;
    private $barcode;

    public function __construct($nombre, $apellidos, $telefono, $nacionalidad, $fechaNacimiento, $dorsal, $posicion, $barcode)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->nacionalidad = $nacionalidad;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->dorsal = $dorsal;
        $this->posicion = $posicion;
        $this->barcode = $barcode;
    }

    public function insertar()
    {
        $pdo = Conexion::abrir();
        $sql = "INSERT INTO jugadores (nombre, apellidos, telefono, nacionalidad, fecha_nacimiento, dorsal, posicion, barcode)
                VALUES (:nombre, :apellidos, :telefono, :nacionalidad, :fecha_nacimiento, :dorsal, :posicion, :barcode)";
        $stmt = $pdo->prepare($sql);
        // Si la fecha viene vacía, la pasamos a null
        $fecha = !empty($this->fechaNacimiento) ? $this->fechaNacimiento : null;

        // Igual con el dorsal: si viene vacío, lo dejamos en null
        $dorsal = !empty($this->dorsal) ? $this->dorsal : null;

        $stmt->execute([
            ':nombre' => $this->nombre,
            ':apellidos' => $this->apellidos,
            ':telefono' => $this->telefono,
            ':nacionalidad' => $this->nacionalidad,
            ':fecha_nacimiento' => $fecha,
            ':dorsal' => $dorsal,
            ':posicion' => $this->posicion,
            ':barcode' => $this->barcode
        ]);
    }

    public static function obtenerTodos()
    {
        $pdo = Conexion::abrir();
        $stmt = $pdo->query("SELECT * FROM jugadores");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
