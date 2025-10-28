<!-- página de creación de un nuevo jugador con datos introducidos a mano -->

<?php
require __DIR__ . '/../vendor/autoload.php';

use League\Plates\Engine;

$templates = new Engine(__DIR__ . '/../views');
echo $templates->render('vcrear');
