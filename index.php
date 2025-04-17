<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'conexion.php';

// Obtener el id de la categoría seleccionada o usar null para que se muestren los más vendidos
$categoria_id = isset($_GET['categoria_id']) ? $_GET['categoria_id'] : null;

// Si no se selecciona categoría, mostrar los más vendidos
if ($categoria_id === null) {
    $query = "SELECT * FROM productos ORDER BY vendidos DESC LIMIT 5"; // Productos más vendidos
} else {
    $query = "SELECT * FROM productos WHERE categoria_id = :categoria_id";
}

$stmt = $pdo->prepare($query);

// Si se seleccionó una categoría, pasamos el id de la categoría a la consulta
if ($categoria_id !== null) {
    $stmt->execute(['categoria_id' => $categoria_id]);
} else {
    $stmt->execute();
}

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
        <!-- Carrusel -->
        <div class="carousel">
            <div class="carousel__menu">
                <?php
                // Consulta para obtener las categorías
                $categoriasQuery = "SELECT * FROM categorias";
                $categoriasStmt = $pdo->prepare($categoriasQuery);
                $categoriasStmt->execute();
                $categorias = $categoriasStmt->fetchAll(PDO::FETCH_ASSOC);

                // Mostrar las categorías con enlaces
                foreach ($categorias as $categoria):
                ?>
                    <a href="index.php?categoria_id=<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nombre']) ?></a>
                <?php endforeach; ?>
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

        <!-- Sección de carros más vendidos o filtrados por categoría -->
        <section class="vehiculos__seccion">
            <?php
            foreach($productos as $producto):
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
            <?php endforeach; ?>
        </section>

        <!-- Video publicitario -->
        <section class="video__seccion">
            <h2 class="video__titulo">Descubre Más Sobre Nuestra Tecnología</h2>
            <div class="video__contenedor">
                <video autoplay muted loop playsinline poster="img/preview.jpg">
                    <source src="img/video-anuncio.mp4" type="video/mp4">
                    Tu navegador no soporta la etiqueta de video.
                </video>
            </div>
        </section>

    </main>

    <!-- Script del carrusel -->
    <script src="js/carousel.js"></script>

    <?php include 'php/include/footer.php'; ?>
</body>
</html>
