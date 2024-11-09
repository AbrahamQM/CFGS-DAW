window.addEventListener("load", inicio);

function inicio() {
    document.getElementById("nombre").addEventListener("keyup", mostrarNombre);  //pulsar una tecla y levantar dedo
}   
    
function mostrarNombre (e) {                
    let cadena = e.target.value;            //texto que contiene nombre hasta el momento
    //Comprobamos lo que hay en la cadena
    if (cadena.length == 0) { //Si lo hemos borrado
        document.getElementById("sugerencia").innerHTML = "";
    }
    else {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {     //se llama a la funcion 5 veces que son los pasos 
            if ((this.readyState == 4) && (this.status == 200)) {
                document.getElementById("sugerencia").innerHTML = this.responseText;    //php es texto
            }
        };
        xhttp.open("GET", "arraynombres.php?nombre="+cadena, true);   //pasamos por get la letiable nombre con su valor
        xhttp.send();
    }   
}


