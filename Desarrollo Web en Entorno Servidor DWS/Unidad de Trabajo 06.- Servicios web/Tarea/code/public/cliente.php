<?php


ini_set("soap.wsdl_cache_enabled", "0");
ini_set("soap.wsdl_cache_ttl", "0");

try {
    // Se genera un cliente con WSDL

    //comprobamos si ya existe el wsdl y, si no, lo generamos con generarWsdl.php
    // Ruta local al WSDL
    $wsdlPath = __DIR__ . '/servicio.wsdl';
    $wsdlUrl = "http://localhost/code/public/servicio.wsdl";

    // Si no existe el WSDL en disco, lo generamos
    // en ese caso se muestra el mensaje desde el propio generarWsdl.php
    if (!file_exists($wsdlPath)) {
        require_once __DIR__ . '/generarWsdl.php';
    }

    // Se genera un cliente con WSDL
    $client = new SoapClient($wsdlUrl, [
        'trace' => 1,
        'exceptions' => true
    ]);

    //*   ************     pruebas  getPVP    ************
    // Llamadas al método getPVP para un código de producto definido en $codigoProducto
    echo "<h1>Cliente SOAP con WSDL</h1>";
    echo "<hr><h2>Consultas a getPVP con código de artículo.</h2>";
    $codigoProducto = "P1";
    $resultado = $client->getPVP($codigoProducto);
    echo "<h3>Respuesta del servidor para el artículo con código $codigoProducto:</h3>";
    echo "<pre>" . $resultado . "</pre>";

    //**Muestra de el resultado al buscar un producto no existente
    $codigoProducto = "P4";
    $resultado = $client->getPVP($codigoProducto);
    echo "<h3>Respuesta del servidor para el artículo con código $codigoProducto (inexistente):</h3>";
    echo "<pre>" . $resultado . "</pre>";

    
    //*   ************     pruebas  getStock    ************
    //Llamada al método getStock para un código de producto y tienda definidos
    echo "<hr><h2>Consultas a getStock con código de artículo y tienda.</h2>";
    $codigoProducto = "P2";
    $codigoTienda = "T2";
    $resultado = $client->getStock($codigoProducto, $codigoTienda);
    echo "<hr><h3>Respuesta del servidor para el stock del artículo con código $codigoProducto en la tienda $codigoTienda:</h3>";
    echo "<pre>" . $resultado . "</pre>";

    //** Muestra del resultado al buscar el stock de un producto en una tienda no existente
    $codigoProducto = "P3";
    $codigoTienda = "T5";
    $resultado = $client->getStock($codigoProducto, $codigoTienda);
    echo "<h3>Respuesta del servidor para el stock del artículo con código $codigoProducto en la tienda $codigoTienda (inexistente):</h3>";
    echo "<pre>" . $resultado . "</pre>";

    // Mostrar XML enviados/recibidos
    echo "<hr><h3>Request XML:</h3><pre>" . htmlentities($client->__getLastRequest()) . "</pre>";
    echo "<h3>Response XML:</h3><pre>" . htmlentities($client->__getLastResponse()) . "</pre>";

} catch (SoapFault $e) {
    echo "<h3>Se ha producido un error en el cliente SOAP:</h3>";
    echo "<pre>" . htmlentities($e->getMessage()) . "</pre>";
}