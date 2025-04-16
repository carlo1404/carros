<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'conexion.php';
// Consulta para obtener los productos
$query = "SELECT * FROM productos";
$stmt = $pdo->prepare($query);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Solar Cars</title>
    <link rel="stylesheet" href="css/Normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <?php include 'php/include/header.php'; ?>

<main class="main__content">
    <div class="carousel">
        <div class="carousel__menu">
            <a href="#">TIPO DE VEHÍCULO</a>
            <a href="#">MARCA AUTOMOTRIZ</a>
            <a href="#">LÍNEA DE VEHÍCULO</a>
            <a href="#">AGENDA TU CITA</a>
        </div>

        <div class="carousel__track-container">
            <ul class="carousel__track">
                <li class="carousel__slide current-slide">
                    <img src="img/bmw_PNG99543.png" alt="Auto 1" class="carousel__image">
                </li>
                <li class="carousel__slide">
                    <img src="img/cadillac_PNG.png" alt="Auto 2" class="carousel__image">
                </li>
                <li class="carousel__slide">
                    <img src="img/chevrolet.png" alt="Auto 3" class="carousel__image">
                </li>
            </ul>
        </div>

        <button class="carousel__button carousel__button--left">&#10094;</button>
        <button class="carousel__button carousel__button--right">&#10095;</button>

        <div class="carousel__nav">
            <button class="carousel__indicator current-slide"></button>
            <button class="carousel__indicator"></button>
            <button class="carousel__indicator"></button>
        </div>
    </div>

    <!-- Título fuera del carrusel -->
    <h2 class="carousel__title">Autos más vendidos</h2>

    <!-- Sección de carros en oferta -->
<!-- Sección de carros en oferta -->
<section class="vehiculos__seccion">
<?php
$mitad = ceil(count($productos) / 2);
foreach($productos as $index => $producto):
?>
    <form action="php/agregar_carrito.php" method="POST" class="vehiculo__card">
        <div class="vehiculo__info">
            <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
            <p><strong>Precio sugerido desde</strong></p>
            <p>$ <?= number_format($producto['precio'], 0, ',', '.') ?></p>
            <p><?= htmlspecialchars($producto['descripcion']) ?></p>
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
            <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
            <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
            <div class="agregado__contenedor">
                <button type="submit" class="boton__comprar">
                    <img src="img/carrito-añadir.svg" alt="Comprar"> Agregar
                </button>
                <span class="mensaje-agregado"></span>
            </div>
        </div>
        <img class="vehiculo__imagen" src="img/<?= htmlspecialchars($producto['imagen']) ?>" alt="Vehículo">
    </form>

    <?php if ($index + 1 == $mitad): ?>
        <!-- Video publicitario en la mitad de las cards -->
        </section>
        <section class="video__seccion">
            <h2 class="video__titulo">Descubre Más Sobre Nuestra Tecnología</h2>
            <div class="video__contenedor">
                <video autoplay muted loop playsinline poster="img/preview.jpg">
                    <source src="img/video-anuncio.mp4" type="video/mp4">
                    Tu navegador no soporta la etiqueta de video.
                </video>
            </div>
        </section>
        <section class="vehiculos__seccion">
    <?php endif; ?>
<?php endforeach; ?>
</section>

</main>

<!-- Script del carrusel -->
<script src="js/carousel.js"></script>

<?php include 'php/include/footer.php'; ?>
</body>
</html>
