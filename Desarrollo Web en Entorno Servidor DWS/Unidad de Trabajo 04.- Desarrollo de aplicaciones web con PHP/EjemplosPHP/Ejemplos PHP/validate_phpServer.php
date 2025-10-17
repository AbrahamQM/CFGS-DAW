<?php

// Se ha solicitado enviado las credenciales USUARIO - LOGIN
if (!isset($_SERVER['PHP_AUTH_USER'])) {
	
    // En caso de que no se hayan solicitado se solicita usuario - contraseña
    header('WWW-Authenticate: Basic realm="Zona Segura"');
    header('HTTP/1.0 401 Unauthorized');
	
    echo "Acceso no permitido a la aplicación. Introduzca usuario y contraseña.";
    exit;
	
} else {
    
	// Se recogen los parametros enviados por cabecera HTTP
    $usuario = $_SERVER['PHP_AUTH_USER'];
    $clave = $_SERVER['PHP_AUTH_PW'];
    $tipo = isset($_SERVER['AUTH_TYPE']) ? $_SERVER['AUTH_TYPE'] : 'desconocido';
	
	// Se procede a verificar la contraseña y usuario introducidos.
    if ($usuario === 'admin' && $clave === '123Abc') {
		
        echo "<h2>Bienvenido, $usuario </h2>";
        echo "<p>Tipo de autenticación realizada (Basic o Digest): <strong>$tipo</strong></p>";
        echo "<p>Usuario y contraseña correctas.</p>";
		
    } else {
		// En caso contrario se solicita de nuevo usuario y contraseña
        
        header('WWW-Authenticate: Basic realm="Zona Segura"');
        header('HTTP/1.0 401 Unauthorized');
        echo "Usuario o contraeña incorrectos.";
		
        exit;
    }
}
?>
