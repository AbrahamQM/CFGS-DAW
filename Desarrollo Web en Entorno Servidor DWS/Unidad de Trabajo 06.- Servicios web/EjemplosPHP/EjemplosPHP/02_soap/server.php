<?php
/* PASO 1. El servidor debe tener un servicio
	Se publica el endpoint: getUserInfo
*/ 

// Desactivar caché WSDL
ini_set("soap.wsdl_cache_enabled", "0");

// Definimos una clase con las operaciones del servicio
class userService {

    public function getUserInfo($userId) {
		
		// Simulación de una pequeña base de datos
        $usuarios = [
            1 => ["nombre" => "Antonio González", "email" => "agonzalez@example.com"],
            2 => ["nombre" => "Ana María López", "email" => "alopez@example.com"]
        ];

        // Si el usuario no existe, lanzamos un error SOAP (Fault)
        if (!isset($usuarios[$userId])) {
            throw new SoapFault(
                "Client",                                // Tipo de error
                "El usuario con ID $userId no existe.",  // Mensaje legible
                "http://localhost/02_soap/userService",  // faultactor (opcional)
                ["errorCode" => "USER_NOT_FOUND"]        // Detalle adicional
            );
        }

        // Si existe, devolvemos su información
        return $usuarios[$userId];
    }
}

// Configurar y ejecutar el servidor SOAP
$options = ['uri' => 'http://localhost/02_soap/server.php'];

// Se crea el objeto SoapServer y se invocan los metodos setClass y handle
$server = new SoapServer(null, $options);
$server->setClass('userService');
$server->handle();
?>
