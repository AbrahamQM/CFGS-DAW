<?php
/**
	Se tiene la clase Vecino y Presidente (en los archivos Vecino.php y Presidente.php
	Se realiza un ejemplo de uso de ambas clases.
*/

// Creamos tres vecinos Antonio, Luis, Sara
$v1 = new Vecino("Antonio", "Martin", "11111111A" "1A", 1250);
$v2 = new Vecino("Luis", "Gonzalez", "2222222B", "2B", 360);
$v3 = new Vecino("Sara", "Exposito", "33333333C", "3C", 25);

// Inicializamos el array de vecinos 
$vecinos = [$v1, $v2, $v3];

// Crear presidente : Un vecino
$presidente = new Presidente("Ana (Presidente)", "Mateos", "44444444D", "4D", 0, $vecinos);

// Los vecinos sólo podían ver sus datos.
// El vecino Antonio v1 desea ver sus datos
echo "<h3>Vecino:</h3>";
$v1->verDatos();

// El presidente puede ver todos los datos de los vecinos
echo "<h3>Presidente:</h3>";
$presidente->verAll();

// Además el presidente podía modificar una cuota
$presidente->modificarCuota("2222222B", 15);


