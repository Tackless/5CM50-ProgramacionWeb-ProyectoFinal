<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
} elseif (isset($_COOKIE['user'])) {
    $email = $_COOKIE['user'];
} else {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz Principal</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <style>
        .custom-carousel-control-prev, .custom-carousel-control-next {
            width: 5%;
        }
        .custom-carousel-control-icon {
            background-color: black;
        }
        .header {
            background-color: #007bff;
            padding: 10px 0;
            color: white;
        }
        .header .logo {
            height: 50px;
        }
        .header .nav-link {
            color: white;
            margin-right: 20px;
        }
        .card.option-card {
            margin-bottom: 20px;
        }
        .state-container {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<header class="header d-flex justify-content-between align-items-center px-3">
    <div>
        <img src="logo.png" alt="Logo de la Compañía" class="logo">
    </div>
    <div>
        <a href="modificarCuenta.php" class="nav-link d-inline">Ver Cuenta</a>
        <a href="catalogo.php?logout=true" class="nav-link d-inline">Cerrar Sesión</a>
    </div>
</header>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="text-center mb-5">Bienvenido <?php echo $email; ?></h1>
        </div>
        <div class="col-md-4">
            <div class="card option-card">
                <div class="card-body text-center">
                    <h5 class="card-title">Registro de Reservación</h5>
                    <p class="card-text">Haz clic aquí para registrar una nueva reservación.</p>
                    <a href="/pantallaEditar.php" class="btn btn-primary"><i class="fas fa-edit me-1"></i>Registrar Reservación</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card option-card">
                <div class="card-body text-center">
                    <h5 class="card-title">Ver Datos Registrados</h5>
                    <p class="card-text">Haz clic aquí para ver los datos registrados.</p>
                    <a href="/pantallaVer.php" class="btn btn-primary"><i class="fas fa-eye me-1"></i>Ver Datos Registrados</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card option-card">
                <div class="card-body text-center">
                    <h5 class="card-title">Vuelos Reservados</h5>
                    <p class="card-text">Haz clic aquí para ver, modificar o eliminar vuelos reservados.</p>
                    <a href="/dataTable.php" class="btn btn-primary"><i class="fas fa-plane me-1"></i>Vuelos Reservados</a>
                </div>
            </div>
        </div>
    </div>
    <div class="state-container mt-4">
        <div class="row">
            <?php include 'contenedores_estados.php'; ?>
        </div>
    </div>
</div>
<script src="validaciones.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Font Awesome Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-OGkU24BYhHb4/38r4K3FRWfoL99a3PT0V3l3mVuB1TkjO+ABHPvRXh+K+5VkGf" crossorigin="anonymous"></script>
</body>
</html>
