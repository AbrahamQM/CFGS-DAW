const codigo = () =>{
    /*a)Inicialmente tienen que estar todos los elementos de la web ocultos, 
    salvo el primer select name="provincias" id="provincias", para ello puedes usar 
    style.visibility = "hidden" en cada elemento.*/
    
    const labels = document.getElementsByTagName("label");
    for (let i = 1; i < labels.length; i++) {
        labels[i].style.visibility = "hidden"; //oculto el resto de labels que no me interesan
    }

    const islas = document.getElementById("islas");
    islas.style.visibility = "hidden";

    const listas = document.getElementsByTagName("ul");
    // Oculto todos los <ul>
    const ocultarListas = () => {
        for (const lista of listas) {
            lista.style.visibility = "hidden";
        }
    }

    ocultarListas();

    /*
    b) Función mostrar islas: Cuando se seleccione una opción en el primer select name="provincias" id="provincias", 
    es decir, se detecte un cambio con el evento change, hacemos visible el segundo 
    select name="islas" id="islas", dejando ver solo las islas agrupadas por la provincia que 
    se ha elegido previamente. Las otras islas se ocultarán sin dejar el espacio en blanco que 
    ocupan en el select. display = "none".
    */
    
   
   const mostrarIslas = (e) => {
       const provincia = e.target.value;
       const gruposDeIslas = document.getElementsByTagName("optgroup");
        console.log("mostrarIslas:" , provincia);
        if (provincia !== " "){
            // por si el usuario cambia de provincia después de seleccionar una isla
            ocultarListas();//oculto todas las listas de pueblos de nuevo
            islas.selectedIndex = 0; // reinicio el select de islas
            
            labels[1].style.visibility = "visible"; //muestro la siguiente etiqueta y el select
            document.getElementById("islas").style.visibility = "visible"; 
            
            for(const grupo of gruposDeIslas){ //selecciono las islas que corresponden
                if(grupo.label === provincia){
                    grupo.style.visibility = "visible"; //hago visibles las que corresponden
                    grupo.style.display = "block"; //por si el usuario ha cambiado de provincia
                } else {
                    grupo.style.display = "none"; //evito que ocupen el espacio
                }
            }
        }else{ //garantizo que en caso de seleccionar de nuevo el elemento vacío se recarga la página
            location.reload();
        }
        
    }
    
    document.getElementById("provincias").addEventListener("change", mostrarIslas, false);


    /*
    c) Función seleccionar isla: Cuando se seleccione una opción en el segundo select name="islas" id="islas", 
    es decir, se detecte un cambio con el evento change, hacemos visible los 3 pueblos de esa Isla y los 
    posicionamos al lado del select en lugar de verlos en el lugar que ocuparía dentro del html. A cada uno de 
    esos 3 pueblos debemos añadirle un addEventListener()

    */
    const seleccionarIsla = (e) =>{
        const isla = e.target.value;
        const pueblos = document.getElementById(isla);
        ocultarListas();//oculto todas las listas de pueblos por si el usuario cambia de isla
        if (isla !== " "){
            labels[2].style.visibility = "visible"; //hago visible el contenedor_img
            const rutaImagen = `/islas/${isla}.png`; 
            const imagen = document.createElement("img"); //creo la imagen y le seteo los atributos
            imagen.src = rutaImagen;
            imagen.alt = `Imagen ${isla}`;
            imagen.style = "width: 100px; height: 100px;"
            labels[2].appendChild(imagen); //añado al contenedor la imagen
            labels[2].appendChild(pueblos); //añado al contenedor el listado
            labels[2].style.display = "flex-line";
            pueblos.style.visibility = "visible"; //TODO quitar
            pueblos.style.display = "block"; // Cambiado a display: block para mostrar el listado
            pueblos.style.position = "inline"; // Aseguro que el <ul> no afecte a su posición en el documento
            // labels[1].appendChild(pueblos);
            // pueblos.style.display = "block";
            // labels[1].classList.add('inline-block');
        }else{
            ocultarListas();
        }
    }
    document.getElementById("islas").addEventListener("change", seleccionarIsla, false);

/*
    d) Función elegir pueblo: Al pinchar encima del texto de uno de los pueblos anteriormente mostrados, 
    debemos cambiar el color del texto a rojo y de los no seleccionados a azul. Deberá mostrar la imagen de la Isla, 
    llamamos a la siguiente función.

    e) Función mostrar imagen isla: Para ello debemos crear un elemento nuevo document.createElement de una imagen, 
    le fijaremos los atributos src y alt con setAttribute y la añadiremos al contenedor id="contenedor_imag" que se 
    encuentra en el fichero.html. Le daremos un tamaño adecuado a la imagen y su posición. Y mostraremos un texto que 
    hemos ido almacenando durante la ejecución de la práctica en un variable, con la siguiente información "Has elegido 
    pueblo_elegido es un municipio de la isla de isla>", esta información actualizará la información del id=parrafo
    haciendo uso de document.innerHTML. Cambiaremos su posición desde JavaScript para que en lugar de ocupar la que 
    ocupa en el HTML esté debajo de la imagen y la lista de los 3 pueblos, y su color a verde.
*/
}
window.onload = codigo;
