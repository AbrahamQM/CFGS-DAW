class Edificio{
    //Se detallan las propiedades del objeto
    // Calle.
    calle;
    // Número de la calle.
    numero;
    // Código postal.
    codigo;
    // Número de plantas del edificio.
    plantas;
    //Un objeto necesita un constructor
    constructor(calle, numero,codigo){  // contrucutor de edificios
        this.calle = calle;
        this.numero = numero;
        this.codigo = codigo;
        this.plantas = [];
        // Imprimo en pantalla
        document.write ("Construido nuevo edificio en calle: " + this.calle + " nº: "+ this.numero + " CP: "+ this.codigo + "</br>");
    }
    //Se detallan las funciones del objeto
    agregarPlantasYPuertas(numplantas, puertas) {
    
    }

    agregarPropietario(nombre, planta, puerta) {
   
    }

    imprimePlantas() {

    }

    modificarNumero(numero) {

    }

    modificarCalle(calle) {

    }

    modificarCodigoPostal(codigo) {

    }

    imprimeCalle() {

    }

    imprimeNumero() {

    }

    imprimeCodigoPostal() {


    }
} //Cierre del class (Objeto)

//Así se hace una instancia de un objeto
let edificioA = new Edificio("Garcia Prieto", "58", "15706");
//Así se llaman a las funciones de ese objeto
edificioA.agregarPlantasYPuertas();