<?php

// Servidor SOAP con WSDL (depende de /code/Operaciones.php)
use Abraham\Code\Operaciones; //carga el fichero operaciones.php
require __DIR__ . '/../vendor/autoload.php';


ini_set("soap.wsdl_cache_enabled", "0");
ini_set("soap.wsdl_cache_ttl", "0");

try {

    // Crear servidor SOAP con WSDL
    $server = new SoapServer("http://localhost/code/public/servicio.wsdl");

    // Asignar la clase al servidor
    $server->setClass(Operaciones::class);

    // Procesar solicitud SOAP entrante
    $server->handle();
} catch (SoapFault $e) {
    echo "<h3>Se ha producido un error en el servidor SOAP:</h3>";
    echo "<pre>" . htmlentities($e->getMessage()) . "</pre>";
}
