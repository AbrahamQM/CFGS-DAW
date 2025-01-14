const obtieneLetra = () => {
    const letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];

    const dni = prompt("Introduzca DNI");
    alert(letras[dni%23]);

}

// obtieneLetra();


const ejercicio2 = () => {
    let par = [];
    let impar = [];
    const minimo = prompt("Introduzca el valor mínimo(incluído) del intervalo para generar números de forma aletoria");
    const maximo = prompt("Introduzca el valor máximo(excluido) del intervalo para generar números de forma aleatoria");

    
}

const aleatorio = ( min, max) =>{
    return Math.random();
}