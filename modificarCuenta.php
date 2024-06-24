<?php
session_start();
require_once "conexionDB.php";

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Obtener el correo del usuario logueado
$correo = $_SESSION['user'];

// Obtener los datos actuales del usuario
$sql = "SELECT nombre, apellido_materno, apellido_paterno, correo FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

// Verificar si se envió el formulario de modificación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido_materno = $_POST['apellido_materno'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $correo_nuevo = $_POST['correo'];
    $correo_confirmar = $_POST['correo_confirmar'];
    $password = $_POST['password'];
    $password_confirmar = $_POST['password_confirmar'];

    // Validar que el correo y la contraseña coincidan
    if ($correo_nuevo !== $correo_confirmar) {
        echo "<script>alert('Los correos electrónicos no coinciden.'); window.location.href = 'modificarCuenta.php';</script>";
        exit();
    }

    if ($password !== $password_confirmar) {
        echo "<script>alert('Las contraseñas no coinciden.'); window.location.href = 'modificarCuenta.php';</script>";
        exit();
    }

    // Consulta para actualizar los datos del usuario
    $sql = "UPDATE usuarios SET nombre = ?, apellido_materno = ?, apellido_paterno = ?, correo = ?, password = ? WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido_materno, $apellido_paterno, $correo_nuevo, $password, $correo);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Actualizar la sesión con el nuevo correo
        $_SESSION['user'] = $correo_nuevo;
        echo "<script>alert('¡Datos actualizados correctamente!'); window.location.href = 'bienvenida.php';</script>";
        exit();
    } else {
        // Error al actualizar los datos
        echo "<script>alert('Error al actualizar los datos, intenta nuevamente.'); window.location.href = 'modificarCuenta.php';</script>";
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
    <title>Modificar Cuenta</title>
    <style>
        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-dark d-flex justify-content-center align-items-center min-vh-100">
    <form action="modificarCuenta.php" method="post" class="w-100" style="max-width: 400px;">
        <!-- Modificar Cuenta -->
        <div class="px-4 py-3">
            <h1 class="font-weight-bold mb-4 text-center">Modificar Cuenta</h1>
            <div class="mb-4">
                <label for="nombre" class="form-label font-weight-bold">Nombre(s)</label>
                <input type="text" name="nombre" required class="form-control bg-dark-x border-0" placeholder="Ingresa tu nombre" id="nombre" value="<?php echo $usuario['nombre']; ?>">
            </div>
            <div class="mb-4">
                <label for="apellido_paterno" class="form-label font-weight-bold">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" required class="form-control bg-dark-x border-0" placeholder="Ingresa tu apellido paterno" id="apellido_paterno" value="<?php echo $usuario['apellido_paterno']; ?>">
            </div>
            <div class="mb-4">
                <label for="apellido_materno" class="form-label font-weight-bold">Apellido Materno</label>
                <input type="text" name="apellido_materno" required class="form-control bg-dark-x border-0" placeholder="Ingresa tu apellido materno" id="apellido_materno" value="<?php echo $usuario['apellido_materno']; ?>">
            </div>
            <div class="mb-4">
                <label for="correo" class="form-label font-weight-bold">Correo</label>
                <input type="email" name="correo" required class="form-control bg-dark-x border-0" placeholder="Ingresa tu correo" id="correo" value="<?php echo $usuario['correo']; ?>">
            </div>
            <div class="mb-4">
                <label for="correo_confirmar" class="form-label font-weight-bold">Confirmar Correo</label>
                <input type="email" name="correo_confirmar" required class="form-control bg-dark-x border-0" placeholder="Confirma tu correo" id="correo_confirmar" value="<?php echo $usuario['correo']; ?>">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label font-weight-bold">Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password" required minlength="8" maxlength="16" class="form-control bg-dark-x border-0 mb-2" placeholder="Ingresa tu contraseña" id="password">
                    <span class="input-group-text bg-dark-x border-0 password-toggle" id="togglePassword1"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <div class="mb-4">
                <label for="password_confirmar" class="form-label font-weight-bold">Confirmar Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password_confirmar" required minlength="8" maxlength="16" class="form-control bg-dark-x border-0 mb-2" placeholder="Confirma tu contraseña" id="password_confirmar">
                    <span class="input-group-text bg-dark-x border-0 password-toggle" id="togglePassword2"><i class="fas fa-eye"></i></span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
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
</html>
