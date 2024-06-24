<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
} elseif (isset($_COOKIE['user'])) {
    $email = $_COOKIE['user'];
} else {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

// Incluir la conexión a la base de datos
require_once "conexionDB.php";

// Consulta a la base de datos para obtener los registros del usuario
$sql = "SELECT * FROM RegistroClientes WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style LG.css">
    <script src="borrarAlerta.js"></script>
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--DataTable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap.min.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--SweetAlert2-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">
    <title>DataTable</title>
</head>
<body class="bg-dark">
    <div class="container my-4">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h2 class="text-center text-white">Datos Registrados</h2>
                <button onclick="agregar()" class="btn btn-sn btn-success mb-2"><i class="fa-solid fa-user-plus"></i></button>
                <table class="table text-center">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">No. Vuelo</th>
                            <th scope="col">Origen</th>
                            <th scope="col">Destino</th>
                            <th scope="col">Día de salida</th>
                            <th scope="col">Día de llegada</th>
                            <th scope="col">Equipaje</th>
                            <th scope="col">Clase</th>
                            <th scope="col">No. Ticket</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='text-white'>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td>" . $row['apellido'] . "</td>";
                            echo "<td>" . $row['ciudad'] . "</td>";
                            echo "<td>" . $row['numero_vuelo'] . "</td>";
                            echo "<td>" . $row['origen'] . "</td>";
                            echo "<td>" . $row['destino'] . "</td>";
                            echo "<td>" . $row['dia_salida'] . "</td>";
                            echo "<td>" . $row['dia_llegada'] . "</td>";
                            echo "<td>" . $row['equipaje'] . "</td>";
                            echo "<td>" . $row['clase'] . "</td>";
                            echo "<td>" . $row['numero_ticket'] . "</td>";
                            echo "<td><button class='btn btn-danger' onclick='eliminarRegistro(" . $row['id'] . ")'>Eliminar</button></td>";
                            echo "</tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <button onclick="window.location.href='bienvenida.php'" class="btn btn-sn text-white btn-secondary">Regresar</button>
        <button onclick="window.location.href='dataTable.php'" class="btn btn-sn text-white btn-secondary">Editar</button>
    </div>

    <!--BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--DataTable-->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap.min.js"></script>
    <!--SweetAlert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    
    <script>
    function eliminarRegistro(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
            $.ajax({
                type: "POST",
                url: "eliminarRegistro.php",
                data: { id: id },
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        }
    }
    </script>
    <script src="blockSourceView.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
