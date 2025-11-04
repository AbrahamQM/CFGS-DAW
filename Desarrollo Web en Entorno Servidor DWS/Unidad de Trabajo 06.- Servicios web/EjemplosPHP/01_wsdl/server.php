<?php

// Primer ejemplo: Hola Mundo con SOAP usando un WSDL (holamundo.wsdl)
// Devuelve el mensaje ¡Hola, Antonio! Bienvenido al servicio SOAP

ini_set("soap.wsdl_cache_enabled", "0");
ini_set("soap.wsdl_cache_ttl", "0");

// Clase del servicio SOAP
class HolaMundoService {
	
    public function holaMundo($nombre) {
        return "¡Hola, $nombre! Bienvenido al servicio SOAP.";
    }
}

// Crear servidor SOAP con WSDL
$server = new SoapServer("http://localhost/01_wsdl/holamundo.wsdl");

// Asignar la clase al servidor
$server->setClass('HolaMundoService');

// Procesar solicitud SOAP entrante
$server->handle();
?>
