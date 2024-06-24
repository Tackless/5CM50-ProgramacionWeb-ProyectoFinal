<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link id="themeStylesheet" rel="stylesheet" href="style_LG.css">
    <title>Login</title>
    <style>
        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--light);
            color: var(--dark);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .theme-toggle img {
            width: 30px;
            height: 30px;
            filter: invert(1); /* Invertir los colores de la imagen */
        }
    </style>
</head>
<body class="bg-dark d-flex flex-column justify-content-center align-items-center min-vh-100">
    <div class="text-center mb-4">
        <img id="logo" src="LogoGif.gif" class="img-fluid logo-medium" alt="Logo">
    </div>
    <div class="container bg-semi-transparent rounded p-4 text-center">
        <form action="login.php" method="post" class="w-100" style="max-width: 300px; margin: auto;">
            <!--Inicia Login-->
            <div class="px-4 py-3">
                <h1 class="font-weight-bold mb-4 text-center welcome-text">
                    <span class="bien">Bien</span><span class="ven">ven</span><span class="ida">ida</span>
                </h1>
                <div class="mb-4">
                    <label for="exampleInputEmail1" class="form-label bold-text">Correo</label>
                    <input type="email" name="correo" required class="form-control bg-dark-x border-0" placeholder="Ingresa tu correo" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label bold-text">Contraseña</label>
                    <input type="password" name="password" required minlength="8" maxlength="16" class="form-control bg-dark-x border-0 mb-2" placeholder="Ingresa tu contraseña" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check text-start">
                    <input type="checkbox" name="rememberme" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label bold-text" for="exampleCheck1">Recordarme</label>
                </div>
                <div class="mb-4">
                    <p class="text-center mb-0 bold-text">¿No tienes una cuenta? <a href="registro.php">Registrarse</a></p>
                </div>
                <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
            </div>
        </form>
    </div>
    <div class="theme-toggle" id="themeToggle">
        <img id="themeIcon" src="sun.png" alt="Theme icon">
    </div>
    <script>
        document.getElementById('themeToggle').addEventListener('click', function() {
            const themeStylesheet = document.getElementById('themeStylesheet');
            const themeIcon = document.getElementById('themeIcon');
            if (themeStylesheet.getAttribute('href') === 'style_LG.css') {
                themeStylesheet.setAttribute('href', 'style_LG_Dark.css');
                themeIcon.src = 'moon.png';
            } else {
                themeStylesheet.setAttribute('href', 'style_LG.css');
                themeIcon.src = 'sun.png';
            }
        });
    </script>
    <script src="validacionesFront.js"></script>
</body>
</html>