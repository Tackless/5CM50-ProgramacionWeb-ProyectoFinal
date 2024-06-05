    document.addEventListener('DOMContentLoaded', function() {
        var inputs = document.querySelectorAll('.form-control');

        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                if (input.value !== '') {
                    input.classList.add('filled');
                } else {
                    input.classList.remove('filled');
                }
            });

            input.addEventListener('blur', function() {
                if (input.value !== '') {
                    input.classList.add('filled');
                } else {
                    input.classList.remove('filled');
                }
            });

            // Si quieres aplicar el estilo al cargar la página si ya hay texto en el input
            if (input.value !== '') {
                input.classList.add('filled');
            }
        });
    });
