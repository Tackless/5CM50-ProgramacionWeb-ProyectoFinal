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
                            echo "<tr class='text-white' data-id='" . $row['id'] . "'>";
                            echo "<td>" . $i . "</td>";
                            echo "<td class='data-cell'>" . $row['nombre'] . "</td>";
                            echo "<td class='data-cell'>" . $row['apellido'] . "</td>";
                            echo "<td class='data-cell'>" . $row['ciudad'] . "</td>";
                            echo "<td class='data-cell'>" . $row['numero_vuelo'] . "</td>";
                            echo "<td class='data-cell'>" . $row['origen'] . "</td>";
                            echo "<td class='data-cell'>" . $row['destino'] . "</td>";
                            echo "<td class='data-cell'>" . $row['dia_salida'] . "</td>";
                            echo "<td class='data-cell'><input type='date' class='form-control form-control-sm' value='" . $row['dia_llegada'] . "' disabled></td>";
                            echo "<td class='data-cell'><input type='number' class='form-control form-control-sm' value='" . $row['equipaje'] . "' disabled></td>";
                            echo "<td class='data-cell'>
                                <select class='form-select form-select-sm' disabled>
                                    <option value='Economica' " . ($row['clase'] == 'Economica' ? 'selected' : '') . ">Economica</option>
                                    <option value='VIP' " . ($row['clase'] == 'VIP' ? 'selected' : '') . ">VIP</option>
                                    <option value='Platino' " . ($row['clase'] == 'Platino' ? 'selected' : '') . ">Platino</option>
                                </select>
                            </td>";
                            echo "<td class='data-cell'>" . $row['numero_ticket'] . "</td>";
                            echo "<td>
                                <button class='btn btn-sn btn-primary btn-edit' onclick='editar(this)'><i class='fa-solid fa-pen'></i></button>
                                <button class='btn btn-sn btn-secondary btn-eye' onclick='toggleVisibility(this)'><i class='fa-solid fa-eye'></i></button>
                                <button onclick='eliminarRegistro(" . $row['id'] . ")' class='btn btn-sn btn-danger btn-delete'><i class='fa-solid fa-trash-can'></i></button>
                            </td>";
                            echo "</tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <button onclick="window.location.href='bienvenida.php'" class="btn btn-sn text-white btn-secondary">Regresar</button>
        <button onclick="window.location.href='frontend/pantallaEditar.php'" class="btn btn-sn text-white btn-secondary">Editar</button>
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

    function toggleVisibility(button) {
        const icon = button.querySelector('i');
        const row = button.closest('tr');
        const dataCells = row.querySelectorAll('.data-cell');

        if (icon.classList.contains('fa-eye')) {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
            dataCells.forEach(cell => cell.style.display = 'none');
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
            dataCells.forEach(cell => cell.style.display = '');
        }
    }

    function editar(button) {
        const row = button.closest('tr');
        const inputs = row.querySelectorAll('input, select');
        const icon = button.querySelector('i');

        if (icon.classList.contains('fa-pen')) {
            inputs.forEach(input => input.disabled = false);
            icon.classList.remove('fa-pen');
            icon.classList.add('fa-save');
        } else {
            const id = row.dataset.id;
            const diaLlegada = row.querySelector('input[type="date"]').value;
            const equipaje = row.querySelector('input[type="number"]').value;
            const clase = row.querySelector('select').value;

            $.ajax({
                type: "POST",
                url: "actualizarRegistro.php",
                data: {
                    id: id,
                    dia_llegada: diaLlegada,
                    equipaje: equipaje,
                    clase: clase
                },
                success: function(response) {
                    alert(response);
                    inputs.forEach(input => input.disabled = true);
                    icon.classList.remove('fa-save');
                    icon.classList.add('fa-pen');
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
