window.addEventListener("load", inicio);

function inicio() {
    document.getElementById("provincias").style.visibility = "hidden"; 
    document.getElementById("etiq_provincias").style.visibility = "hidden"; 
    document.getElementById("municipios").style.visibility = "hidden"; 
    document.getElementById("etiq_municipios").style.visibility = "hidden";   
    mostrar_comunidades();
    document.getElementById("comunidades").addEventListener("change", mostrar_provincias);
    document.getElementById("provincias").addEventListener("change", mostrar_municipios);
}   
    
function mostrar_comunidades () {
    let objeto = {
        "tabla": "comunidades",
    };
    let xhttp = new XMLHttpRequest(); 
    xhttp.onreadystatechange = function () {     //se llama a la funcion 5 veces que son los pasos 
        if ((this.readyState == 4) && (this.status == 200)) {
            //Parseamos el array
            let array = JSON.parse(this.responseText);   //php siempre devuelve texto y lo parseamos a JSON a una letiable para trabajar con ella en JavaScript
            //Recorremos el array  
            let comunidad = document.getElementById("comunidades");
            let c = document.createElement("option");
            c.text = "";   //creamos uno en blanco
            comunidad.options.add(c, 0);
            for (let i = 0; i < array.length; i++) {
                let comunidad = document.getElementById("comunidades");
                let c = document.createElement("option");
                c.text = array[i].nombre;
                c.value = array[i].id_comunidad;
                comunidad.options.add(c, i);                          
            }          
        }
    }
    let parametros = JSON.stringify(objeto);   
    //Envío con POST
    xhttp.open("POST", "acceso_bd.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("objeto="+parametros);
}

function borrar_provincias (e) {
    let selec_pro = document.getElementById("provincias");
    selec_pro.innerHTML = "";   //vacío los municipios del select para que se vuelvan a cargar según la provincia   
    document.getElementById("provincias").style.visibility = "visible";   
    document.getElementById("etiq_provincias").style.visibility = "visible";   
}

function mostrar_provincias(e) {
    borrar_municipios();    
    borrar_provincias();
    let pro = e.target;
    let objeto = {
        "tabla": "provincias",
    };
    let xhttp = new XMLHttpRequest();
    let txt = "";
    xhttp.onreadystatechange = function () {     //se llama a la funcion 5 veces que son los pasos 
        if ((this.readyState == 4) && (this.status == 200)) {
            //Parseamos el array
            let array = JSON.parse(this.responseText);   //php siempre devuelve texto y lo parseamos a JSON a una letiable para trabajar con ella en JavaScript
            //Recorremos el array
            let txt="";
            let provincias = document.getElementById("provincias");
            let c = document.createElement("option");
            c.text = "";   //creamos uno en blanco
            provincias.options.add(c, 0);
            for (let i = 0; i < array.length; i++) {
                if (array[i].id_comunidades == pro.value) {
                    provincias = document.getElementById("provincias");
                    c = document.createElement("option");
                    c.text = array[i].provincia;
                    c.value = array[i].id_provincia;
                    provincias.options.add(c, i);                          
               }
            }
        }
    }
    let parametros = JSON.stringify(objeto);
    //Envío con POST
    xhttp.open("POST", "acceso_bd.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("objeto="+parametros);

}


function borrar_municipios (e) {
    //Cada vez que pulso en provincia borro los municipios para poner los nuevos
    let selec_mun = document.getElementById("municipios");
    selec_mun.innerHTML = "";   //vacío los municipios del select para que se vuelvan a cargar según la provincia 
    document.getElementById("municipios").style.visibility = "hidden"; 
    document.getElementById("etiq_municipios").style.visibility = "hidden";    
}

function mostrar_municipios(e) {
    borrar_municipios();
    document.getElementById("municipios").style.visibility = "visible"; 
    document.getElementById("etiq_municipios").style.visibility = "visible"; 
    let pro = e.target;
    let objeto = {
        "tabla": "municipios",
    };
    let xhttp = new XMLHttpRequest();
    let txt = "";
    xhttp.onreadystatechange = function () {     //se llama a la funcion 5 veces que son los pasos 
        if ((this.readyState == 4) && (this.status == 200)) {
            //Parseamos el array
            let array = JSON.parse(this.responseText);   //php siempre devuelve texto y lo parseamos a JSON a una letiable para trabajar con ella en JavaScript
            //Recorremos el array
            let txt="";
            let municipios = document.getElementById("municipios");
            let c = document.createElement("option");
            c.text = "";   //creamos uno en blanco
            municipios.options.add(c, 0);
            for (let i = 0; i < array.length; i++) {
                if (array[i].id_provincia == pro.value) {
                    municipios = document.getElementById("municipios");
                    c = document.createElement("option");
                    c.text = array[i].nombre;
                    c.value = array[i].id_provincia;
                    municipios.options.add(c, i); 
                }                      
            }          
        }
    }
    let parametros = JSON.stringify(objeto);
    //Envío con POST
    xhttp.open("POST", "acceso_bd.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("objeto="+parametros);

}
