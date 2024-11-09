window.addEventListener("load", inicio);

function inicio() {
    let daw = {"modulo" : "dew", "grupo" : "752NNS"};
    // Acceso: utilizamos la notación punto
    alert(daw.modulo +" : " + daw.grupo);
    // alert(daw["modulo"]+" : "+ daw["grupo"]);

    //Recorrer nombres de un objeto
    for (let x in daw) {
        document.getElementById("demo").innerHTML += x+":"+daw[x]+"<br/>";
    }

    //Objetos que contienen otros objetos
    let daw2 = {
        "nombre": "Desarrollo de Aplicaciones Web",
        "modulos": {
            "modulo1": "dew",
            "modulo2": "dor",
            "modulo3": "bae"
        }    
    }

    //Acceso a un objeto dentro de otro
    let y = daw2.modulos.modulo1;      //daw2.modulos[modulo1];
    alert ("Módulo1 es " +y);

    //Array: nombre del array y entre [] los valores
    let daw3 = {
        "modulos":["dew", "dor", "bae"]
    }

    //Acceso al array
    let z = daw3.modulos[1];
    alert ("Módulo 2 es " + z);

    //Recorrer los elementos de un array
    let z1 = "";
    for (let i in daw3.modulos) {
        z1 += daw3.modulos[i]+", ";
    }
    document.getElementById("demo").innerHTML += "Todos los módulos: " + z1 + "<br/>";
    
    let z2 = "";
    for (let i= 0; i < daw3.modulos.length; i++) {
        z2 += daw3.modulos[i]+", ";
    }
    document.getElementById("demo").innerHTML += "Todos los módulos " + z2 + "<br/>";

    //Si queremos borrar los elementos de un objeto utilizamos delete.
}   
    
