window.onload = saludar;
function saludar () {
    alert ("hola");
}

function saludar2 (nombre) {
    alert ("Hola " + nombre);
}
let saludo = saludar();  //invoca la función y vemos el alert
alert (saludo);     // undefined --> No hay tipo y no devuelve nada la función.

let saludo2 = saludar2("Yaiza");

let saludo3 = saluda;  //guarda la función en una variable
