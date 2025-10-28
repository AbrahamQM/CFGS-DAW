<?php
/**
	Definición de una clase vecino.
*/

class Vecino {
	// Declaración de las propiedades nombre, apellidos, dni, piso, cuota
    protected $nombre;
	protected $apellidos;
	protected $dni;
    protected $piso;
    protected $cuota;

	// Constructor 
    public function __construct($nombre, $apellidos, $dni, $piso, $cuota) {
        $this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->dni = $dni;
        $this->piso = $piso;
        $this->cuota = $cuota;
    }

	// Metodo ver datos
    public function verDatos() {
        echo "::Vecino:: Nombre {$this->nombre} 
						| Apellidos {$this->apellidos}
						| DNI {$this->dni}
						| Piso: {$this->piso} 
						| Cuota: {$this->cuota} euros <br>";
    }

	// Getters
    public function getNombre() {
        return $this->nombre;
    }
	
	public function getApellidos() {
        return $this->apellidos;
    }

	public function getDni() {
        return $this->dni;
    }
	
	public function getPiso() {
        return $this->piso;
    }
	
    public function getCuota() {
        return $this->cuota;
    }
	
	// Setters
    public function setCuota($nuevaCuota) {
        $this->cuota = $nuevaCuota;
    }
	
	public function setPiso($nuevoPiso) {
        $this->piso = $nuevoPiso;
    }
}
