<?php
// Iniciamos la sesion 
session_start();
// Incluimos el fichero configuración de conexion a bases de datos
include 'conectar_bbdd.php';

// Si ha pasado por login recogemos los valores de username y password por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Se busca el usuario en la tabla de la base de datos
	// Se protege contra SQL Injection
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
	
    $stmt->execute();
    $result = $stmt->get_result();
	
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Se verifica la contraseña del usuario encontrado
		// Se trabaja con cifrado de contraseñas
        if (password_verify($password, $user['password'])) {
			
			// Se genera un nueva id de la sesión :: Evita el robo de la sesion
            session_regenerate_id(true); 
			
			// Se guarda el nombre del usuario en la session
            $_SESSION['usuario'] = $user['username'];
			
            header("Location: welcome.php");
            exit();
        } else {
			// La contraseña es incorrecta. Se suele mostrar un mensaje genérico para no dar pistas al usuario del fallo.
            echo "Usuario o contraseña incorrecta";
        }
    } else {
		// El usuario no se encuentra en la tabla. Se suele un mostrar mensaje genérico para no dar pistas al usuario del fallo.
        echo "Usuario o contraseña incorrecta";
    }
}
?>
