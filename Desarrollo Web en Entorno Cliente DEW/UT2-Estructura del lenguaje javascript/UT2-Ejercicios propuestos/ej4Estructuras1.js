// 4) Estructuras1: Solicita por pantalla una edad (comprueba que introduzca un 
//     número), si es mayor de Edad lo dejamos entrar en la web 
//     https://www.doradaespecial.com si no, le informamos que no puede entrar en la 
//     web

const edad = prompt('Introduce tu edad: ');

if( !isNaN(edad) && edad > 17 ){
    window.location.href = 'https://www.doradaespecial.com';
} else if(!isNaN(edad) ){
    alert('Lo siento no puedes/debes beber cerveza aún.');
}else{
    alert('No has introducido un número válido.');
}