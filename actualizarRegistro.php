<?php
require_once "conexionDB.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $dia_llegada = $_POST['dia_llegada'];
    $equipaje = $_POST['equipaje'];
    $clase = $_POST['clase'];

    $sql = "UPDATE RegistroClientes SET dia_llegada = ?, equipaje = ?, clase = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $dia_llegada, $equipaje, $clase, $id);

    if ($stmt->execute()) {
        echo "Registro actualizado exitosamente";
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
