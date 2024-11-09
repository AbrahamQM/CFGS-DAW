window.addEventListener("load", inicio);

function inicio () {
    document.getElementById("cambiaContenido").addEventListener("click", cambiaContenido);
    function cambiaContenido () {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {            //función anónima
            if ((this.readyState == 4) && (this.status == 200)) {       //solicitud finaliza y respuesta lista
                document.getElementById("texto").innerHTML = this.responseText;    //Voy a extraer texto si fuera xml this.responseXML

            }
        };
        xhttp.open ("GET", "prueba.txt", true);
        xhttp.send();
    }
}