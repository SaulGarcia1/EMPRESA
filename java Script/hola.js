document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío del formulario por defecto

        // Validaciones adicionales si es necesario
        const phone = document.getElementById('phone').value;
        const phonePattern = /^[0-9]{10}$/; // Ejemplo para un teléfono de 10 dígitos
        if (!phonePattern.test(phone)) {
            displayMessage('Por favor, introduce un número de teléfono válido.', 'error');
            return;
        }

        // Si todo es válido, enviar el formulario
        const formData = new FormData(form);
        fetch('send_mail.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                displayMessage('Mensaje enviado con éxito.', 'success');
                form.reset(); // Resetear el formulario
            } else {
                displayMessage('Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo.', 'error');
            }
        })
        .catch(error => {
            displayMessage('Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo.', 'error');
        });
    });

    function displayMessage(message, type) {
        formMessage.textContent = message;
        formMessage.className = `form-message ${type}`;
        formMessage.style.display = 'block';
    }
});
