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
        <!-- Aquí va el contenido del carrusel: imágenes, botones, indicadores, menú superior -->
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

        <!-- Botones -->
        <button class="carousel__button carousel__button--left">&#10094;</button>
        <button class="carousel__button carousel__button--right">&#10095;</button>

        <!-- Indicadores -->
        <div class="carousel__nav">
            <button class="carousel__indicator current-slide"></button>
            <button class="carousel__indicator"></button>
            <button class="carousel__indicator"></button>
        </div>

        <!-- Menú superior -->
        <div class="carousel__menu">
            <a href="#">TIPO DE VEHÍCULO</a>
            <a href="#">MARCA AUTOMOTRIZ</a>
            <a href="#">LÍNEA DE VEHÍCULO</a>
            <a href="#">AGENDA TU CITA</a>
        </div>
    </div>

    <!-- Título para la sección de ventas, ahora fuera del carrusel -->
    <h2 class="carousel__title">TÍTULO PARA SECCIÓN DE VENTAS</h2>
    <!-- secciones de carros en oferta y venta -->
    
</main>

        <!-- llamamos el script para el carrusel -->
            <script src="js/carousel.js"></script>

            <script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menu-toggle');
        const dropdown = document.querySelector('.header__dropdown');

        menuToggle.addEventListener('click', () => {
            console.log("click!");
            
            dropdown.classList.toggle('active');
        });
    });
            </script>
    <?php include 'php/include/footer.php'; ?>
</body>
</html>
