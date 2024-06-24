<?php
// Incluir el archivo de conexión a la base de datos
require_once "conexionDB.php";
require_once 'auth.php';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $correo_confirmar = $_POST['correo_confirmar'];
    $password = $_POST['password'];
    $password_confirmar = $_POST['password_confirmar'];
    $nombre = $_POST['nombre'];
    $apellido_materno = $_POST['apellido_materno'];
    $apellido_paterno = $_POST['apellido_paterno'];

    // Validar que el correo y la contraseña coincidan
    if ($correo !== $correo_confirmar) {
        echo "<script>alert('Los correos electrónicos no coinciden.'); window.location.href = 'registro.php';</script>";
        exit();
    }

    if ($password !== $password_confirmar) {
        echo "<script>alert('Las contraseñas no coinciden.'); window.location.href = 'registro.php';</script>";
        exit();
    }

    // Consulta para insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (correo, password, nombre, apellido_materno, apellido_paterno) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $correo, $password, $nombre, $apellido_materno, $apellido_paterno);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Usuario registrado correctamente
        echo "<script>alert('¡Usuario registrado correctamente!'); window.location.href = 'index.php';</script>";
        exit();
    } else {
        // Error al registrar el usuario
        echo "<script>alert('Error al registrar el usuario, intenta nuevamente.'); window.location.href = 'registro.php';</script>";
        exit();
    }

    // Cerrar la consulta preparada
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="ccs/style LG.css">
    <title>Registro de Usuario</title>
    <style>
        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-dark d-flex justify-content-center align-items-center min-vh-100">
    <form action="registro.php" method="post" class="w-100" style="max-width: 400px;">
        <!--Inicia Registro-->
        <div class="px-4 py-3">
            <div class="text-center mb-4">
                <img src="logo.png" class="img-fluid" alt="Logo">
            </div>
            <h1 class="font-weight-bold mb-4 text-center">Registrarse</h1>
            <div class="mb-4">
                <label for="nombre" class="form-label font-weight-bold">Nombre(s)</label>
                <input type="text" name="nombre" required class="form-control bg-dark-x border-0" placeholder="Ingresa tu nombre" id="nombre">
            </div>
            <div class="mb-4">
                <label for="apellido_paterno" class="form-label font-weight-bold">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" required class="form-control bg-dark-x border-0" placeholder="Ingresa tu apellido paterno" id="apellido_paterno">
            </div>
            <div class="mb-4">
                <label for="apellido_materno" class="form-label font-weight-bold">Apellido Materno</label>
                <input type="text" name="apellido_materno" required class="form-control bg-dark-x border-0" placeholder="Ingresa tu apellido materno" id="apellido_materno">
            </div>
            <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label font-weight-bold">Correo</label>
                <input type="email" name="correo" required class="form-control bg-dark-x border-0" placeholder="Ingresa tu correo" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-4">
                <label for="exampleInputEmail1Confirm" class="form-label font-weight-bold">Confirmar Correo</label>
                <input type="email" name="correo_confirmar" required class="form-control bg-dark-x border-0" placeholder="Confirma tu correo" id="exampleInputEmail1Confirm" aria-describedby="emailHelp">
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label font-weight-bold">Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password" required minlength="8" maxlength="16" class="form-control bg-dark-x border-0 mb-2" placeholder="Ingresa tu contraseña" id="exampleInputPassword1">
                    <span class="input-group-text bg-dark-x border-0 password-toggle" id="togglePassword1"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1Confirm" class="form-label font-weight-bold">Confirmar Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password_confirmar" required minlength="8" maxlength="16" class="form-control bg-dark-x border-0 mb-2" placeholder="Confirma tu contraseña" id="exampleInputPassword1Confirm">
                    <span class="input-group-text bg-dark-x border-0 password-toggle" id="togglePassword2"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </div>
    </form>
</body>
<script>
    document.querySelectorAll('.password-toggle').forEach(item => {
        item.addEventListener('click', event => {
            const input = item.previousElementSibling;
            const icon = item.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
<script src="blockSourceView.js"></script>
</html>
