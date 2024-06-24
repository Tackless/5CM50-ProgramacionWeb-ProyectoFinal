<?php
require_once "conexionDB.php";
session_start();

// Verificar si el usuario ha iniciado sesión y obtener el correo electrónico
if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
} elseif (isset($_COOKIE['user'])) {
    $email = $_COOKIE['user'];
} else {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

// Obtener los datos del usuario desde la base de datos
$sql = "SELECT nombre, apellido_paterno, apellido_materno FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row['nombre'];
    $apellido_paterno = $row['apellido_paterno'];
    $apellido_materno = $row['apellido_materno'];
} else {
    echo "No se encontraron datos para el usuario.";
    exit();
}

$estados = [
    "Aguascalientes" => ["8282089778", "3385763470", "8854852124"],
    "Baja California" => ["1234567890", "0987654321", "1122334455"],
    "Baja California Sur" => ["2233445566", "6677889900", "9988776655"],
    "Campeche" => ["3344556677", "4455667788", "5566778899"],
    "Chiapas" => ["6677889901", "7788990011", "8899001122"],
    "Chihuahua" => ["9900112233", "0011223344", "1122334455"],
    "Ciudad de México" => ["2233445566", "3344556677", "4455667788"],
    "Coahuila" => ["5566778899", "6677889900", "7788990011"],
    "Colima" => ["8899001122", "9900112233", "0011223344"],
    "Durango" => ["1122334455", "2233445566", "3344556677"],
    "Guanajuato" => ["4455667788", "5566778899", "6677889900"],
    "Guerrero" => ["7788990011", "8899001122", "9900112233"],
    "Hidalgo" => ["0011223344", "1122334455", "2233445566"],
    "Jalisco" => ["3344556677", "4455667788", "5566778899"],
    "México" => ["6677889900", "7788990011", "8899001122"],
    "Michoacán" => ["9900112233", "0011223344", "1122334455"],
    "Morelos" => ["2233445566", "3344556677", "4455667788"],
    "Nayarit" => ["5566778899", "6677889900", "7788990011"],
    "Nuevo León" => ["8899001122", "9900112233", "0011223344"],
    "Oaxaca" => ["1122334455", "2233445566", "3344556677"],
    "Puebla" => ["4455667788", "5566778899", "6677889900"],
    "Querétaro" => ["7788990011", "8899001122", "9900112233"],
    "Quintana Roo" => ["0011223344", "1122334455", "2233445566"],
    "San Luis Potosí" => ["3344556677", "4455667788", "5566778899"],
    "Sinaloa" => ["6677889900", "7788990011", "8899001122"],
    "Sonora" => ["9900112233", "0011223344", "1122334455"],
    "Tabasco" => ["2233445566", "3344556677", "4455667788"],
    "Tamaulipas" => ["5566778899", "6677889900", "7788990011"],
    "Tlaxcala" => ["8899001122", "9900112233", "0011223344"],
    "Veracruz" => ["1122334455", "2233445566", "3344556677"],
    "Yucatán" => ["4455667788", "5566778899", "6677889900"],
    "Zacatecas" => ["7788990011", "8899001122", "9900112233"]
];

function generarClima() {
    $climas = [
        ["Soleado", "fa-sun"],
        ["Nublado", "fa-cloud"],
        ["Lluvia", "fa-cloud-rain"]
    ];
    return $climas[array_rand($climas)];
}

// En la sección donde manejas el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado los datos del formulario
    if (isset($_POST['nombre']) && isset($_POST['apellido_paterno']) && isset($_POST['apellido_materno']) && isset($_POST['numero_vuelo']) && isset($_POST['origen']) && isset($_POST['destino'])  && isset($_POST['correo']) && isset($_POST['dia_salida']) && isset($_POST['dia_llegada']) && isset($_POST['equipaje']) && isset($_POST['clase']) && isset($_POST['numero_ticket'])) {
        // Recibir los datos del formulario
        $nombre = $_POST['nombre'];
        $numero_vuelo = $_POST['numero_vuelo'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $dia_salida = $_POST['dia_salida'];
        $dia_llegada = $_POST['dia_llegada'];
        $equipaje = $_POST['equipaje'];
        $clase = $_POST['clase'];
        $numero_ticket = $_POST['numero_ticket'];
        $email = $_POST['correo'];

        // Imprimir los datos recibidos para verificar
        echo "Nombre: $nombre<br>";
        echo "Número de vuelo: $numero_vuelo<br>";
        echo "Apellido paterno: $apellido_paterno<br>";
        echo "Apellido materno: $apellido_materno<br>";
        echo "Origen: $origen<br>";
        echo "Destino: $destino<br>";
        echo "Correo: $email<br>";
        echo "Día de salida: $dia_salida<br>";
        echo "Día de llegada: $dia_llegada<br>";
        echo "Equipaje: $equipaje<br>";
        echo "Clase: $clase<br>";
        echo "Número de ticket: $numero_ticket<br>";

        // Resto del código para obtener y procesar los datos...

        // Preparar la consulta SQL para insertar los datos en la tabla RegistroClientes
        $sql = "INSERT INTO RegistroClientes (nombre, apellido_paterno, apellido_materno, numero_vuelo, origen, destino, dia_salida, dia_llegada, equipaje, clase, numero_ticket, correo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssss", $nombre, $apellido_paterno, $apellido_materno, $numero_vuelo, $origen, $destino, $dia_salida, $dia_llegada, $equipaje, $clase, $numero_ticket, $email);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error al registrar: " . $conn->error;
        }
    } else {
        echo "No se recibieron todos los datos del formulario.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style LG.css">
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--DataTable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap.min.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--SweetAlert2-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">
    <title>DataTable</title>
    <style>
        .text-black {
            color: black;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <script>
        function actualizarVuelos() {
            const destinos = <?php echo json_encode($estados); ?>;
            const destinoSeleccionado = document.querySelector('select[name="destino"]').value;
            const vuelosDisponibles = destinos[destinoSeleccionado] || [];
            
            const vuelosSelect = document.getElementById('vuelos');
            vuelosSelect.innerHTML = '<option value="">Selecciona un número de vuelo</option>';
            vuelosDisponibles.forEach(function(vuelo) {
                const option = document.createElement('option');
                option.value = vuelo;
                option.textContent = vuelo;
                vuelosSelect.appendChild(option);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const diaSalidaInput = document.querySelector('input[name="dia_salida"]');
            const diaLlegadaInput = document.querySelector('input[name="dia_llegada"]');
            
            diaLlegadaInput.disabled = true;
            
            diaSalidaInput.addEventListener('change', function() {
                const diaSalida = new Date(diaSalidaInput.value);
                diaLlegadaInput.disabled = false;
                diaLlegadaInput.min = diaSalidaInput.value;
            });
            
            diaLlegadaInput.addEventListener('change', function() {
                const diaSalida = new Date(diaSalidaInput.value);
                const diaLlegada = new Date(diaLlegadaInput.value);
                if (diaLlegada < diaSalida) {
                    alert("La fecha de llegada no puede ser anterior a la fecha de salida.");
                    diaLlegadaInput.value = "";
                }
            });

            document.querySelector('select[name="numero_vuelo"]').addEventListener('change', function() {
                const vueloSeleccionado = this.value;
                if (vueloSeleccionado) {
                    const contenedorVuelo = document.getElementById('contenedor-vuelo');
                    contenedorVuelo.innerHTML = `
                        <div class="col-12">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Vuelo Seleccionado: ${vueloSeleccionado}</h5>
                                </div>
                            </div>
                        </div>
                    `;
                }
            });

            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const button = document.activeElement;
                if (button.name === 'guardar_continuar') {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '¿Deseas guardar y continuar?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, guardar y continuar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                } else if (button.classList.contains('btn-primary')) {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '¿Deseas guardar los cambios?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, guardar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                } else if (button.classList.contains('btn-danger')) {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '¿Deseas cancelar la operación?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'pagina_inicial.php'; // Cambia 'pagina_inicial.php' por la URL de la página a la que deseas redirigir.
                        }
                    });
                }
            });
        });
    </script>
</head>
<body class="bg-dark">
    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center text-white">Registro</h2>
                <!-- Formulario para ingresar los datos -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="row">
        <!-- Información Personal -->
        <div class="col-lg-4 mb-4">
            <!-- Información personal -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Información Personal
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($nombre); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" class="form-control" value="<?php echo htmlspecialchars($apellido_paterno); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Apellido Materno</label>
                        <input type="text" name="apellido_materno" class="form-control" value="<?php echo htmlspecialchars($apellido_materno); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Correo Electrónico</label>
                        <input type="email" name="correo" class="form-control" value="<?php echo htmlspecialchars($email); ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
        <!-- Registrar Vuelo -->
        <div class="col-lg-8 mb-4">
            <!-- Información del vuelo -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    Registrar Vuelo
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Origen</label>
                        <input type="text" name="origen" class="form-control" value="CDMX" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Destino</label>
                        <select class="form-select" name="destino" onchange="actualizarVuelos()">
                            <option value="">Selecciona un destino</option>
                            <?php foreach ($estados as $estado => $vuelos): ?>
                                <option value="<?php echo htmlspecialchars($estado); ?>"><?php echo htmlspecialchars($estado); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Vuelos Disponibles</label>
                        <select class="form-select" id="vuelos" name="numero_vuelo">
                            <option value="">Selecciona un número de vuelo</option>
                            <!-- Las opciones se actualizarán mediante JavaScript -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Fecha de Salida</label>
                        <input type="date" name="dia_salida" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Fecha de Llegada</label>
                        <input type="date" name="dia_llegada" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Cantidad de piezas por equipaje</label>
                        <input type="number" name="equipaje" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Tipo de clase</label>
                        <select class="form-select" name="clase">
                            <option value="Económica">Económico</option>
                            <option value="VIP">Segunda Clase</option>
                            <option value="Platino">Primera Clase</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold text-black">Número de ticket</label>
                        <input type="text" name="numero_ticket" class="form-control" value="<?php echo mt_rand(1000000000,9999999999); ?>">
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin de Información del Vuelo -->
    </div>
    <!-- Botones de acción -->
    <div class="row">
        <div class="col-12 text-center">
            <button type="submit" name="guardar_continuar" class="btn btn-success mx-2"><i class="fa-solid fa-save"></i> Guardar y continuar</button>
          	<a href="bienvenida.php" class="btn btn-danger mx-2"><i class="fa-solid fa-times"></i>Cancelar</a>
            
        </div>
    </div>
</form>
            </div>
        </div>
    </div>
</body>
</html>
