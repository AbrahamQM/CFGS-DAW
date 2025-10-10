<?php
//En PHP no es necesario que definas una función antes de utilizarla,
//excepto cuando está condicionalmente definida, veamos dos ejemplos que hacen lo mismo:

$iva = true;
$precio = 10;
// precioConIva();     // esta línea dará error, coméntala
if ($iva) {
    function precioConIva()
    {
        global $precio; //podemos usar también $precio = $GLOBALS["precio"];
        $precioIva = $precio * 1.18;
        echo "<br>--precioConIva: El precio con IVA es " . $precioIva;
    }
}
precioConIva();     // Aquí ya no da error


$iva = true;
$precio = 10;
if ($iva) {
    //podemos hacer uso de la función
    //Antes de implementarla.
    precioConIva2();
}
function precioConIva2()
{
    $precio = $GLOBALS["precio"];
    $precioIva = $precio * 1.18;
    echo "<br>--precioConIva2: El precio con IVA es " . $precioIva;
}


//ARGUMENTOS
print "</p></p>*ARGUMENTOS:";
//Al definir la función, puedes indicar valores por defecto para los argumentos,
//de forma que cuando hagas una llamada a la función puedes
//no indicar el valor de un argumento;
// en este caso se toma el valor por defecto indicado.
function precioConIva3($precio, $iva = 0.18)
{
    return $precio * (1 + $iva);
}
$precio = 10;
$precioIva = precioConIva3($precio); //al no especificar tomará el valor 0.18
echo "<br>--Usando argumento por defecto: El precio con IVA es $precioIva";

$precio = 20;
$precioIva = precioConIva3($precio, 0.23); //ahora $iva=0.23
echo "<br>--Pasando argumento: El precio con IVA es $precioIva";

//PASO POR REFERENCIA
print "</p></p>*PASO POR REFERENCIA:";
function precioConIva4(&$precio, $iva = 0.18)
{
    $precio *= 1 + $iva;
}
precioConIva4(  $precio); //pasamos $precio por referencia
echo "<br>El precio con IVA es  $precio";