<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style LG.css">
    <title>Login</title>
</head>
<body class="bg-dark d-flex justify-content-center align-items-center min-vh-100">
    <form action="CredCorrectas.php" method="POST" class="w-100" style="max-width: 400px;">
        <!--Inica Login-->
        <div class="px-4 py-3">
            <div class="text-center mb-4">
                <img src="logo (1).png" class="img-fluid" alt="Logo">
            </div>
            <h1 class="font-weight-bold mb-4 text-center">Bienvenido</h1>
            <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label font-weight-bold">Correo</label>
                <input type="email" required class="form-control border-0" placeholder="Ingresa tu correo" id="user" aria-describedby="emailHelp">
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label font-weight-bold">Contraseña</label>
                <input type="password" required minlength="8" maxlength="16" class="form-control border-0 mb-2" placeholder="Ingresa tu contraseña" id="pass">
            </div>
            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Recordarme</label>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="enviar">Iniciar sesión</button>
        </div>
    </form>
</body>
</html>