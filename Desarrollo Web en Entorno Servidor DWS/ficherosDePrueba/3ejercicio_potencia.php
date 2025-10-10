<?php
/*
* crear funcion que calcule la potencia de un numero con exponente por defecto = 2 o el pasado por argumento
*/
function potencia($base, $exponente = 2) {
    if ($exponente == 0) {
        return 1;
    } else {
        return $base * potencia($base, $exponente - 1);
    }
}


echo "la potencia 3^3 es: "; echo potencia(3, 3 ) ;
echo "<br>la potencia 3^? es: "; echo potencia(3) ;

function potencia2($base, $exponente = 2) {
    if ($exponente == 0) {
        return 1;
    } else {
        $resultado = $base;
        do{
            $resultado *= $base;
            $exponente--;
        }while($exponente > 1);
        return $resultado;
    }
    
}
echo "<br>la potencia 2 3^3 es: "; echo potencia2(3, 3);
echo "<br>la potencia 2 3^? es: "; echo potencia2(3);