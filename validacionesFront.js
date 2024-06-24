document.addEventListener('keydown', function(event) {
    // Bloquear F12
    if (event.key === 'F12') {
        alert('¡Ja ja, buen intento, pero no puedes abrir las herramientas de desarrollador!');
        event.preventDefault();
    }

    // Bloquear Ctrl + Shift + I
    if (event.ctrlKey && event.shiftKey && event.key === 'I') {
        alert('¡Ja ja, buen intento, pero no puedes abrir las herramientas de desarrollador!');
        event.preventDefault();
    }

    // Bloquear Ctrl + Shift + J
    if (event.ctrlKey && event.shiftKey && event.key === 'J') {
        alert('¡Ja ja, buen intento, pero no puedes abrir la consola!');
        event.preventDefault();
    }

    // Bloquear Ctrl + U
    if (event.ctrlKey && event.key === 'u') {
        alert('¡Ja ja, buen intento, pero está bien validado!');
        event.preventDefault();
    }

    // Bloquear Ctrl + Shift + C (Element Inspector)
    if (event.ctrlKey && event.shiftKey && event.key === 'C') {
        alert('¡Ja ja, buen intento, pero no puedes inspeccionar los elementos!');
        event.preventDefault();
    }

    // Bloquear Ctrl + Shift + K (Console in Firefox)
    if (event.ctrlKey && event.shiftKey && event.key === 'K') {
        alert('¡Ja ja, buen intento, pero no puedes abrir la consola en Firefox!');
        event.preventDefault();
    }
});

// Bloquear el clic derecho
document.addEventListener('contextmenu', function(event) {
    event.preventDefault();
});

(function() {
    let devtools = false;
    let reloaded = false; // Bandera para controlar si la página ya se ha recargado
    const threshold = 160; // Umbral de tamaño para detectar herramientas de desarrollador abiertas

    function isMobile() {
        // Simple check for mobile devices
        return /Mobi|Android/i.test(navigator.userAgent);
    }

    function detectDevTools() {
        if (isMobile()) {
            return; // No ejecutar en dispositivos móviles
        }

        const widthThreshold = window.outerWidth - window.innerWidth > threshold;
        const heightThreshold = window.outerHeight - window.innerHeight > threshold;

        if (widthThreshold || heightThreshold) {
            if (!devtools) {
                devtools = true;
                document.body.innerHTML = '<h1 style="text-align: center; margin-top: 20%;">No es posible ver el código</h1>';
                alert('¡Las herramientas de desarrollador están abiertas!');
                
                if (!reloaded) {
                    reloaded = true;
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 1000); // Recargar después de 1 segundo para dar tiempo a mostrar el mensaje
                }
            }
        } else {
            devtools = false;
        }
    }

    setInterval(detectDevTools, 1000);
})();
