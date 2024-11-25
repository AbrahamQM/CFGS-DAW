//Declaro las variables que me interesan como globales para poder usarlas en todo el código
let selectMarca;
let selectModelo;
let etiqModelo;
let idMarca;
let idModelo;
//Select paralos datos de las opciones y su etiqueta que tendré que crear
let selectOpciones;
let etiqOpciones;

//Método principal 
const inicio = () => {
    //selecciono los elementos
    selectMarca = document.getElementById("marcas");
    selectModelo = document.getElementById('modelo');
    etiqModelo = document.getElementById('etiq_modelo');
    //oculto etiquetas y selects
    selectModelo.style.visibility = 'hidden';
    etiqModelo.style.visibility = 'hidden';
    //cargo los datos de marcas
    cargarMarcas();
    //listener para cuando cambie la marca:
    selectMarca.addEventListener("change", cargarModelos, false);
    //listener para cuando cambie el modelo
    selectModelo.addEventListener("change", cargarOpciones, false);
}

//Método encargado de cargar todas las marcas
const cargarMarcas = () => {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if ((this.readyState === 4) && (this.status === 200)) {
            const respuesta = JSON.parse(this.responseText);
            crearOptions(selectMarca, respuesta, 'id_marca', 'nombre');
        }
    }
    const parametros = JSON.stringify({ tabla: "marcas" });
    xhttp.open('POST', "php/acceso_bd.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send('objeto=' + parametros);
}

//método que según la opción de marca carga los modelos
const cargarModelos = (e) => {
    //Solo para el caso de que se haya seleccionado un modelo anteriormente
    if (selectOpciones && etiqOpciones) {
        selectOpciones.style.visibility = 'hidden';
        etiqOpciones.style.visibility = 'hidden';
    }

    //obtengo el valor seleccionado:
    idMarca = e.target.value;
    //compruebo si tengo que eliminar hijos en cuyo caso los elimino
    const opcionesAVaciar = selectModelo.querySelectorAll("option");
    console.log("En cargarModelos, opcionesAVaciar: ", opcionesAVaciar);
    if (opcionesAVaciar.length > 0) {
        eliminarHijos(opcionesAVaciar);
    }

    if (idMarca !== "vacio") {
        //muestro la etiqueta modelo y su select añadiendo opcion vacía.
        etiqModelo.style.visibility = "visible";
        selectModelo.style.visibility = "visible";
        //petición de datos
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if ((this.readyState === 4) && (this.status === 200)) {
                const respuesta = JSON.parse(this.responseText);
                //selecciono los modelos de la marca
                let arraySeleccionadas = [];
                for (let modelo of respuesta) {
                    if (modelo.id_marca == idMarca) {
                        arraySeleccionadas.push(modelo);
                    }
                }
                crearOptions(selectModelo, arraySeleccionadas, 'id_modelo', 'modelo');
            }
        }
        const parametros = JSON.stringify({ tabla: "modelo" });
        xhttp.open('POST', "php/acceso_bd.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send('objeto=' + parametros);
    } else { // en caso de seleccionar el campo vacío, me aseguro que se oculte los demás elementos
        selectModelo.style.visibility = 'hidden';
        etiqModelo.style.visibility = 'hidden';
    }
}

const cargarOpciones = (e) => {
    console.log("cargarOpciones, EVENT: ", e);
    idModelo = e.target.value;
    console.log("cargarOpciones, modelo: " + idModelo);

    if (idModelo !== "vacio") {
        if (selectOpciones) {//si ya lo he creado lo vacío
            const opcionesAVaciar = selectOpciones.querySelectorAll("option");
            console.log("En CargarOptions, opcionesAVaciar: ", opcionesAVaciar);
            if (opcionesAVaciar.length > 0) {
                eliminarHijos(opcionesAVaciar);
            }
            //por si ha seleccionado el option vacío anteriormente, los hago visible
            etiqOpciones.style.visibility = 'visible';
            selectOpciones.style.visibility = 'visible';
        } else {//si no lo he creado, lo creo con etiqueta y añado al body
            etiqOpciones = document.createElement('label');
            etiqOpciones.id = "etiq_opciones";
            etiqOpciones.for = "opciones";
            etiqOpciones.textContent = "Opciones disponibles:"

            selectOpciones = document.createElement('select');
            selectOpciones.id = "opciones";

            document.body.appendChild(etiqOpciones);
            document.body.appendChild(selectOpciones);
        }

        //Obtengo los datos y cargo las opciones
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if ((this.readyState === 4) && (this.status === 200)) {
                const respuesta = JSON.parse(this.responseText);
                console.log(respuesta);
                console.log('idMarca: '+ idMarca + ' id modelo:' + idModelo);
                //selecciono los que corresponden
                let opcionesSeleccionadas = [];
                for (let opcion of respuesta) {
                    if ((opcion.id_marca === idMarca) && (opcion.id_modelo === idModelo)) {
                        opcionesSeleccionadas.push(opcion)
                    }
                }
                console.log("CARGAMOS OPCIONES", opcionesSeleccionadas);
                crearOptions(selectOpciones, opcionesSeleccionadas, 'cod_opcion', 'nombre');
            }
        }
        const parametros = JSON.stringify({ tabla: "opciones" });
        xhttp.open('POST', "php/acceso_bd.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send('objeto=' + parametros);

        //Por si selecciona el modelo vacío
    } else if (selectOpciones) {
        etiqOpciones.style.visibility = 'hidden';
        selectOpciones.style.visibility = 'hidden';
    }
}



//-------------------------------------Métodos auxiliares-----------------------------------------

// Método reutilizable para cargar options a un select, params:
// selectPadre: contenedor donde meter los options
// json: elementos en formato json a intertar
// id : nombre del campo id que usaré para setear id al option que creamos.
// nombreDato: nombre del atributo a mostrar
const crearOptions = (selectPadre, json, id, nombreDato) => {
    crearOptionVacio(selectPadre);
    for (let hijo of json) {
        let option = document.createElement("option");
        option.value = hijo[id] || "";
        option.innerText = hijo[nombreDato] || "";
        selectPadre.appendChild(option);
    }
    selectPadre.selectedIndex = 0;
}

//Crear elemento option vacío
const crearOptionVacio = (selectPadre) => {
    let option = document.createElement("option");
    option.value = "vacio";
    option.innerText = " ";
    selectPadre.appendChild(option);
}

//Método para eliminar los option en caso de cambio de seleccion del padre
const eliminarHijos = (hijos) => {
    //Obtengo los hijos en formato array para eliminarlos
    const hijosArray = Array.from(hijos);
    //elimino los hijos
    hijosArray.forEach(hijo => {
        hijo.remove();
    });
}


window.onload = inicio;