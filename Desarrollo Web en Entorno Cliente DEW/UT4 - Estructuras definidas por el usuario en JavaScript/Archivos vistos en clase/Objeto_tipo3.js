function Edificio(c, num, cp) {
    // Calle.
    this.calle = c;
    // Número de la calle.
    this.numero = num;
    // Código postal.
    this.codigo = cp;
    // Número de plantas del edificio.
    this.plantas = [];
    // Imprimo en pantalla
    document.write("Construido nuevo edificio en calle: " + this.calle + " nº: " + this.numero + " CP: " + this.codigo + "</br>");

}

Edificio.prototype.agregarPlantasYPuertas = function (numplantas, puertas) {

}

Edificio.prototype.agregarPropietario = function (nombre, planta, puerta) {

}

Edificio.prototype.imprimePlantas= function () {

}

Edificio.prototype.modificarNumero = function (numero) {

}

Edificio.prototype.modificarCalle = function (calle) {

}

Edificio.prototype.modificarCodigoPostal = function (codigo) {

}

Edificio.prototype.imprimeCalle = function () {

}

Edificio.prototype.imprimeNumero = function () {

}

Edificio.prototype.imprimeCodigoPostal = function () {

}

//Instanciamos nuestro objeto Edificio
let edificioA = new Edificio("Garcia Prieto", "58", "15706");
//llamamos método de nuestro objeto
edificioA.agregarPlantasYPuertas(2, 3);
