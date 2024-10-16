"use strict" 
// 3) Operadores2: Solicita por pantalla un número por pantalla de 0 – 10 y calcula la 
// tabla de multiplicar de ese número. Muéstralo en un alert usando saltos de línea 
// para cada multiplicación, por otro lado controla que el número introducido esté 
// entre esos valores.

//He preguntado en clase y se me indicó que se puede mostrar un alert por cada resultado
const numero = prompt('Introduce un número entre 0 y 10: ');
const resultado = (multiplicador) => {return numero * multiplicador};

if( !isNaN(numero) && 0 < numero < 10 ){
    for(let i= 0; i <= 10; i++){
        alert( numero  + ' x ' + i + ' = ' + resultado(i));
    }
}else{
    alert('No has introducido un número válido.');
}