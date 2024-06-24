<?php
require_once "conexionDB.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Preparar la consulta de eliminación
    $sql = "DELETE FROM RegistroClientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Registro eliminado exitosamente.";
    } else {
        echo "Error al eliminar el registro.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No se proporcionó el ID del registro.";
}
?>
