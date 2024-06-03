<?php
require_once "conexionDB.php";
session_start();

if (isset($_SESSION['user']) || isset($_COOKIE['user'])) {
    header("Location: catalogo.php");
    exit();
}

// Obtener los datos del formulario
$correo = $_POST['correo'];
$password = $_POST['password'];
$rememberme = isset($_POST['rememberme']);

// Consulta para verificar las credenciales
$sql = "SELECT * FROM usuarios WHERE correo = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $correo, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Las credenciales son correctas
    if ($rememberme) {
        // Crear una cookie que expire en 5 minutos
        setcookie("user", $correo, time() + (5 * 60), "/");
    } else {
        // Iniciar una sesión normal
        $_SESSION['user'] = $correo;
    }
    header("Location: catalogo.php");
    exit();
} else {
    // Las credenciales son incorrectas, mostrar un mensaje de error
    echo "Correo o contraseña incorrectos";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
