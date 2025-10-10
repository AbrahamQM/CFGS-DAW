<?php
//Uso de goto para saltar a una etiqueta
print "</p></p>*USO DE GOTO:</p>";
$a = 1;
goto salto;
$a++;  //esta sentencia no se ejecuta
salto:
echo $a;  // el valor obtenido es 1


//Condicionales
print "</p></p>*CONDICIONALES:</p>";
$b = 3;
echo "-a es: $a y b es: $b</p>";
if ($a < $b) {
    print "a es menor que b";
} elseif ($a > $b) {
    print "a es mayor que b";
} else {
    print "a es igual a b";
}

//Switch
print "</p></p>*SWITCH:</p>";
switch ($a) {
    case 0:
        print "a vale 0";
        break;
    case 1:
        print "a vale 1";
        break;
    default:
        print "a no vale 0 ni 1";
}

//Bucles
print "</p></p>*BUCLES:</p>";
$a = 1;
while ($a < 8) {
    $a += 3;
}
echo $a; // el valor obtenido es 10

//do-while
print "</p></p>*DO-WHILE:</p>";
$a = 5;
do {
    $a -= 3;
} while ($a > 10);
print $a; // el bucle se ejecuta una sola vez, con lo que el valor obtenido es 2

//for
print "</p></p>*FOR:</p>";
for ($a = 5; $a < 10; $a += 3) {
    print $a; // Se muestran los valores 5 y 8
    print "<br />";
}