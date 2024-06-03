<?php
// Incluir el archivo de conexión a la base de datos
require_once "conexionDB.php";
require_once 'auth.php';

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Consulta para insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (correo, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $correo, $password);

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
</head>
<body class="bg-dark d-flex justify-content-center align-items-center min-vh-100">
    <form action="registro.php" method="post" class="w-100" style="max-width: 400px;">
        <!--Inicia Registro-->
        <div class="px-4 py-3">
            <div class="text-center mb-4">
                <img src="..." class="img-fluid" alt="Logo">
            </div>
            <h1 class="font-weight-bold mb-4 text-center">Registrarse</h1>
            <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label font-weight-bold">Correo</label>
                <input type="email" name="correo" required class="form-control bg-dark-x border-0" placeholder="Ingresa tu correo" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label font-weight-bold">Contraseña</label>
                <input type="password" name="password" required minlength="8" maxlength="16" class="form-control bg-dark-x border-0 mb-2" placeholder="Ingresa tu contraseña" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </div>
    </form>
</body>
<script src="js/input.js"></script>
</html>
