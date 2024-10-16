window.onload = ejercicio;

//función que se ejecutará cuando se hayan obtenido todos los datos
function ejercicio(){ 
    const VENTANA = window.open("", "ventanaNueva", "with=500, height=500");
//Textos a mostrar obteniendo los atributos del documento y el navegador según se requiere.
    VENTANA.document.write("<h3>Ejemplo de Ventana Nueva</h3><br>"); 
    VENTANA.document.write("URL Completa: " + document.URL +"<br>");
    VENTANA.document.write("Protocolo utilizado:" + window.location.protocol + "<br>");
    VENTANA.document.write("¿El navegador está conectado a internet?: " + navigator.onLine + "<br>");
    VENTANA.document.write("El lenguaje preferido por el navegador: " + navigator.language + "<br>");
    VENTANA.document.write("¿El navegador tiene un visor de PDF incorporado habilitado? " + tienepluginPDF() + "<br>");
//Iframe a incrustar 
    VENTANA.document.write("<iframe src='https://www3.gobiernodecanarias.org/medusa/edublog/cifpcesarmanrique/' width='800' height='600'></iframe>" );
}

//función para obtener si el navegador contiene algún plugin para leer pdf
function tienepluginPDF(){
    for (const plugin of navigator.plugins) {
        //pongo el ? al acceder a los atributos para verificar que no es null o undefined antes de intentar acceder al mismo
        if (plugin?.name?.includes('PDF')){ 
            return true;
        } 
    };
    return false;
}

//Variables a obtener.
let nombre = prompt("Introduzca su nombre completo.");
let diaNacimiento = prompt("Introduzca su día de nacimiento.");
let mesNacimiento = prompt("Introduzca su mes de nacimiento.");
let anoNacimiento = prompt("Introduzca su año de nacimiento.");
//Obtengo un Date a partir de los datos de nacimiento.
const fechaNacimiento = new Date(anoNacimiento, mesNacimiento - 1, diaNacimiento); 
//array para acceder a el día concreto de la semana en texto (el valor comienza por el domingo)
const dias = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"]; 

//Función para calcular la edad tenienco en cuenta el día de hoy
function calcularEdad() { 
    const hoy = new Date();
    const mesActual = hoy.getMonth();
    const diaActual = hoy.getDate();
    let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();

    if (mesActual < mesNacimiento - 1 || (mesActual === mesNacimiento - 1 && diaActual < diaNacimiento)) {
        edad--; 
    }

    return edad;
}

document.write("Buenos días " + nombre + "<br>");
document.write("Tu nombre tiene " + nombre.length + " caracteres, incluidos espacios.<br>");
//corrijo el indice al obtener las posiciones primera y última de la letra a lo paso a minúsculas para que encuentre también las A(mayúscula)
document.write("La primera letra A de tu nombre está en la posición: " + (nombre.toLocaleLowerCase().indexOf('a') + 1) +"<br>");
document.write("La última letra A de tu nombre está en la posición: " + (nombre.toLocaleLowerCase().lastIndexOf('a') + 1) +"<br>");
document.write("Tu nombre menos las 3 primeras letras es: " + nombre.slice(3) + "<br>");
document.write("Tu nombre todo en mayúsculas es: " + nombre.toUpperCase() + "<br>");
document.write("Tu edad es: " + calcularEdad() + " años.<br>");
//Accedo al día de la semana usando el array y el valor del día de la fecha de nacimiento
document.write("Naciste un feliz " + dias[fechaNacimiento.getDay()] + " del año " + fechaNacimiento.getFullYear() + ".<br>");
document.write("El coseno de 180 es: " + Math.cos(180) + "<br>");
document.write("El número mayor de (34,67,23,75,35,19) es: " + Math.max(34,67,23,75,35,19) + "<br>");
document.write("Ejemplo de número al azar: " + Math.random());

//Considero que las sentencias no comentadas, no necesitan más explicación.
//Saludos
//Abraham Quintana 2ºDaw-Semi B