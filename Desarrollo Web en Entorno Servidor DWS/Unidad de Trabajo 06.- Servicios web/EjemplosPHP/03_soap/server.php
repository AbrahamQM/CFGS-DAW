<?php
/* Ejemplo de SOAPServer donde tenemos tres endpoints:
	a) getUserInfo: devuelve información sobre un usuario de $usuarios
	b) sumar: devuelve la suma de dos numeros
	c) saludar: devuelve un mensaje de Bienvenida a un nombre.
*/

ini_set("soap.wsdl_cache_enabled", "0"); 

class ToolsService {
    public function getUserInfo($id) {
        $usuarios = [
            1 => ["nombre" => "Antonio Pérez", "email" => "aperez@example.com"],
            2 => ["nombre" => "Ana María López", "email" => "alopez@example.com"]
        ];

		// fault del XML response
        if (!isset($usuarios[$id])) {
            throw new SoapFault("Client", "Usuario con ID $id no encontrado");
        }
        return $usuarios[$id];
    }

    public function sumar($a, $b) {
        return $a + $b;
    }

    public function saludar($nombre) {
        return "¡Hola, $nombre! Bienvenido al servicio SOAP.";
    }
}

// Se crea el servidor SOAP
$options = ['uri' => 'http://localhost/03_soap'];
$server = new SoapServer(null, $options);

// Se asocia la Clase ToolsService cuyos métodos se exponen como operaciones SOAP a poder ser realizadas
$server->setClass("ToolsService");

// Se procesan las solicitudes del cliente
$server->handle();
?>