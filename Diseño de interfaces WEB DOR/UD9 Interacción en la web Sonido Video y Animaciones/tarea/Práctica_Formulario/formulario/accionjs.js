// script.js
document.getElementById('courseForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita el envío por defecto

    // Obtención de datos del formulario
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const experience = document.getElementById('experience').value;
    const preferences = document.getElementById('preferences').value;
    const schedule = document.querySelector('input[name="schedule"]:checked').value;

    // Validación simple
    if (!name || !email || !phone || !experience || !preferences || !schedule) {
        alert('Por favor, completa todos los campos antes de enviar.');
        return;
    }

    // Mostrar mensaje de éxito
    alert(`¡Gracias, ${name}! Hemos recibido tu inscripción. Nos pondremos en contacto contigo en ${email}.`);

    // Reiniciar el formulario
    event.target.reset();
});
