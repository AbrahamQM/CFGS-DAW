// 7) Bucle1: Solicita por teclado un número x para calcular su factorial. Realízalo con 
// un bucle for. Muestra por pantalla “El factorial del número x es valorfactorial”. 
// Siendo x el número solicitado por pantalla y valorfactorial el resultado.

const numero = parseInt(prompt('Introduzca un número para calcular el factorial: '));

if(!isNaN(numero)){
    let resultado = numero;
    for( let multiplicador = numero - 1 ; multiplicador > 1; multiplicador--){
        resultado  *= multiplicador;
    }
    
    alert('El factorial del número ' + numero + ' es ' + resultado);
}else{
    alert('No has introducido un número válido.');
}
