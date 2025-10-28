<?php
// Creamos una "carpeta virtual" llamada App
// De manera lógica:
// Directorio: App
//             --- Interface: Persona
namespace App;

interface Persona {
    // Los métodos de Persona serán para la propiedades Nombre, Apellidos y DNI
	public function getNombre();
    public function getApellidos();
    public function getDni();
	public function getPiso();
	public function getPass();
	public function getUsuario();
    public function verDatos();
}
