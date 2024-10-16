// 5) Estructuras2: Solicita por teclado la nota numérica de un examen (valor entero). 
// Para cada nota debe configurar el mensaje de “Suspenso”, “Suficiente”, “Bien”, 
// “Notable”, “Sobresaliente”. Si no introduce un valor entre 0 – 10 entonces 
// mostramos un mensaje diciendo que introduzca un valor válido. Realiza este 
// ejercicio con IF

const nota = parseInt(prompt('Introduzca nota: '));


if( isNaN(nota) || nota > 10 || nota < 0){
    alert('No has introducido una nota válida.');
}else if(nota < 5){
    alert('Suspenso');
}else if(nota < 6){
    alert('Suficiente');
}else if(nota < 8){
    alert('Bien');
}else if(nota < 10){
    alert('Notable');
}else{
    alert('Sobresaliente');
}