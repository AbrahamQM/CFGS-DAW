<?php
/* Ejemplo de SOAPClient donde tenemos tres endpoints publicados (relación con 03_soap/server.php):
	a) getUserInfo: devuelve información sobre un usuario de $usuarios
	b) sumar: devuelve la suma de dos numeros
	c) saludar: devuelve un mensaje de Bienvenida a un nombre.
	Se muestran las llamadas a los métodos más utilizados de SoapClient
	 ** __construct(): Crea el cliente SOAP.
	 ** __soapCall(): Llama a un método SOAP especificando nombre y argumentos manualmente.
	 ** __call(): Invoca métodos SOAP de forma directa (implícita).
	 ** __getFunctions(): Muestra las funciones disponibles (solo funciona cuando se ha deficido un WSDL - devuelve un array vacío).
	 ** __getTypes(): Muestra los tipos definidos (solo con WSDL, simulado aquí).
	 ** __setSoapHeaders(): Define cabeceras SOAP personalizadas.
	 ** __getLastRequest(): Muestra el último XML SOAP enviado.re
	 ** __getLastResponse(): Muestra el último XML SOAP recibido.
*/

ini_set("soap.wsdl_cache_enabled", "0");

$options = [
    'location' => 'http://localhost/03_soap/server.php', 	// URL del servidor
    'uri' => 'http://localhost/03_soap',                 	// URI (igual que en el servidor)
    'trace' => 1,                                     		// Para obtener XML
    'exceptions' => true                              		// Activar manejo de errores
];

try {
    $client = new SoapClient(null, $options);

    echo "<h2> Métodos más comunes de SoapClient:</h2>";
    // __getFunctions() no funciona sin WSDL
    print_r($client->__getFunctions());

    echo "<h2>Tipos de datos:</h2>";
    print_r($client->__getTypes());

    // __soapCall() — llamada manual
    echo "<h3> Probando __soapCall('getUserInfo')</h3>";
    $response = $client->__soapCall("getUserInfo", [1]);
    print_r($response);

    // 🔹 __call() — llamada implícita
    echo "<h3> Probando __call('sumar')</h3>";
	// internamente realiza una llamada a __call('sumar')
    $resultado = $client->sumar(5, 8); 
    echo "5 + 8 = $resultado<br>";

    // __setSoapHeaders() — cabeceras personalizadas
    $header = new SoapHeader(
        "http://localhost/03_soap/auth",
        "AuthHeader",
        ["username" => "admin", "token" => "123456"]
    );
    $client->__setSoapHeaders($header);

    echo "<h3> Probando __soapCall('saludar') con cabecera SOAP</h3>";
    $saludo = $client->__soapCall("saludar", ["Antonio"]);
    echo "Respuesta: $saludo<br>";

    // __getLastRequest() y __getLastResponse()
    echo "<h3>Último Request XML:</h3><pre>" . htmlentities($client->__getLastRequest()) . "</pre>";
    echo "<h3>Último Response XML:</h3><pre>" . htmlentities($client->__getLastResponse()) . "</pre>";

} catch (SoapFault $e) {
    echo "<h3> Error SOAP detectado:</h3>";
    echo "Código: " . $e->faultcode . "<br>";
    echo "Mensaje: " . $e->getMessage() . "<br>";
    echo "Actor: " . ($e->faultactor ?? "No conocido") . "<br>";
    echo "Detalles: ";
    print_r($e->detail);

    if (isset($client)) {
        echo "<h4>Último Request:</h4><pre>" . htmlentities($client->__getLastRequest()) . "</pre>";
        echo "<h4>Último Response:</h4><pre>" . htmlentities($client->__getLastResponse()) . "</pre>";
    }
}
?>