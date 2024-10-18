/* 1 ******************************************************************************************************
    Crea un programa que pida por parámetro la fecha de tu cumpleaños, con este valor calcula
    El día de la semana en la que nacistes.
    Si por ejemplo ese día en que nacistes es "Jueves" calcula en qué años tu cumpleaños vuelve a caer "Jueves" hasta el 2100.
    NOTA: Recuerda que los meses empiezan en el valor 0 al 11.
************************************************************************************************************/
let diaNacimiento = prompt("Introduzca su día de nacimiento.");
let mesNacimiento = prompt("Introduzca su mes de nacimiento.");
let anoNacimiento = prompt("Introduzca su año de nacimiento.");

const fechaNacimiento = new Date(anoNacimiento, mesNacimiento - 1, diaNacimiento); 
const dias = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"]; 
const dia = dias[fechaNacimiento.getDay()];
alert("Has nacido un " + dia);

function caeMismoDia(){
    const numDiaSemana = fechaNacimiento.getDay();
    let fecha = new Date(fechaNacimiento);
    let anos = [];
    for (let ano = fecha.getFullYear() + 1; ano <= 2100; ano++) {
        fecha.setFullYear(ano);
        if (fecha.getDay() === numDiaSemana) {
            anos.push(fecha.getFullYear());
        }
    }
    return ("Tu cumpleaños cae en " + dia + " los siguientes años:\n" + anos);
}

alert(caeMismoDia()); 

/* 2 ******************************************************************************************************
    Crea un programa que muestre la fecha actual en diferentes formatos. Ejemplo en el día de hoy sería:
    21/10/2021
    Jueves, 21 de Octubre de 2021
    Thursday, October 21th, 2021
************************************************************************************************************/
const hoy = new Date();
const numDiaSemana = hoy.getDay();
const diaDeMes = hoy.getDate();
const anoActual = hoy.getFullYear();
const mesActual = hoy.getMonth();
const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
const diasSemanaIngles = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const mesesEnIngles = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

alert("Fecha de hoy en diferentes formatos:\n" + diaDeMes + '/' + (mesActual +1) + '/' + anoActual + 
        "\n" +  dias[numDiaSemana] + ", " + diaDeMes + " de " + meses[mesActual] + " de " + anoActual +
        "\n" +  diasSemanaIngles[numDiaSemana] + ", " + mesesEnIngles[mesActual] + ' ' + diaDeMes + "th, " + anoActual);


/* 3 ******************************************************************************************************
    Crea un programa que muestre la hora actual en diferentes formatos:
    21:05:36 (hora detallada con minutos y segundos)
    21:05 PM o 09:25 AM (AM antes del mediodía, PM después del medio día)
************************************************************************************************************/
alert("Hora actual en diferentes formatos:\nHora detallada: " + hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds() + 
    "\nAM o PM: " +  hoy.getHours() + ':' + hoy.getMinutes() + (hoy.getHours() > 11 ? ' PM' : ' AM'));


/* 4 ******************************************************************************************************
    Crea un programa que pida al usuario que elija una opción del siguiente menú:
    Potencia
    Raíz
    Redondeo
    
    Si el usuario introduce 1, se le deberá pedir una base y un exponente y se mostrará el resultado en pantalla "La potencia de X elevado a Y es: "
    Si el usuario introduce 2, se le pedirá un número(no negativo) y se mostrará el resultado en pantalla "La raíz de X es: "
    Si el usuario introduce 3, se le pedirá un decimal y se mostrará por pantalla el redondeo con un número entero "El redondeo del número X es: "
************************************************************************************************************/
const MENU = "Elija una opción del menú(número 1 al 3): \n1-Potencia\n2-Raíz\n3-Redondeo";
let opcion = parseInt(prompt(MENU));

while(opcion < 1 || opcion > 3 || isNaN(opcion)){ //Si no es correcta, volvemos a lanzar el menú
    alert("Opción errónea!! Debe elegir una de las opciones posibles.");
    opcion = parseInt(prompt(MENU));
}

switch (opcion) {
    case 1:
        potencia();
        break;
    case 2:
        raiz();
        break;
    case 3:
        redondeo();
        break;
}

function potencia(){
    const base = parseInt(prompt("Introduzca la base"));
    const exponente = parseInt(prompt("Introduzca el exponente"));
    alert("La potencia de " + base + " elevado a " + exponente + " es: " + Math.pow(base, exponente));
}

function raiz(){
    const numero = parseInt(prompt("Introduzca un número(no negativo)"));
    alert("La raíz de " + numero + " es: " + Math.sqrt(numero));
}

function redondeo(){
    const numero = prompt("Introduzca un número con decimales para redondear.");
    alert("El redondeo del número " + numero + " es: " + Math.round(numero));
}

/* 5 ******************************************************************************************************
    Crea un programa que pida al usuario su nombre y apellidos  y muestre:.
    Una propuesta de nombre de usuario con la 1º inicial del nombre + 3 iniciales del primer apellido + 3 iniciales del segundo apellido ej: yguaper
    Una propuesta de nombre de usuario con las 3 primeras letras del nombre + 3 primeras del primer apellido + 3 primeras del segundo apellido ej: yaiguaper
************************************************************************************************************/
const nombreCompleto = prompt("Introduza su nombre completo.");
const partes = nombreCompleto.split(" ");
const nombre = partes[0];
const primerApellido = partes[1];
const segundoApellido = partes[2];
alert("Propuesta de nombre de usuario 1: " + nombre[0].toLowerCase() + primerApellido.slice(0, 3).toLowerCase() + segundoApellido.slice(0, 3).toLowerCase());
alert("Propuesta de nombre de usuario 2: " + nombre.slice(0, 3).toLowerCase() + primerApellido.slice(0, 3).toLowerCase() + segundoApellido.slice(0, 3).toLowerCase());



/* 6 ******************************************************************************************************
    Crea un programa que pida al usuario una propuesta de contraseña y compruebe si cumple con los siguientes requisitos:
    Tiene entre 8 y 16 caracteres
    Tiene una letra mayúscula
    Tiene una letra minúscula
    Tiene un número
    Tiene uno de los siguientes valores: - (guión alto), _ (guión bajo), @ (arroba), # (almohadilla), $ (dólar), % (tanto por ciento), & (ampersand)

    Si cumple con todos los requisitos se considera una contraseña segura, de lo contrario mostrará que es una contraseña no segura.
************************************************************************************************************/
const caracteresEspeciales = "-_@#$%&";
let contrasena = prompt("Introduce una contraseña para validarla:");

const longitudValida = contrasena.length >= 8 && contrasena.length <= 16;
let tieneMayuscula = false;
let tieneMinuscula = false;
let tieneNumero = false;
let tieneCaracterEspecial = false;

for (let caracter of contrasena) {

    // Comprobar si es una letra mayúscula
    if (caracter >= 'A' && caracter <= 'Z') {
        tieneMayuscula = true;
    }
    
    // Comprobar si es una letra minúscula
    if (caracter >= 'a' && caracter <= 'z') {
        tieneMinuscula = true;
    }

    // Comprobar si es un número
    if (caracter >= '0' && caracter <= '9') {
        tieneNumero = true;
    }

    // Comprobar si es un carácter especial
    if (caracteresEspeciales.includes(caracter)) {
        tieneCaracterEspecial = true;
    }
}

if (longitudValida && tieneMayuscula && tieneMinuscula && tieneNumero && tieneCaracterEspecial) {
    alert("Contraseña segura.");
} else {
    alert("Contraseña no segura. Asegúrate de que tenga:\n- Entre 8 y 16 caracteres" + 
        "\n- Al menos una letra mayúscula\n- Al menos una letra minúscula\n- Al menos un número" + 
        "\n- Al menos uno de los siguientes caracteres: - _ @ # $ % &\n " + longitudValida + tieneMayuscula + tieneMinuscula + tieneNumero + tieneCaracterEspecial);
}


/* 7 ******************************************************************************************************
    Crea un programa que tenga los siguientes botones para permitir modificar las siguientes propiedades de una ventana:
    Mover+10: moverá la ventana 10px a la derecha y abajo cada vez que se pulse en dicho botón.
    MoverPos: moverá la ventana a la posición 100,100.
    Width: aumentará el ancho de la ventana en 10px cada vez que se pulse
    Height: aumentará el alto de la ventana en 10px cada vez que se pulse
    Scroll: Colocará un scroll a la ventana
************************************************************************************************************/
//Le indico posición o si no sale pegada a una esquina de la pantalla(al menos en mi pc)
const VENTANA = window.open("", "ventanaNueva", "width=100, height=100, left=300, top=300"); 
document.write('<button onclick="mover10()">Mover +10</button><br><br>');
document.write('<button onclick="moverPos()">Mover pos</button><br><br>');
document.write('<button onclick="aumentarAncho()">Width</button><br><br>');
document.write('<button onclick="aumentarAlto()">Height</button><br><br>');
document.write('<button onclick="anadirScroll()">Scroll</button>');

function mover10() {
    VENTANA.moveBy(10, 10); 
}

function moverPos(){
    VENTANA.moveTo(100, 100);
}

function aumentarAncho(){
    VENTANA.resizeBy(10, 0);
}

function aumentarAlto(){
    VENTANA.resizeBy(0, 10);
}

function anadirScroll(){
    VENTANA.document.body.style.overflow = "scroll"; 
}