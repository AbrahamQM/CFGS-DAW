//Nota  hay que poner los ficheros del ejercicio en la carpeta C:\xampp\htdocs para que funcione
const scriptJs = () => {

    /*
    Previamente se debe crear en PhpMyAdmin que nos proporciona Xampp, la BD espana, ejecutar los 3 scripts sql que se proporcionan en Información de
    interés para crear las 3 tablas en la BD y todas las filas de las tablas con los datos proporcionados.
    
    Creamos un fichero.php para establecer la conexión a la BD mediante el método POST o GET. 
    Y convertimos la salida del fichero, en JSON con json_encode
    
    En el fichero.html solo se puede añadir la línea de referencia al fichero JavaScript (js)
    */

    /*
    Debemos ocultar el select id="provincias" e id="municipios y cargar con los datos de la BD las comunidades en el select id="comunidades". 
    Todos los select mostrarán el primer campo en blanco.
    */
    //Almaceno los elementos en constantes para despues reutilizarlos
    const selectComunidades = document.getElementById("comunidades");
    const selectProvincias = document.getElementById("provincias");
    const labelProvincias = document.getElementById("etiq_provincias");
    const selectMunicipios = document.getElementById("municipios");
    const labelMunicipios = document.getElementById("etiq_municipios");

    const estadoInicial = () => {
        // los oculto
        selectProvincias.style.visibility = "hidden";
        labelProvincias.style.visibility = "hidden";
        selectMunicipios.style.visibility = "hidden";
        labelMunicipios.style.visibility = "hidden";

        //seteo el primer campo en blanco
        //comunidades
        const optionBlancoComunidades = document.createElement("option");
        optionBlancoComunidades.id = "opcionBlancoComunidades";
        optionBlancoComunidades.value = "vacio";
        optionBlancoComunidades.innerText = "";


        //provincias
        const optionBlancoProvincia = document.createElement("option");
        optionBlancoProvincia.id = "optionBlancoProvincia";
        optionBlancoProvincia.value = "vacio";
        optionBlancoProvincia.innerText = "";
        //municipios
        const optionBlancoMunicipio = document.createElement("option");
        optionBlancoMunicipio.id = "optionBlancoMunicipio";
        optionBlancoMunicipio.value = "vacio";
        optionBlancoMunicipio.innerText = "";


        selectProvincias.appendChild(optionBlancoProvincia);
        selectMunicipios.appendChild(optionBlancoMunicipio);
        selectComunidades.appendChild(optionBlancoComunidades);
    }

    const eliminarHijosConValor = (hijos) => {
        const hijosArray = Array.from(hijos);
        console.log("Eliminar hijos:", hijosArray);
        let hay1Vacio = false;
        hijosArray.forEach(elemento => {
            if (hay1Vacio || elemento?.value !== "vacio") {
                elemento.remove();
            } else{
                hay1Vacio = true;
            }
        }
        )
    };

    const cargarOptions = (padre, json, id, nombre) => {
        console.log("cargarOptions: ", padre, json, id, nombre);
        //por si el usuario cambia de elemento en el padre, lo vacío.
        const opcionesAVaciar = padre.querySelectorAll("option");
        console.log("En CargarOptions, opcionesAVaciar: ", opcionesAVaciar);
        if (opcionesAVaciar) {
            eliminarHijosConValor(opcionesAVaciar);
        }

        for (let hijo of json) {
            let option = document.createElement("option");
            option.value = hijo[id] || "";
            option.innerText = hijo[nombre] || "";
            padre.appendChild(option);
        }
    }

    const cargarComunidades = () => {
        estadoInicial();
        const objeto = { tabla: "comunidades" };
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if ((this.readyState == 4) && (this.status == 200)) {
                let array = JSON.parse(this.responseText);
                cargarOptions(selectComunidades, array, "id_comunidad", "nombre");
            }
        }
        let parametros = JSON.stringify(objeto);
        xhttp.open("POST", "php/acceso_bd.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("objeto=" + parametros);
    }
    cargarComunidades();


    /*
    Al seleccionar en el select id="comunidades" una opción, cuando detecte un cambio, deberá mostrar las provincias. 
    Es decir, mostrar el select id="provincias" y cargar las provincias de dicha comunidad autónoma seleccionada de la BD.
    */
    const cargarProvincias = (e) => {
        estadoInicial();
        const comunidad = e.target.value;
        console.log("En cargarProvincias, comunidad elegida:", comunidad);
        if (comunidad != "vacio") {
            //muestro el siguiente label
            selectProvincias.style.visibility = "visible";
            labelProvincias.style.visibility = "visible";
            //carga de datos
            const objeto = { tabla: "provincias" };
            let parametros = JSON.stringify(objeto);
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if ((this.readyState == 4) && (this.status == 200)) {
                    let array = JSON.parse(this.responseText);
                    let arraySeleccionadas = [];
                    for (let provincia of array) {
                        if (provincia.id_comunidades == comunidad) {
                            console.log("añadir provincia:", provincia);
                            arraySeleccionadas.push(provincia);
                        }
                    }
                    cargarOptions(selectProvincias, arraySeleccionadas, "id_provincia", "provincia");
                }
            }
            xhttp.open("POST", "php/acceso_bd.php", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.send("objeto=" + parametros);
        } else {
            location.reload(); //si se selecciona el elemento vacío se recarga la página para que todo vuelva el estado inicial
        }
    }
    selectComunidades.addEventListener("change", cargarProvincias, false);



    /*    
    Al seleccionar en el select id="provincias" una opción, cuando detecte un cambio, deberá mostrar los municipios. 
    Es decir, mostrar el select id="municipios" y cargar los municipios de dicha provincia seleccionada de la BD
    */
    const cargarMunicipios = (e) => {
        const provincia = e.target.value;
        console.log(provincia);
        if (provincia != "vacio"){
            //muestro el siguiente label
            selectMunicipios.style.visibility = "visible";
            labelMunicipios.style.visibility = "visible";
            //carga de datos
            const objeto = { tabla: "municipios" };
            let parametros = JSON.stringify(objeto);
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if ((this.readyState == 4) && (this.status == 200)) {
                    let array = JSON.parse(this.responseText);
                    let arraySeleccionadas = [];
                    for (let municipio of array) {
                        if (municipio.id_provincia == provincia) {
                            arraySeleccionadas.push(municipio);
                        }
                    }
                    cargarOptions(selectMunicipios, arraySeleccionadas, "id_municipio", "nombre");
                }
            }
            xhttp.open("POST", "php/acceso_bd.php", true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.send("objeto=" + parametros);
        } else{
            selectMunicipios.style.visibility = "hidden";
            labelMunicipios.style.visibility = "hidden";
        }
    }

    selectProvincias.addEventListener("change", cargarMunicipios, false);

    /*
    Si después de estos pasos volvemos a elegir otra provincia, deberemos borrar todo lo que hay en el select id="municipios" y
         cargarlo con los municipios de la nueva provincia seleccionada.
    */

    //! ---hecho en la línea 112 de este documento al llamar a estadoInicial() 
    //! --dejar un solo elemento vacío dentro de Línea 58 eliminarHijosConValor
    //! --ocultar municipios en el else de la línea 177


    /*       
    Si por el contrario lo que queremos es cambiar la CCAA entonces tendremos que deshabilitar el select id="muncipios" 
    para que no se vea, y borrar los elementos que hay en el select id="provincias" y añadir las provincias de la nueva selección de CCAA.
    */
    //! ---hecho en la línea 90 de este documento al llamar a estadoInicial() y también dejar un solo elemento vacío dentro de Línea 58 eliminarHijosConValor
    //! -- y en línea 140 de este documento por si el usuario cambia por opcion vacía.

}

window.addEventListener("load", scriptJs, false); 