document.addEventListener('DOMContentLoaded', function() {
    const button = document.createElement('button');
    const texto = 'No es el diseño mas bonito, peeeero....,\nTiene un poquito de todo, bootstrap, js, degradados, selectores de todo tipo, ...\nEspero que este te guste más'
    button.textContent = 'Despliega el mensaje';
    button.className = "btn btn-outline-warning";
    button.style.backgroundColor = '#A1D071';
    button.addEventListener('click', function() {
        alert(texto);
    });
    const divContainer = document.querySelector('.container');
    divContainer.appendChild(button);
});
