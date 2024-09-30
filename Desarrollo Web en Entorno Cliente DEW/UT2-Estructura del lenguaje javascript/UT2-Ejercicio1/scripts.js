"use strict" //para que nos avise de las excepciones

const correct = Math.round((Math.random() * 100)),
    intentos = 3;

let num_intentos = 0, num;
let acierto = false;
let valor;

do {
    console.log(correct);
    num = parseInt(prompt("Introduce un numero entre 0 y 100: "));
    if (!isNaN(num)) {  
        valor = num ===correct ? 0 : (num < correct) ? -1 : 1;
        switch( valor ){
            case  0: {
                alert('FELICIDADES Has acertado!!');
                acierto = true;
                break;
            }
            case -1: {
                alert('-- El número es menor al esperado, te quedan  ' + (intentos - (num_intentos + 1)) + ' intentos');
                num_intentos++;
                break;
            }
            case 1:{
                alert('++ El número es mayor al esperado, te quedan  ' + (intentos - (num_intentos + 1)) + ' intentos');
                num_intentos++;
                break;
            }
            default:{    
                alert('---Fin del juego---');
                break;
            }
        }
    } else {
        alert('Error, debe introducir un número!')
    }
}while(!acierto  && num_intentos < intentos);
