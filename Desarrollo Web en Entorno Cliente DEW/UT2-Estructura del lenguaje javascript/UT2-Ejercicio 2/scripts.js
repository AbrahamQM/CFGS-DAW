"use strict" 

const letters = "TRWAGMYFPDXBNJZSQVHLCKE";
let isGood = false;
let dni; 

do {
    dni = parseInt(prompt("Introduce tu número de DNI: "));      
    isGood = (!isNaN(dni) && dni.toString().length === 8) ? true : false;
    
    if (!isGood) {
        alert('Error: número de DNI no válido!!! \nVuelva a intentarlo');
    }
} while (!isGood);

alert('Su letra de DNI es: ' + letters.charAt(dni % 23));

