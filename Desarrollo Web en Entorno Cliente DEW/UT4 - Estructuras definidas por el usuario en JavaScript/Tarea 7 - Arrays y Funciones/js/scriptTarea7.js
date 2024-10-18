
function edificio ( calle, numero, cp){
    this.calle = calle;
    this.numero = numero;
    this.cp = cp;

    function agregarPlantasYPuertas(numPlantas, puertas){
        this.numPlantas += numPlantas;
        this.puertas += puertas;
    }
    
    function modificarNumero(numero){
        this.numero = numero;
    }

    function modificarCalle(calle){
        this.calle = calle;
    }

    function modificarCodigoPostal(codigo) {

    }

    function imprimeCalle(){
        return calle;
    }

    function imprimeNumero(){
        return numero;
    }
    propietarios = [[]];
}


