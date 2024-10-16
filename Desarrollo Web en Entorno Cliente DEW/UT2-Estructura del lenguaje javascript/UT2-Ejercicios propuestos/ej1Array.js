"use strict" 
//1) Array: En un array tienes los doce meses escritos con letra, solicítale al usuario 
// un número, busca el mes correspondiente en el array y muestra su nombre por 
// pantalla.
const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
const numMes = prompt("Introduce número de mes: ");
const mes = meses[numMes - 1];
alert('El mes correspondiente a el número ' + numMes.toString() +  ' es: '  + mes); 