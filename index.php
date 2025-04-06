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
    <section class="vehiculos__seccion">
    <div class="vehiculo__card">
        <div class="vehiculo__info">
            <h3>REFERENCIA VEHÍCULO</h3>
            <p><strong>Precio sugerido desde</strong></p>
            <p>$ 000.000.000</p>
            <p>Descripción Detallada</p>
            <button class="boton__comprar">
                <img src="img/shopping_cart_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Comprar"> Comprar
            </button>
        </div>
        <img class="vehiculo__imagen" src="img/bmw_PNG99543.png" alt="Vehículo">
    </div>

    <!-- Puedes duplicar esta tarjeta y cambiar imagen y texto -->
    <div class="vehiculo__card">
        <div class="vehiculo__info">
            <h3>REFERENCIA VEHÍCULO</h3>
            <p><strong>Precio sugerido desde</strong></p>
            <p>$ 000.000.000</p>
            <p>Descripción Detallada</p>
            <button class="boton__comprar">
                <img src="img/shopping_cart_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Comprar"> Comprar
            </button>
        </div>
        <img class="vehiculo__imagen" src="img/chevrolet.png" alt="Vehículo">
    </div>
</section>
    
</main>

        <!-- llamamos el script para el carrusel -->
            <script src="js/carousel.js"></script>

            <script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menu-toggle');
        const dropdown = document.querySelector('.header__dropdown');

        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation(); // Evita que se cierre si se hace clic en el ícono
            dropdown.classList.toggle('active');
        });

        // Cierra el menú si se hace clic fuera de él
        document.addEventListener('click', (e) => {
            if (!dropdown.contains(e.target) && !menuToggle.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });
    });
</script>

    <?php include 'php/include/footer.php'; ?>
</body>
</html>
