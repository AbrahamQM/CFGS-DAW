//En clase me había planteado trabajar con ua función que instancie un edificio,
//Pero viendo el ejemplo en el que se trabaja con el prototipo, prefiero trabajar 
//de esta manera, ya que nunca había trabajado con prototipos antes:
function Edificio(c, num, cp) {
    // Calle.
    this.calle = c;
    // Número de la calle.
    this.numero = num;
    // Código postal.
    this.codigo = cp;
    // Plantas del edificio.
    this.plantas = [];
    //Número de puertas/planta. Según consulté en clase, todas las plantas tienen el mismo número de puertas
    this.puertas = 0;
    // Imprimo en pantalla
    document.write("Construido nuevo edificio en calle: " + this.calle + " nº: " + this.numero + " CP: " + this.codigo + ".<br>");

}

/*
-agregarPlantasYPuertas(numplantas, puertas)  Se le pasa el número de plantas que queremos crear en el piso y el número de puertas por planta. 
Cada vez que se llame a este método, añadirá el número de plantas y puertas indicadas en los parámetros, a las que ya están creadas en el edificio.
*/
Edificio.prototype.agregarPlantasYPuertas = function(numplantas, puertas){
    this.puertas += puertas;

    for (let i = 0; i < numplantas; i++) {
        let planta = [];

        for (let j = 1; j <= this.puertas; j++){
            planta.push({ nombrePropietario: ""});
        }

        this.plantas.push(planta);
    }

    document.write("<br>-Añadidas " + numplantas + " plantas al edificio y, a cada planta se le han añadido " + puertas + ' puertas.<br>');
}

//-modificarNumero(numero)  Se le pasa el nuevo número del edificio para que lo actualice.
Edificio.prototype.modificarNumero = function(numero){
    this.numero = numero;
    document.write("<br>-Se ha modificado el nº del edificio a: " + this.numero);
}

// -modificarCalle(calle)  Se le pasa el nuevo nombre de la calle para que lo actualice.
Edificio.prototype.modificarCalle = function(calle){
    this.calle = calle;
    document.write("<br>-Se ha modificado la calle del edificio a: " + this.calle);
}

//-modificarCodigoPostal(codigo)  Se le pasa el nuevo número de código postal del edificio.
Edificio.prototype.modificarCodigoPostal = function(cp){
    this.codigo = cp;
    document.write("<br>-Se ha modificado el CP del edificio a: " + this.codigo);
}

// --imprimeCalle  Devuelve el nombre de la calle del edificio.
Edificio.prototype.imprimeCalle = function(){
   return this.calle;
}

//-imprimeNumero  Devuelve el número del edificio.
Edificio.prototype.imprimeNumero = function(){
    return this.numero;
}

//-imprimeCodigoPostal  Devuelve el código postal del edificio.
Edificio.prototype.imprimeCodigoPostal = function(){
    return this.codigo;
}

//-agregarPropietario(nombre,planta,puerta)  Se le pasa un nombre de propietario, un número de planta 
//y un número de puerta y lo asignará como propietario de ese piso.
Edificio.prototype.agregarPropietario = function (nombre, planta, puerta) {
    this.plantas[planta-1][puerta - 1].nombrePropietario = nombre; 
    document.write("<br>-" + nombre + " es ahora el propietario de la puerta: " + puerta + " de la planta: " + planta);
}

//-imprimePlantas  Recorrerá el edificio e imprimirá todos los propietarios de cada puerta.
//he usado un for extendido en lugar del for que usé en el método agregarPlantasYPuertas para usar uno de cada clase.
Edificio.prototype.imprimePlantas = function(){
    let piso = 1;
    for (let planta of this.plantas){
        let door = 1;
        for (let puerta of planta){
            document.write("<br>-Propietario del piso "  + door + " de la planta " + piso + ' ' + puerta.nombrePropietario + "<br>");
            door++;
        }
        piso++;
    }
}

/*Instanciamos 3 objetos edificioA, edificioB y edificioC con estos datos
Construido nuevo edificio en calle Garcia Prieto, nº 58, CP 15706.
Construido nuevo edificio en calle Camino Caneiro, nº 29, CP 32004.
Construido nuevo edificio en calle San Clemente, nº sn, CP 15705.*/
let edificioA = new Edificio("Garcia Prieto", "58", "15706");
let edificioB = new Edificio("Camino Caneir", "29", "32004");
let edificioC = new Edificio("San Clemente", "sn", "15705");
//El código postal del edificio A es 15706.
document.write("<br>El código postal del edificioA es: " + edificioA.imprimeCodigoPostal());

//La calle del edificio C es San Clemente.
document.write("<br>La calle del edificio C es : " + edificioC.imprimeCalle());

// El edificio B está situado en la calle Camino Caneiro número 29.
document.write("<br>El edificio B está situado en la calle: " + edificioB.imprimeCalle() + " número: " + edificioB.imprimeNumero());

/*Agregamos 4 propietarios al edificio A...
Jose Antonio Lopez es ahora el propietario de la puerta 1 de la planta 1.
Luisa Martinez es ahora el propietario de la puerta 2 de la planta 1.
Marta Castellón es ahora el propietario de la puerta 3 de la planta 1.
Antonio Pereira es ahora el propietario de la puerta 2 de la planta 2.*/
edificioA.agregarPlantasYPuertas(2, 3); 
edificioA.agregarPropietario("Jose Antonio Lopez", 1, 1);
edificioA.agregarPropietario("Luisa Martinez", 1, 2);
edificioA.agregarPropietario("Marta Castellón", 1, 3);
edificioA.agregarPropietario("Jose Antonio Lopez", 2, 2);

/*Listado de propietarios del edificio calle García Prieto número 58
Propietario del piso 1 de la planta 1 Jose Antonio Lopez.
Propietario del piso 2 de la planta 1 Luisa Martinez.
Propietario del piso 3 de la planta 1 Marta Castellón.
Propietario del piso 1 de la planta 2
Propietario del piso 2 de la planta 2 Antonio Pereira.
Propietario del piso 3 de la planta 2*/
document.write("<br><br><b>Listado de propietarios del edificio calle " + edificioA.imprimeCalle() + " número: " + edificioA.imprimeNumero() +"</b>");
edificioA.imprimePlantas();

//Agregamos 1 planta más al edificio A...
edificioA.agregarPlantasYPuertas(1, 0);

/*Agregamos 1 propietario más al edificio A planta 3, puerta 2...
Pedro Meijide es ahora el propietario de la puerta 2 de la planta 3.*/
console.log(edificioA);
edificioA.agregarPropietario("Pedro Meijide", 3, 2);

/*Listado de propietarios del edificio calle García Prieto número 58
Propietario del piso 1 de la planta 1 Jose Antonio Lopez.
Propietario del piso 2 de la planta 1 Luisa Martinez.
Propietario del piso 3 de la planta 1 Marta Castellón.
Propietario del piso 1 de la planta 2
Propietario del piso 2 de la planta 2 Antonio Pereira.
Propietario del piso 3 de la planta 2
Propietario del piso 1 de la planta 3
Propietario del piso 2 de la planta 3 Pedro Meijide.*/
document.write("<br><br><b>Listado de propietarios del edificio calle " + edificioA.imprimeCalle() + " número: " + edificioA.imprimeNumero() +"</b>");
edificioA.imprimePlantas();
