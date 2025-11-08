<?php
require __DIR__ . '/../vendor/autoload.php';

use PHP2WSDL\PHPClass2WSDL;
use Abraham\Code\Operaciones; //carga el fichero operaciones.php

$wsdlGenerator = new PHPClass2WSDL(
    Operaciones::class,
    "http://localhost/code/public/servicio.php"
);

$wsdlGenerator->generateWSDL();
$wsdlGenerator->save(__DIR__ . '/servicio.wsdl');

echo "WSDL generado en servicio.wsdl";
