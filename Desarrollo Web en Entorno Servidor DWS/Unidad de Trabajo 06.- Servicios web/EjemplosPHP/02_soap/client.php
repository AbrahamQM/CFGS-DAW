<?php
// PASO 2: El Cliente realiza una solicitud en la que pregunta por el usuario 1111 (en relacion 02_soap/server.php)

$options = [
    'location' => 'http://localhost/02_soap/server.php',
    'uri' => 'http://localhost/02_soap/server.php',
    'trace' => 1,  									// Permite inspeccionar el XML enviado y recibido
	'exceptions' => true							// Para capturar SoapFault
];

try {
    $cliente = new SoapClient(null, $options);

    // Solicitamos información del usuario 1111 (que no existe)
    $respuesta = $cliente->getUserInfo(1111);

    echo "Nombre: " . $respuesta['nombre'] . "<br>";
    echo "Email: " . $respuesta['email'] . "<br>";
	
	// Mostrar XML enviados/recibidos
    echo "<hr><h3>Request XML:</h3><pre>" . htmlentities($cliente->__getLastRequest()) . "</pre>";
    echo "<h3>Response XML:</h3><pre>" . htmlentities($cliente->__getLastResponse()) . "</pre>";
	
	// Guardar XML request y response
    file_put_contents("request.xml", $cliente->__getLastRequest());
    file_put_contents("response.xml", $cliente->__getLastResponse());

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
