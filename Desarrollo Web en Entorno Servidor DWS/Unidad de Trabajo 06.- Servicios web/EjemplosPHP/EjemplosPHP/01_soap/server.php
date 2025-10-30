<?php
// Primer ejemplo: Hola Mundo con SOAP 
// Devuelve el mensaje ¡Hola, Antonio! Bienvenido al servicio SOAP

ini_set("soap.wsdl_cache_enabled", "0");

// Clase del servicio SOAP
class HolaMundoService {
	
    public function holaMundo($nombre) {
        return "¡Hola, $nombre! Bienvenido al servicio SOAP.";
    }
}

// Crear servidor SOAP sin WSDL
$options = ['uri' => 'http://localhost/01_soap/holamundo'];
$server = new SoapServer(null, $options);

// Asignar la clase al servidor
$server->setClass('HolaMundoService');

// Procesar solicitud SOAP entrante
$server->handle();
?>
