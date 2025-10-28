<?php
// Declaración de la clase Persona
class Persona {
	
	// Declaración de atributos
	private $DNI;
	private $nombre;
	private $apellido;
	
	// Declaración del constructor
	function __construct($DNI, $nombre, $apellido) {
		$this->DNI = $DNI;
		$this->nombre = $nombre;
		$this->apellido = $apellido;        
	}
	
	// Declaración de los getters
	public function getNombre() {
		return $this->nombre;
	}
	public function getApellido() {
		return $this->apellido;
	}
	
	// Declaración de los setters
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function setApellido($apellido) {
		$this->apellido = $apellido;
	}
	public function __toString() {
		return "Persona: " . $this->nombre . " ". $this->apellido;
	}
}

// Declaración de Cliente que hereda de persona
class Cliente extends Persona{
	
	// Atributos
	private $saldo = 0;
	
	// Declaración del constructor (del padre y el propio)
	function __construct($DNI, $nombre, $apellido, $saldo){	
		 parent::__construct($DNI, $nombre, $apellido);
		 $this->$saldo = $saldo;
	}
	
	// Declaración de get
	public function getSaldo(){
		return $this->saldo;
	}
	
	// Declaración de set
	public function setSaldo($saldo){
		$this->saldo = $saldo;
	}
	
	// Redefinición del método toString
	public function __toString(){
		return  "Cliente: ". $this->getNombre() ;
	}      
}

// Creación de variables Persona y Cliente

// Creación de Persona
$per = new Persona("1111111A", "Ana", "Puertas");
// mostrarla, usa el método __toString()
echo $per . "<br>";
// cambiar el apellido
$per->setApellido("Montes");
// volver a mostrar
echo $per . "<br>";

// Creación de un Cliente (Persona y saldo)
$cli = new Cliente("22222245A", "Pedro", "Sales", 100);
// lo muestra
echo $cli . "<br>";	