<?php
session_start();

if (isset($_COOKIE['user']) || isset($_SESSION['user'])) {
    header("Location: catalogo.php");
    exit();
}
?>
