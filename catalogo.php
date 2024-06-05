<?php
session_start();

if (!isset($_SESSION['user']) && !isset($_COOKIE['user'])) {
    header("Location: index.php");
    exit();
}

// Cierre de sesión
if (isset($_GET['logout'])) {
    setcookie("user", "", time() - 3600, "/"); // Eliminar la cookie
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

echo "Hola bienvenido";
?>

<a href="catalogo.php?logout=true">Cerrar sesión</a>
