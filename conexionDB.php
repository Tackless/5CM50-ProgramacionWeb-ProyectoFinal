<?php
// Datos de conexión a la base de datos
$servername = "db5015891118.hosting-data.io"; // Nombre de host
$port = "3306"; // Puerto
$username = "dbu3968109"; // Nombre de usuario de la base de datos
$password = "Hielober28"; // Contraseña de la base de datos
$dbname = "dbs12953936"; // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>