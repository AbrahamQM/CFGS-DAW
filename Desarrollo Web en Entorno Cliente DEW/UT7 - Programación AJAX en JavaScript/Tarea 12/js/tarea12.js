const inicio = () => {
    /*
     Partiendo del fichero.html que se te proporciona en Información de Interés, se pide realizar los
     siguientes apartados:
    
    
    Descargamos el fichero.xml de la predicción detalla del tiempo en la página AETMET sobre el municipio que 
    queramos. Ver enlace en Información de interés.
    // ---En tegueste.xml
    */

    /*
    Creamos una función obtener fecha, que nos calcule la fecha de hoy y le sume 2 días, devolviéndola con el 
    formato aaaa-mm-dd.
    */
    const obtenerFecha = () => {
        const hoy = new Date("2024-11-14"); //pongo el día que obtuve el xml para que funcione en el futuro
        hoy.setDate(hoy.getDate() + 2); //Incremento la fecha en 2 días
        const ano = hoy.getFullYear();
        const mes = hoy.getMonth() + 1; //los meses empiezan por 0
        const dia = hoy.getDate();

        return ano + '-' + mes + '-' + dia;
    }

    const fechaABuscar = obtenerFecha();
    console.log(fechaABuscar);
    /*
    Comprobamos en el fichero.xml el atributo fecha de la etiqueta día que sea igual que el valor devuelto 
    por la función del apartado anterior.Encontramos la fecha moviéndonos por los nodos.
    */

    let nombre_municipio;
    const seleccionarDatos = (xml) => {
        nombre_municipio = xml.responseXML.getElementsByTagName("nombre")[0].textContent;
        let dias = xml.responseXML.getElementsByTagName("dia");
        for (let dia of dias) {
            if (dia.getAttribute("fecha") === fechaABuscar) {
                console.log(dia);
                mostrarDatos(dia);
            }
        }
    }

    const obtenerDatos = () => {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if ((this.readyState == 4) && (this.status == 200)) {
                    seleccionarDatos(this);
            }
        }
        xhttp.open("GET", "tegueste.xml", true);
        xhttp.send();
    }
    document.getElementById("temperatura").addEventListener("click", obtenerDatos, false);
    /*
    Procesamos el fichero.xml para obtener la temperatura máxima y mínima de dicho municipio dos días
    posteriores al de hoy.La etiqueta temperatura es hija de la etiqueta día, se debe acceder con children.

    Mostramos la siguiente información en el id = "parrafo" del html.Municipio: nombre_municipio,
            La predicción dentro de 2 días con fecha fecha en dos días es de: Tª máxima = valor1, Tª mínima = valor2 ". 
    Y deshabilitamos el botón Consultar Tª en municipios.

    */
    const mostrarDatos = (dia) => {
        //lo de acceder con children me parece mucho menos eficiente teniendo los métodos del DOM
        //pero podría hacerlo recorriendo el resultado de dia.children y seleccionando el que tenga 
        //el valor que busco
        const minima = dia.getElementsByTagName("minima")[0].textContent; 
        const maxima = dia.getElementsByTagName("maxima")[0].textContent;
        console.log(minima);
        console.log(maxima);
        const informacion = `Municipio: ${nombre_municipio}, La predicción dentro de 2 días con fecha`
            + ` fecha en dos días es de: Tª máxima = ${maxima}, Tª mínima = ${minima}`;
        document.getElementById("parrafo").innerText = informacion;
    }

}

window.addEventListener("load", inicio);