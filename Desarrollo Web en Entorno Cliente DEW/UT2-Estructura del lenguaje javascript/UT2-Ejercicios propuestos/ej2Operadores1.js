"use strict" 
// 2) Operadores1: En el siguiente array de valores, realiza operaciones de &&, ||, 
// (entre los dos primeros valores) y suma, resta, multiplicación, división y módulo 
// entre los dos últimos valores.
 const valores = [false, true, 7, 3];
 console.log('Operación && resultado: ' + (valores[0] && valores[1])); //Operación && resultado: false
 console.log('Operación || resultado: ' + (valores[0] || valores[1])); //Operación || resultado: true
 console.log('Operación + resultado: ' + (valores[2] + valores[3])); //Operación + resultado: 10
 console.log('Operación - resultado: ' + (valores[2] - valores[3])); //Operación - resultado: 4
 console.log('Operación x resultado: ' + (valores[2] * valores[3])); //Operación x resultado: 21
 console.log('Operación / resultado: ' + (valores[2] / valores[3])); //Operación / resultado: 2.3333333333333335
 console.log('Operación % resultado: ' + (valores[2] % valores[3])); //Operación % resultado: 1
//  ¿Qué ocurriría si ponemos true y false entre comillas “true”, “false”?
console.log('Operación && resultado: ' + ("false" && "true")); //Operación && resultado: true ej2Operadores1.js:14:9
 
console.log('Operación || resultado: ' + ("false" || "true")); //Operación || resultado: false
