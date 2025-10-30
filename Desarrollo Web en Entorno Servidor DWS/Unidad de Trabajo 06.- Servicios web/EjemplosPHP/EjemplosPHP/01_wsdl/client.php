<?php

// Cliente SOAP que genera una petición de mostrar mensaje a Antonio usando WSLD (depende de 01_wsdl/server.php y 01_wsdl/holamundo.wsdl)
// Muestra y guarda los archivos request y response generados


ini_set("soap.wsdl_cache_enabled", "0");
ini_set("soap.wsdl_cache_ttl", "0");

try {
	// Se genera un cliente con WSDL
    $client = new SoapClient("http://localhost/01_wsdl/holamundo.wsdl", [
        'trace' => 1,
        'exceptions' => true
    ]);

    $resultado = $client->holaMundo("Antonio");

    echo "<h3>Respuesta del servidor:</h3>";
    echo "<pre>" . htmlentities($resultado) . "</pre>";

    // Mostrar XML enviados/recibidos
    echo "<hr><h3>Request XML:</h3><pre>" . htmlentities($client->__getLastRequest()) . "</pre>";
    echo "<h3>Response XML:</h3><pre>" . htmlentities($client->__getLastResponse()) . "</pre>";
	
	// Guardar XML request y response
    file_put_contents("request.xml", $client->__getLastRequest());
    file_put_contents("response.xml", $client->__getLastResponse());
	

} catch (SoapFault $e) {
    echo "<h3>Se ha producido un error en el cliente SOAP:</h3>";
    echo "<pre>" . htmlentities($e->getMessage()) . "</pre>";
}
?>
