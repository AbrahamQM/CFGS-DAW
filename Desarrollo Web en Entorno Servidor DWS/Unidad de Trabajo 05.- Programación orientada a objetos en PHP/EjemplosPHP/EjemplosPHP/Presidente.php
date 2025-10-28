<?php
/**
	Definición de una clase Presidente que extiende la clase Vecino.
*/

class Presidente extends Vecino {
	// Propiedad de vecinos
    protected $vecinos = [];

	// Se define el constructor 
    public function __construct($nombre, $apellidos, $dni, $piso, $cuota, $vecinos) {
        parent::__construct($nombre, $apellidos, $dni, $piso, $cuota);
        $this->vecinos = $vecinos;
    }

	// El presidente puede ver todos los vecinos.
	// Se define un nuevo método verAll() :: Se recorre el array vecinos
    public function verAll() {
        echo "<h3> Lista de vecinos:</h3>";
        foreach ($this->vecinos as $v) {
            $v->verDatos();						// Se llama al método verDatos de la clase Vecino (o padre)
        }
    }

	// El presidente puede modificar la cuota de un vecino
    public function modificarCuota($dniVecino, $nuevaCuota) {
        foreach ($this->vecinos as $v) {
            if ($v->getDni() === $dniVecino) {
                $v->setCuota($nuevaCuota);
                echo "La Cuota de {$dniVecino} ha sido actualizada a {$nuevaCuota} euros <br>";
                return;
            }
        }
        echo "Error: Vecino no existente";
    }
}
