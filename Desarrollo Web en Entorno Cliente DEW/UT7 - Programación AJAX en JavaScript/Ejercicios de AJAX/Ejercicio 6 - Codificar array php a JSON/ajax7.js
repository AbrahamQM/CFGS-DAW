window.addEventListener("load", inicio);

function inicio() {
    document.getElementById("mostrar").addEventListener("click", mostrar);  //pulsar una tecla y levantar dedo
}   
    
function mostrar () {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {     //se llama a la funcion 5 veces que son los pasos 
        if ((this.readyState == 4) && (this.status == 200)) {
            //Parseamos el array
            let alumnos = JSON.parse(this.responseText);   //php siempre devuelve texto y lo parseamos a JSON a una letiable para trabajar con ella en JavaScript
            //Recorremos el array
            for (let i = 0; i < alumnos.length; i++) {
                document.getElementById("parrafo").innerHTML += alumnos[i] + " <br/>";
            }
            //Para convertir un array JavaScript en cadena JSON usamos
            let cadena = JSON.stringify(alumnos);
            document.getElementById("parrafo").innerHTML += "<br/> El array " + alumnos + " en modo cadena es " + cadena + "<br/>";
        }
    };
    xhttp.open("GET", "arraynombres.php", true);
    xhttp.send();  
}


