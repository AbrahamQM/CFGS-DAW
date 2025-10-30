<?php
/*
 PASO 2: El Cliente realiza una solicitud en la que pregunta por el usuario 1111 (en relacion 02_wsdl/server.php y 02_wsdl/userService.wsdl)
*/

ini_set("soap.wsdl_cache_enabled", "0");

try {
    $client = new SoapClient("http://localhost/02_wsdl/userService.wsdl", [
        'trace' => 1,
        'exceptions' => true,
        'classmap' => [
            'UserInfo' => 'UserInfo'
        ]
    ]);

    class UserInfo {
        public $name;
        public $email;
        public $age;
    }

    $params = new stdClass();
    $params->userId = 1111;

    $response = $client->getUserInfo($params);
	
  	echo "<h3>Respuesta del servidor:</h3>";
    echo "<pre>";
    print_r($response);
    echo "</pre>";
	
	/* 
	// Otra forma de mostrar el objeto devuelto en response
	echo "=== USER INFO ===\n";
    echo "Name: " . $response->userInfo->name . "\n";
    echo "Email: " . $response->userInfo->email . "\n";
    echo "Age: " . $response->userInfo->age . "\n";
	*/
	
	 // Mostrar XML enviados/recibidos
    echo "<hr><h3>Request XML:</h3><pre>" . htmlentities($client->__getLastRequest()) . "</pre>";
    echo "<h3>Response XML:</h3><pre>" . htmlentities($client->__getLastResponse()) . "</pre>";
	
	// Guardar XML request y response
    file_put_contents("request.xml", $client->__getLastRequest());
    file_put_contents("response.xml", $client->__getLastResponse());

} catch (SoapFault $e) {
    // Se analiza el fault del XML SOAP recibido
    echo "<strong>Se produjo un error SOAP:</strong><br>";
    echo "Código: " . $e->faultcode . "<br>";
    echo "Mensaje: " . $e->getMessage() . "<br>";
    echo "Actor: " . ($e->faultactor ?? "No especificado") . "<br>";
    echo "Detalles: ";
    print_r($e->detail);
}
?>
