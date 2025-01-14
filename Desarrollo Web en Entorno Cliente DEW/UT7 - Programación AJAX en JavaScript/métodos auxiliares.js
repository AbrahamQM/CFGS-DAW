//-------------------------------------Métodos auxiliares-----------------------------------------

// Método reutilizable para cargar options a un select, params:
// selectPadre: contenedor donde meter los options
// json: elementos en formato json a insertar
// id : nombre del campo id que usaré para setear id al option que creamos.
// nombreDato: nombre del atributo a mostrar en el option
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

//-----------------------Ejemplos petición de datos y creacion de options
// eliminar hijos en caso de cambio de select anterior:
if (e.target.value !== "vacio") { //! cambiar e.target.value por la opcion que ha seleccionado
    const opcionesAVaciar = select_a_vaciar.querySelectorAll("option");
    if (opcionesAVaciar.length > 0) {
        eliminarHijos(opcionesAVaciar);
    }
    //cargar datos nuevos
} else {
    // ocultar hijos
    //!Ojo cambiar elementosSiguientes por los elementos a ocultar
    elementosSiguientes.style.visibility = 'visible'; //elementosSiguientes.style.visibility = ´hidden´; para mostrar
}

// petición de datos y creacion de options
const peticion = (nombreTabla) => {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if ((this.readyState === 4) && (this.status === 200)) {
            const respuesta = JSON.parse(this.responseText);
            //!En caso de necesitar seleccionar datos para los option a crear
            let arraySeleccionadas = [];
            for (let elemento of respuesta) {
                if (elemento.id === idFiltros) {
                    arraySeleccionadas.push(elemento);
                }
            }
            crearOptions(selectDondeIntroducir, arraySeleccionadas, 'id que tendrá el option', 'nombre del dato a mostrar');
        }
    }
    const parametros = JSON.stringify({ tabla: nombreTabla }); 
    xhttp.open('POST', "php/acceso_bd.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send('objeto=' + parametros);
}

//---------Extras------------

//---Poner al final para obligar a cargar la función después del documento:
window.onload = inicio;
//La función inicio debe contener todas las ejecuciones

//---Para insertar algo en el body
let parrafo = document.createElement("p");
parrafo.innerText = 'Esto es un parrafo';
parrafo.id = "idDelParrafo";
document.body.appendChild(parrafo);