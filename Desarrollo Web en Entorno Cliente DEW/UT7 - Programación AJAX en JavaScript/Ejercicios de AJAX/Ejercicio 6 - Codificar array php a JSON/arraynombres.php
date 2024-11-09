<?php
    //Array de nombres
    $a = ["Ana", "María", "Juan", "Pablo", "Luis", "Oswaldo", "Fernando", "Santiago", "Aitana", "Borja", "Verónica",
    "Faustino", "Constantino", "Emeterio", "Pedro", "Omar", "Bernardo", "Inés", "Julián", "Katy", "Laura", 
    "Manuel", "Iván", "Nuria", "Nina", "Rosa", "Raúl", "Toribio", "Tania", "David", "Daniel"];

    //Pasamos el array a JSON
    $miJSON = json_encode($a);
    echo $miJSON;
?>