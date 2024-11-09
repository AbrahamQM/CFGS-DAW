<?php
    //Para evitar que los warning salgan en la pantalla y se traten como texto JSON
    error_reporting(0);
   
    $objeto = new stdClass();
    $objeto->titulo = "DAW";
    $objeto->modulo = "DEW";
    $objeto->grupo = "752NNS";
    //Codificamos el objeto a JSON
    $miJSON = json_encode($objeto);            //me lo codifica a JSON el objeto
    echo $miJSON;
?>