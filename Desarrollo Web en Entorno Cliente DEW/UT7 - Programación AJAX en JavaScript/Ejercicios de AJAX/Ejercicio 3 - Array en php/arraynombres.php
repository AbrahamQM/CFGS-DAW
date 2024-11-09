<?php
    //Array de nombres
    $a = ["Ana", "María", "Juan", "Pablo", "Luis", "Oswaldo", "Fernando", "Santiago", "Aitana", "Borja", "Verónica",
    "Faustino", "Constantino", "Emeterio", "Pedro", "Omar", "Bernardo", "Inés", "Julián", "Katy", "Laura", 
    "Manuel", "Iván", "Nuria", "Nina", "Nino", "Rosa", "Raúl", "Toribio", "Tania", "David", "Daniel"];

    //Tomamos el valor del input procedente de la URL
    $nombre = $_REQUEST["nombre"];
    $sugerencia = "";

    //Comprobar que no esté vacío
    if ($nombre !== "") {
        $nombre = strtolower($nombre);            //lo pasamos a minúsculas
        $long = strlen($nombre);                 //obtenemos la longitud de nombre

        foreach ($a as $nom) {                 //vamos recorriendo el array
            //Comparamos dos cadenas i de stristr significa que no importa mayúsculas o minúsuculas.
            if (stristr ($nombre, substr($nom, 0, $long))) {     //si coincide la cadena pasada con los primeros caracteres de un elemento del array
                if ($sugerencia === "") {  //si está vacío
                    $sugerencia = $nom;
                }
                else {
                    $sugerencia = $sugerencia.", ".$nom;   //concatenamos con el . en php
                }
            }
        }
    }
    echo ($sugerencia === "") ? "No hay sugerencias" : $sugerencia;
?>