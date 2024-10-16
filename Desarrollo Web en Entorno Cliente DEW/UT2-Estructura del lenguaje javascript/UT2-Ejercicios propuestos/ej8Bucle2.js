// 8) Bucle2: Haz el mismo ejercicio del apartado 7 con un bucle while

const numero = parseInt(prompt('Introduzca un número para calcular el factorial: '));
let resultado = numero, multiplicador = numero - 1;
if(!isNaN(numero)){
    while(multiplicador > 1){
        resultado  *= multiplicador;
        multiplicador--;
    }

    alert('El factorial del número ' + numero + ' es ' + resultado);
}else{
    alert('No has introducido un número válido.');
}
