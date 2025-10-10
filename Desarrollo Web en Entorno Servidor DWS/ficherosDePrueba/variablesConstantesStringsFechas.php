<?php
$ciclo = "DAW";
$modulo = "DWES";
print "<p>";
printf("%s es un módulo de %d curso de %s", $modulo, -2.25, $ciclo);
print "</p>";
printf("%s es un módulo de %f curso de %s", $modulo, -2.25, $ciclo);
print "</p>";
printf("El número PI vale %+.2f", 3.1416); // +3.14
print "</p>";
$txt_pi = sprintf("El número PI vale %+.3f", 3.1416);
print ($txt_pi);
print "</p>";
print "<p>Módulo: $modulo</p>";


//operadores de concatenación
print "</p></p>OPERADORES DE CONCATENACIÓN:</p>";
$a = "Módulo ";
$b = $a . "DWES"; // ahora $b contiene "Módulo DWES"
print "<p>$a</p>";
$a .= "DWES"; // ahora $a también contiene "Módulo DWES"
print "<p>$a</p>";
print "<p>$b</p>";
print "</p>";
$a = <<<MICADENA
    Desarrollo de Aplicaciones Web<br />
    Desarrollo Web en Entorno Servidor
    MICADENA;
print $a;
print "</p></p>TIPOS DE VARIABLES:</p>";




//tipos de variables
print "</p></p>VARIABLES TIPO ENTERO:</p>";
$a = $b = "3.1416"; // asignamos a las dos variables la misma cadena de texto
settype($b, "float"); // y cambiamos $b a tipo float
print "\$a vale $a y es de tipo " . gettype($a);
print "<br />";
print "\$b vale $b y es de tipo " . gettype($b);
print "</p></p>VARIABLES TIPO NULL:</p>";
//Null en variables
$a = "3.1416";
if (isset($a)) // la variable $a está definida
{
    unset($a);
} //ahora ya no está definida
print "a se ha seteado a null: $a";



//Constantes:
print "</p></p>CONSTANTES:</p>";
define("PI", 3.1416);
print "El valor de PI es " . PI; //El identificador se reconoce por PI
print ("</p>");
$a = "-3.1416";
/*el signo + en un especificador de conversión indica que se visualice el signo del número aunque sea positivo,
pero el signo nunca se cambia y siempre se muestra si el número es negativo.*/
printf("La variable \'\$a\' vale %+.2f", $a);





//FECHAS
print "</p></p>FECHAS:</p>";
//La función date() devuelve la fecha y hora local
echo 'string date (string $formato [, int $fechahora])';
//setear la zona horaria
date_default_timezone_set("Europe/Madrid");
//De igual manera para que los días de la semana o el nombre de los meses aparezca en español
// deberás indicar los "locales" de la siguiente forma:
setlocale(LC_ALL, 'es_ES.UTF-8');
//Ejemplo 1.- Crear una fecha a partir de cualquier cadena.
echo "<br>";
$fechaMySql = "2020-12-31";
$objetoDateTime = date_create_from_format('Y-m-d', $fechaMySql);
var_dump($objetoDateTime);
//o más rápido
echo "<br>";
$fecha1 = new DateTime("2020-12-31");
echo "<br>";
var_dump($fecha1);
echo "<br><br>*FORMATOS DE FECHA";
//Ejemplo 2.- Pasar la fecha al formato que queramos
$miFecha = new DateTime();
$fecha = date_format($miFecha, 'd/m/Y');
echo "<br>";
var_dump($fecha);
//Sacar la marca de tiempo a un objeto de tipo dateTime
$ahora = new DateTime();
echo "<br>Timestamp: " . date_timestamp_get($ahora);
//fecha actual
$ahora = new DateTime();
echo "<br>";
var_dump($ahora);
//Fecha de ayer
$ayer = new dateTime("yesterday");
echo "<br>";
var_dump($ayer);
//Fecha del último lunes
$ultimoLunes = new DateTime("Last Monday");
echo "<br>";
var_dump($ultimoLunes);