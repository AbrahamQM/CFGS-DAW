<?php
/* PASO 1. El servidor debe tener un servicio
	Se publica el endpoint: getUserInfo
*/ 

ini_set("soap.wsdl_cache_enabled", "0");

class UserInfo {
    public $name;
    public $email;
    public $age;
}

class UserService {

    public function getUserInfo($request) {
        $userId = $request->userId ?? null;

		// Simulamos una base de datos Nombre, email, edad
        $usuarios = [
            1 => ['Antonio González', 'agonzalez@example.com', 60],
            2 => ['Ana María López', 'alopez@example.com', 45],
            3 => ['Carlos Pérez', 'cperez@example.com', 25],
	    ];

		// Si el usuario no existe, lanzamos un error SOAP (Fault)
        if (!isset($usuarios[$userId])) {
            throw new SoapFault(
                "Client",                                // Tipo de error
                "El usuario con ID $userId no existe.",  // Mensaje legible
                "http://localhost/02_wsdl/userService",  // faultactor (opcional)
                ["errorCode" => "USER_NOT_FOUND"]        // Detalle adicional
            );
        }

        // Creamos objeto del tipo correcto (no array)
        $usuario = new UserInfo();
        $usuario->name = $usuarios[$userId][0];
        $usuario->email = $usuarios[$userId][1];
        $usuario->age = $usuarios[$userId][2];

        // Devuelve un objeto, no un array
        return ['userInfo' => $usuario];
    }
}

try {
    // Se crea el server usando WSDL
	$server = new SoapServer("http://localhost/02_wsdl/userService.wsdl");
	
	// Asignar la clase al servidor
    $server->setClass("UserService");
	
	// Procesar solicitud SOAP entrante
    $server->handle();
	
} catch (SoapFault $e) {
    echo "Se ha producido un error en el SOAP Server: (faultcode: {$e->faultcode}, faultstring: {$e->faultstring})";
}
?>
