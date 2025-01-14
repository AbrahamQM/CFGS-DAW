document.addEventListener('DOMContentLoaded', function() {
    const button = document.createElement('button');
    button.textContent = 'Saludo Navideño';
    button.addEventListener('click', function() {
        alert('¡Feliz Navidad!');
    });
    document.body.appendChild(button);
});
