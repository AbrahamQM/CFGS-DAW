window.onload = iniciar;

function iniciar() {
    // Asocio los eventos con los botones
    document.getElementById("verTodas").addEventListener("click", verCookies);
    document.getElementById("crearCookie").addEventListener("click", crearModifCookie);
    document.getElementById("modificarCookie").addEventListener("click", crearModifCookie);
    document.getElementById("leerCookie").addEventListener("click", leerCookie);
    document.getElementById("borrarCookie").addEventListener("click", borrarCookie);
}

// Funciones que necesitamos para pedirle al usuario los valores para trabajar con las cookies
function crearModifCookie () {
    let nombre = prompt ("Introduzca el nombre de la cookie");
    let valor = prompt ("Introduzca el valor de la cookie");
    let expiracion = parseInt(prompt("Introduzca el número de días para que expire"));
    setCookie(nombre, valor, expiracion);
    verCookies();
}

function leerCookie () {
    let nombre = prompt ("Introduzca el nombre de la cookie a consultar");
    let resultado = getCookie(nombre);
    alert(resultado);
}

function borrarCookie () {
    let nombre = prompt ("Introduzca el nombre de la cookie a borrar");
    deleteCookie(nombre);
    verCookies();
}

// Declaración de Funciones genéricas de las cookies (podemos tenerla en un fichero externo ya que lo usaremos frecuentemente)
function verCookies () {
    alert ("Cookies actuales:\n" + document.cookie);
}

function deleteCookie (nombre) {
    setCookie (nombre, "", 0); //si le pasamos 0 se caduca en el dia de hoy
}

function setCookie (nombre, valor, expiracion) {   //expiracion será el nº de días que queremos que se expire
    let fecha = new Date();   //obtenemos la fecha actual
    //Obtenemos la fecha y hora actual + (nº días * 24 h/dia, 60min/h, 60seg/min, 1000 mseg/seg) convertimos el número de días a fecha.
    fecha.setTime(fecha.getTime() + expiracion*24*60*60*1000); 
    expiracion = "expires = " + fecha.toUTCString();
    alert (expiracion);
    document.cookie = nombre + "=" + valor + ";" + expiracion + "; path=/;";
}

function getCookie (nombre) {
    let nom = nombre+"=";
    let array = document.cookie.split(";"); //separo las cookies y las guardo en un array
    for (let i = 0; i < array.length; i++) {
        let c = array[i];
        while (c.charAt(0) == " ") {     //hasta que no lleguemos al final de la cadena
            c = c.substring(1);         //lo vamos almacenando en una cadena.
        }
        if (c.indexOf(nombre) == 0) {   //si encuentra la cookie
            return c.substring(nom.length, c.length); //devolvemos el par nombre valor de la cookie
        }
    }
    return "";    // devolvemos vacío porque no encontró la cookie.
}