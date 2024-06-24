<?php
$estados = [
    "Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Chiapas", "Chihuahua",
    "Coahuila", "Colima", "Durango", "Guanajuato", "Guerrero", "Hidalgo", "Jalisco", "México",
    "Michoacán", "Morelos", "Nayarit", "Nuevo León", "Oaxaca", "Puebla", "Querétaro",
    "Quintana Roo", "San Luis Potosí", "Sinaloa", "Sonora", "Tabasco", "Tamaulipas", "Tlaxcala",
    "Veracruz", "Yucatán", "Zacatecas"
];

function generarNumeroVuelo($estado, $indice) {
    $hash = md5($estado . $indice);
    $numeroVuelo = substr(preg_replace('/[^0-9]/', '', $hash), 0, 10);
    return str_pad($numeroVuelo, 10, '0', STR_PAD_LEFT);
}

function generarFechaAleatoria() {
    $timestamp = mt_rand(strtotime('2024-06-15'), strtotime('2024-12-31'));
    return date('Y-m-d', $timestamp);
}

function generarClima() {
    $climas = [
        ["Soleado", "fa-sun"],
        ["Nublado", "fa-cloud"],
        ["Lluvia", "fa-cloud-rain"]
    ];
    return $climas[array_rand($climas)];
}
?>

<div class="state-container mt-4">
    <div class="row justify-content-center">
        <?php foreach ($estados as $index => $estado): ?>
            <?php if ($index % 6 == 0 && $index != 0): ?>
                </div><div class="row justify-content-center">
            <?php endif; ?>
            <div class="col-md-2">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $estado; ?></h5>
                        <div id="carousel-<?php echo $index; ?>" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php for ($i = 0; $i < 3; $i++): ?>
                                    <?php $clima = generarClima(); ?>
                                    <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                                        <p class="card-text">Vuelo: <?php echo generarNumeroVuelo($estado, $i); ?></p>
                                        <p class="card-text">Próximos vuelos: <?php echo generarFechaAleatoria(); ?></p>
                                        <p class="card-text">Clima: <i class="fas <?php echo $clima[1]; ?>"></i> <?php echo $clima[0]; ?></p>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <button class="carousel-control-prev custom-carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $index; ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon custom-carousel-control-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next custom-carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $index; ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon custom-carousel-control-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <a href="#" class="btn btn-primary mt-3">Click aquí</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Font Awesome Script -->
<script src="blockSourceView.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-OGkU24BYhHb4/38r4K3FRWfoL99a3PT0V3l3mVuB1TkjO+ABHPvRXh+K+5VkGfN6YxWzGGBj1/SOqBj4o1L05w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
