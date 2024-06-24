<?php
require_once "conexionDB.php";

function validarEntrada($data) {
    return isset($data['nombre']) && isset($data['apellido']) && isset($data['ciudad']);
}

$response = array('success' => false, 'message' => 'Error desconocido');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (validarEntrada($_POST)) {
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $ciudad = trim($_POST['ciudad']);

        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
        if ($conexion->connect_error) {
            $response['message'] = 'Error de conexión: ' . $conexion->connect_error;
        } else {
            $stmt = $conexion->prepare("INSERT INTO RegistroClientes (nombre, apellido, ciudad) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nombre, $apellido, $ciudad);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Datos guardados correctamente.';
            } else {
                $response['message'] = 'Error al guardar los datos: ' . $stmt->error;
            }

            $stmt->close();
            $conexion->close();
        }
    } else {
        $response['message'] = 'Todos los campos son obligatorios.';
    }
} else {
    $response['message'] = 'Método de solicitud no válido.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
