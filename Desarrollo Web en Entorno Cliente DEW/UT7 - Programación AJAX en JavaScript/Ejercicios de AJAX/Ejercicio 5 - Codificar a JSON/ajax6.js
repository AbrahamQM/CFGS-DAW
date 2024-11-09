window.addEventListener("load", inicio);

function inicio() {
    document.getElementById("mostrar").addEventListener("click", mostrar);  //pulsar una tecla y levantar dedo
}   
    
function mostrar () {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {     //se llama a la funcion 5 veces que son los pasos 
        if ((this.readyState == 4) && (this.status == 200)) {
            //Al  hacer parse nos devuelve un objeto
            let objeto = JSON.parse(this.responseText);

            //Mostramos los datos
            document.getElementById("parrafo").innerHTML = "El título de " + objeto.titulo + " tiene el módulo " + objeto.modulo + " y el grupo " + objeto.grupo + "<br/>";
        
            //Convertimos el objeto JavaScript en una cadena
            let cadena = JSON.stringify(objeto);
            document.getElementById("parrafo").innerHTML += "El objeto " + objeto + " en modo cadena es " + cadena + "<br/>";
        }
    };
    xhttp.open("GET", "ajax_json.php", true);
    xhttp.send();   
}   



