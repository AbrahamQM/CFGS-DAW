// 9) Bucle3: Haz el mimso ejercicio del apartado 7 con un bucle do...while

const numero = parseInt(prompt('Introduzca un número para calcular el factorial: '));
let resultado = numero, multiplicador = numero - 1;
if(!isNaN(numero)){
    do{
        resultado  *= multiplicador;
        multiplicador--;
    }while(multiplicador > 1)

    alert('El factorial del número ' + numero + ' es ' + resultado);
}else{
    alert('No has introducido un número válido.');
}