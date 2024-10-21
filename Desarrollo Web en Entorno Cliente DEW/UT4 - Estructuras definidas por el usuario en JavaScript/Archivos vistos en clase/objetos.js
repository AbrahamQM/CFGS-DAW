//1.Definir un objeto simple utilizando un literal

let edificio = {
    calle: "García Prieto",
    numero: 58,
    codigoPostal: 15706,
};

//2.Definir y crear un objeto simple utilizando la palabra new

let edificio = new Object();
edificio.calle = "García Prieto";
edificio.numero = 58;
edificio.codigoPostal = 15706;

//3.Definir un constructor de un objeto y crear objetos del tipo construido
function edificio (c, num, cp) {
    this.calle = c;
    this.numero = num;
    this.codigoPostal = cp;
}

let edifA = new edificio ("García Prieto", 58, 15706);


//Objetos prototipos
//Todos los objetos tienen un prototipo que a su vez es un objeto. Y este objeto tiene las 
//propiedades y métodos asociados al objeto que estamos creando.

function Persona (nom, ape,an) {
    this.nombre = nom;
    this.apellido = ape;
    this.anio = an;
    this.nombreCompleto = function () {
        return this.nombre + " " + this.apellido;
    }
}

Persona.prototype.genero = "femenino";
Persona.prototype.listadoPersonas = function (listado) {
    for (x in listado) {  //Recorre cada item de un array
        document.write ("La persona en la posición " + x + " es :" + listado[x]);
    }
};