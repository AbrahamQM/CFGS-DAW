window.addEventListener("load", inicio);
function inicio() {
    document.getElementById("cargaCatalogo").addEventListener("click", cargarCatalogo);
}   
    
function cargarCatalogo () {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {     //cargamos un xml
        if ((this.readyState == 4) && (this.status == 200)) {
            cargarXML(this);
        }
    };
    xhttp.open("GET", "cd_catalog.xml", true);
    xhttp.send();
}

function cargarXML (xml) {
    //capturamos la respuesta
    let docXML = xml.responseXML;
    let tabla = "<tr><th>CD </th><th>Title</th><th>Artist</th><th>Country</th><th>Company</th><th>Price</th><th>Year</th></tr>";
    let discos = docXML.getElementsByTagName("CD");                   //Un array con todos los CD
    for (let i = 0; i < discos.length; i++) {
        tabla += "<tr><td>"
        tabla += "Nª " + i;
        tabla += "</td><td>";
        tabla += discos[i].getElementsByTagName("TITLE")[0].textContent;
        tabla += "</td><td>";
        tabla += discos[i].getElementsByTagName("ARTIST")[0].textContent;      
        tabla += "</td><td>";
        tabla += discos[i].getElementsByTagName("COUNTRY")[0].textContent; 
        tabla += "</td><td>";
        tabla += discos[i].getElementsByTagName("COMPANY")[0].textContent; 
        tabla += "</td><td>";
        tabla += discos[i].getElementsByTagName("PRICE")[0].textContent; 
        tabla += "</td><td>";  
        tabla += discos[i].getElementsByTagName("YEAR")[0].textContent; 
        tabla += "</td></tr>";
    }
    document.getElementById("tabla").innerHTML = tabla;
}
