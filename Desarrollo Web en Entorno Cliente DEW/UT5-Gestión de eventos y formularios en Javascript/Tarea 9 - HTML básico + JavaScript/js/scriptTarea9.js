//OJO, cuando cambio el estilo al de error, y luego hago focus, no se ve que el estilo ha cambiado porque se activa el campo.

const codigoJS = () => {

// Empiezo garantizando el foco en el primer campo de manera que el usuario no empiece a rellenar
    document.getElementById("nombre").focus();


/*
Almacenar en una cookie el número de intentos de envío del formulario que se van 
produciendo y mostrar un mensaje en el id="intentos" similar a: "Intento de Envíos del formulario: X". 
Es decir cada vez que le demos al botón de enviar tendrá que incrementar el valor de la cookie en 1 y 
mostrar su contenido en el id="intentos" del HTML.
*/ 
    // Función para leer el valor de las cookies por si hay varias
    const leerCookie = (nombre) => {
        const cookies = document.cookie.split("; ");
        for (let cookie of cookies) {
            const [key, value] = cookie.split("=");
            if (key === nombre) return parseInt(value);
        }
        return 0; // Si no existe, retornamos 0
    }

    // Inicializo la variable intentos con el valor de la cookie
    let intentos = leerCookie("intentos");
    //método
    const incrementarIntentos = (e) =>{
        e.preventDefault();
        intentos++;
        document.cookie = `intentos=${intentos}; path=/`;
        document.getElementById("intentos").innerText = `Intento de Envíos del formulario: ${intentos}`; 
    }
    
    document.getElementById("enviar").addEventListener("click", incrementarIntentos, false);

/*
Todos los campos del formulario son obligatorios rellenarlos para enviar el formulario. Una vez que los campos NOMBRE y APELLIDOS pierdan el foco, el contenido que se haya escrito en esos campos se convertirá en, la primera letra en mayúsculas y el resto en mínusculas.
*/
    const formulario = document.querySelector("form"); //obtengo el formulario
    const inputs = formulario.querySelectorAll("input"); //obtengo todos los inputs

    // Añado el atributo required a todos los inputs
    inputs.forEach(input => {
        input.setAttribute("required", true);
    });

    //funcion que devuelve el texto capitalizado
    const capitalizar = (texto) => {
        return texto.charAt(0).toUpperCase() + texto.slice(1); 
    }

    //añado los listener
    document.getElementById("nombre").addEventListener("blur", function(){
        this.value = capitalizar(this.value);
    }, false);
    document.getElementById("apellidos").addEventListener("blur", function(){
        this.value = capitalizar(this.value);
    }, false);


/*
Validar los campos de texto NOMBRE y APELLIDOS, 
NOMBRE pueden ser hasta 20 letras incluído espacio en blanco por si tiene un nombre compuesto. 
Y APELLIDO hasta 35 letras incluido en varias ocasiones espacio en blanco por si tiene un apellido compuesto. Si se produce algún error, mostrar el mensaje personalizado en el id="errores" del HTML, y poner el foco en el campo correspondiente. 
También se deberá poner el borde del campo en rojo para señalar dónde está el error. Para ello tienes en el archivo CSS una clase error ya implementada para tal finalidad.
*/
    const campoErrores = document.getElementById("errores");
    //validar el nombre
    const validarNombre = () =>{
        const input = document.getElementById("nombre");
        const nombre = input.value;
        //Compruebo que tenga 3 letras o más, y menos de 21 y que no contenga más de 1 espacio.
        let nombreCorrecto = (nombre.length > 2) && (nombre.length < 21) && (nombre.split(' ').length < 3);
        if (!nombreCorrecto){
            campoErrores.innerText = `Error en campo nombre`; 
            input.classList.add("error");
            input.focus(); 
        } else{
            campoErrores.innerText = null;
            input.classList.remove("error");
        } 
    } 

    //Validar los apellidos 
    const validatApellidos = () =>{
        const input = document.getElementById("apellidos");
        const apellidos = input.value;
        const separados = apellidos.split(' ');
        //Compruebo longitud, que tiene al menos un espacio (que son dos palabras o mas) y que tenga al menos 3 letras en cada apellido
        let apellidosCorrecto = (apellidos.length < 36) && (separados.length > 1) && (separados.every( apell => apell.length > 2)) ; 
        if (!apellidosCorrecto){
            campoErrores.innerText = 'Error en campo apellidos'; 
            input.classList.add("error");
            input.focus(); //OJO, al hacer focus, no se ve que el estilo ha cambiado porque se activa el campo. 
        } else{
            campoErrores.innerText = null;
            input.classList.remove("error");
        } 
    }

    //añado los listener 
    document.getElementById("nombre").addEventListener("blur", validarNombre, false);
    document.getElementById("apellidos").addEventListener("blur", validatApellidos, false);


/*
Validar la EDAD que contenga solamente valores numéricos y que esté en el rango de 18 a 105. Si se produce algún error, mostrar el mensaje personalizado en el id="errores" del HTML, y poner el foco en el campo correspondiente. También se deberá poner el borde del campo en rojo para señalar dónde está el error. Para ello tienes en el archivo CSS una clase error ya implementada para tal finalidad.
*/
    const validarEdad = () => {
        const input = document.getElementById("edad");
        const edad = input.value;
        //que sea número  > 17 y < 105
        let edadCorrecta =  !isNaN(edad) && (edad > 17) && (edad < 106);
        if(!edadCorrecta)  {
            campoErrores.innerText = 'Error en campo edad'; 
            input.classList.add("error");
            input.focus(); //OJO, al hacer focus, no se ve que el estilo ha cambiado porque se activa el campo. 
        } else{
            campoErrores.innerText = null;
            input.classList.remove("error");
        } 
    }

    document.getElementById("edad").addEventListener("blur", validarEdad, false);

/*
Validar el NIF. Utilizar una expresión regular que permita solamente 8 números un guión y una letra. Si se produce algún error, mostrar el mensaje personalizado en el id="errores" del HTML, y poner el foco en el campo correspondiente. También se deberá poner el borde del campo en rojo para señalar dónde está el error. Para ello tienes en el archivo CSS una clase error ya implementada para tal finalidad. No es necesario validar que la letra sea correcta. Explicar las partes de la expresión regular mediante comentarios.
*/
    const validarNIF = () => {
        const input = document.getElementById("nif");
        //EXPRESIÓN REGULAR: 8 dígitos + guión + 1 letra 
        const errorNIF = /^\d{8}-[a-zA-Z]$/.test(input.value);
        if(!errorNIF)  {
            campoErrores.innerText = 'Error en campo NIF debe tener formato 12345678-A'; 
            input.classList.add("error");
            input.focus(); //OJO, al hacer focus, no se ve que el estilo ha cambiado porque se activa el campo. 
        } else{
            campoErrores.innerText = null;
            input.classList.remove("error");
        } 
    }

    document.getElementById("nif").addEventListener("blur", validarNIF, false);



/*
Validar el E-MAIL. Si se produce algún error, mostrar el mensaje personalizado en el id="errores" del HTML, y poner el foco en el campo correspondiente. También se deberá poner el borde del campo en rojo para señalar dónde está el error. Para ello tienes en el archivo CSS una clase error ya implementada para tal finalidad.
*/
    const validarMail = () => {
        const input = document.getElementById("email");
        //que empiece con caracteres sin espacios ni @ + @ + caracteres sin espacios ni @ + . + 2 o 3caracteres sin espacios ni @
        const errorMail = /^[^\s@]+@[^\s@]+\.[a-z]{2,3}$/.test(input.value);
        if(!errorMail)  {
            campoErrores.innerText = 'Error en campo mail debe tener formato alguien@example.com'; 
            input.classList.add("error");
            input.focus(); //OJO, al hacer focus, no se ve que el estilo ha cambiado porque se activa el campo. 
        } else{
            campoErrores.innerText = null;
            input.classList.remove("error");
        } 
    }
    document.getElementById("email").addEventListener("blur", validarMail, false);


/*
Validar que se haya seleccionado alguna de las PROVINCIAS. Una vez se haya elegido una opción se habilitará la selección para Isla(por defecto la selección isla debe estar desactivada), dejando solo la elección de las islas de dicha provincia a elegir. Si se produce algún error, mostrar el mensaje personalizado en el id="errores" del HTML, y poner el foco en el campo correspondiente. También se deberá poner el borde del campo en rojo para señalar dónde está el error. Para ello tienes en el archivo CSS una clase error ya implementada para tal finalidad.
*/

    //desactivo el campo de la isla hasta que se seleccione una provincia
    const inputIsla = document.getElementById("isla");
    inputIsla.disabled = true;

    //método para mostrar solo las islas que corresponden a cada provincia
    const SC = ["LP", "LG", "TF", "EH"];
    const filtrarIslas = (provincia)=>{
        const selectIsla = document.getElementById("isla");
        if(provincia === "SC"){
            for(let opcion of selectIsla.options){
                opcion.style.display = SC.includes(opcion.value) ? "block" : "none";
            }
        } else {
            for(let opcion of selectIsla.options){
                opcion.style.display = SC.includes(opcion.value) ? "none" : "block";
            }
        }
    }

    const validarProvincia = () => {
        const input = document.getElementById("provincia");
        const errorProvincia = input.value === "";
        if(errorProvincia){
            campoErrores.innerText = 'Error, debe seleccionar provincia'; 
            input.classList.add("error");
            input.focus();
            inputIsla.disabled = true;
        }else{
            filtrarIslas(input.value);
            inputIsla.disabled = false;
            input.classList.remove("error");
            campoErrores.innerText = null;
        }
    }

    document.getElementById("provincia").addEventListener("change",validarProvincia, false);
    //para garantizarme que no salga sin seleccionar un elemento
    document.getElementById("provincia").addEventListener("blur",validarProvincia, false);
    
/*
Validar el campo FECHA DE NACIMIENTO debe coincidir la fecha con la edad que dijo previamente que tenía.Si se produce algún error, mostrar el mensaje personalizado en el id="errores" del HTML, y poner el foco en el campo correspondiente. También se deberá poner el borde del campo en rojo para señalar dónde está el error. Para ello tienes en el archivo CSS una clase error ya implementada para tal finalidad.
*/

    const coincideEdad = (fechaNacimiento) => {
        const hoy = new Date();
        const edadIndicada = parseInt(document.getElementById("edad").value);
        let edadFecha = hoy.getFullYear() - fechaNacimiento.getFullYear();
        const mesNacimiento = fechaNacimiento.getMonth();
        const diaNacimiento = fechaNacimiento.getDate();

        if (hoy.getMonth() < mesNacimiento || (hoy.getMonth() === mesNacimiento && hoy.getDate() < diaNacimiento)) {
            edadFecha--;
        }
        return edadFecha === edadIndicada;
    }

    const validarFecha = () => {
        const input = document.getElementById("fecha");
        const valor = input.value
        if( !/\d{2}\/\d{2}\/\d{4}/.test(valor)){
            campoErrores.innerText = 'Error, el formato de la Fecha Nacimiento debe ser: dd/mm/yyyy';
            input.focus();
        } else {
            const [dia, mes, anio] = valor.split('/').map(Number); //separo los valores
            const fecha = new Date(anio, mes - 1, dia); // mes - 1 porque los meses en Date empiezan desde 0
            //Compruebo que coincide con la edad
            if(!coincideEdad(fecha)){
                campoErrores.innerText = 'Error, la Fecha Nacimiento, no coincide con la edad indicada';
                input.classList.add("error");
                input.focus();
            }else{
                input.classList.remove("error");
                campoErrores.innerText = null;
            }
        }
    }
    document.getElementById("fecha").addEventListener("blur", validarFecha, false);

/*
Validar el campo TELEFONO, debe permitir 9 dígitos obligatorios y el primer dígito debe ser 6 o 9. Si se produce algún error, mostrar el mensaje personalizado en el id="errores" del HTML, y poner el foco en el campo correspondiente. También se deberá poner el borde del campo en rojo para señalar dónde está el error. Para ello tienes en el archivo CSS una clase error ya implementada para tal finalidad.
*/
    const validarTel = () => {
        const input = document.getElementById("telefono");
        const telefono = input.value;
        if ((telefono.startsWith('6') || telefono.startsWith('9')) && (telefono.length === 9)){
            input.classList.remove("error");
            campoErrores.innerText = null;
        } else{
            campoErrores.innerText = 'Error en campo teléfono';
            input.classList.add("error");
            input.focus();
        }
    }
    document.getElementById("telefono").addEventListener("blur", validarTel, false);

/*
Pedir confirmación de envío del formulario. Si se confirma el envío realizará el envío de los datos y modificará el valor de la cookie a 0; en otro caso cancelará el envío.
*/
    const relleno = () =>{
        for(let input of inputs){
            if(!input.value){// Si el input está vacío
                campoErrores.innerText = 'Error, rellene el formulario primero';
                return false; //salgo del método con false
            }
        }
        return true;//significa que están todos
    }

    const pedirConfirmacion = (e) => {
        //compruebo que todos los campos estén rellenos antes de pedir confirmación
        if(relleno()){
            e.preventDefault();
            const confirma = confirm("¿Desea enviar el formulario?");
            if(confirma){
                //elimino el primer listener
                document.getElementById("enviar").removeEventListener("click", incrementarIntentos);
                //cambio el valor de la cookie
                intentos = 0;
                document.cookie = `intentos=${intentos}; path=/`;
                //envío el formulario
                formulario.submit();
            }
        }//en caso contrario se usará el listener de la cookie con intentos
    }
    document.getElementById("enviar").addEventListener("click", pedirConfirmacion, true); 

}

window.onload = codigoJS;//me aseguro de que se ejecute el js despues de cargar la página