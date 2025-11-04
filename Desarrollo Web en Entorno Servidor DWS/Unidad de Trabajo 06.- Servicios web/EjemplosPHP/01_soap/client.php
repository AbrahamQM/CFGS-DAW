<?php
// Cliente SOAP que genera una petición de mostrar mensaje a Antonio
// Muestra y guarda los archivos request y response generados

ini_set("soap.wsdl_cache_enabled", "0");

$options = [
    'location' => 'http://localhost/01_soap/server.php',   // Ruta del servidor
    'uri' => 'http://localhost/01_soap/holamundo',         // Debe coincidir con el "uri" del servidor
    'trace' => 1,                                          // Para ver XML request/response
    'exceptions' => true
];

try {
    $client = new SoapClient(null, $options);

    // Llamar al método remoto
    $resultado = $client->__soapCall("holaMundo", ["Antonio"]);

    echo "$resultado <br>";

    // Mostrar XML enviados/recibidos
    echo "<hr><h3>Request XML:</h3><pre>" . htmlentities($client->__getLastRequest()) . "</pre>";
    echo "<h3>Response XML:</h3><pre>" . htmlentities($client->__getLastResponse()) . "</pre>";
	
	// Guardar XML request y response
    file_put_contents("request.xml", $client->__getLastRequest());
    file_put_contents("response.xml", $client->__getLastResponse());

} catch (SoapFault $e) {
    echo "Se ha producido un error SOAP: " . $e->getMessage();
}
?>

