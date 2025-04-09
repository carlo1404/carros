<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

    <!-- Título fuera del carrusel -->
    <h2 class="carousel__title">Autos más vendidos</h2>

    <!-- Sección de carros en oferta -->
    <section class="vehiculos__seccion">
        <form action="php/agregar_carrito.php" method="POST" class="vehiculo__card">
            <div class="vehiculo__info">
                <h3>BMW Serie X</h3>
                <p><strong>Precio sugerido desde</strong></p>
                <p>$ 120.000.000</p>
                <p>Motor 2.0 Turbo, automático, 5 puertas</p>
                <input type="hidden" name="id" value="1">
                <input type="hidden" name="nombre" value="BMW Serie X">
                <input type="hidden" name="precio" value="120000000">
                <div class="agregado__contenedor">
                    <button type="submit" class="boton__comprar">
                        <img src="img/carrito-añadir.svg" alt="Comprar"> Agregar
                    </button>
                    <span class="mensaje-agregado"></span>
                </div>
            </div>
            <img class="vehiculo__imagen" src="img/bmw_PNG99543.png" alt="Vehículo">
        </form>

        <form action="php/agregar_carrito.php" method="POST" class="vehiculo__card">
            <div class="vehiculo__info">
                <h3>Chevrolet Spark GT</h3>
                <p><strong>Precio sugerido desde</strong></p>
                <p>$ 40.000.000</p>
                <p>Económico, compacto, ideal ciudad</p>
                <input type="hidden" name="id" value="2">
                <input type="hidden" name="nombre" value="Chevrolet Spark GT">
                <input type="hidden" name="precio" value="40000000">
                <div class="agregado__contenedor">
                    <button type="submit" class="boton__comprar">
                        <img src="img/carrito-añadir.svg" alt="Comprar"> Agregar
                    </button>
                    <span class="mensaje-agregado"></span>
                </div>
            </div>
            <img class="vehiculo__imagen" src="img/chevrolet.png" alt="Vehículo">
        </form>
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

    <!-- Segunda sección de vehículos -->
    <section class="vehiculos__seccion">
        <form action="php/agregar_carrito.php" method="POST" class="vehiculo__card">
            <div class="vehiculo__info">
                <h3>Cadillac XT5</h3>
                <p><strong>Precio sugerido desde</strong></p>
                <p>$ 150.000.000</p>
                <p>Lujo, espacio y tecnología</p>
                <input type="hidden" name="id" value="3">
                <input type="hidden" name="nombre" value="Cadillac XT5">
                <input type="hidden" name="precio" value="150000000">
                <div class="agregado__contenedor">
                    <button type="submit" class="boton__comprar">
                        <img src="img/carrito-añadir.svg" alt="Comprar"> Agregar
                    </button>
                    <span class="mensaje-agregado"></span>
                </div>
            </div>
            <img class="vehiculo__imagen" src="img/cadillac_PNG.png" alt="Vehículo">
        </form>

        <form action="php/agregar_carrito.php" method="POST" class="vehiculo__card">
            <div class="vehiculo__info">
                <h3>Lamborghini Aventador</h3>
                <p><strong>Precio sugerido desde</strong></p>
                <p>$ 1.500.000.000</p>
                <p>Deportivo extremo, motor V12</p>
                <input type="hidden" name="id" value="4">
                <input type="hidden" name="nombre" value="Lamborghini Aventador">
                <input type="hidden" name="precio" value="1500000000">
                <div class="agregado__contenedor">
                    <button type="submit" class="boton__comprar">
                        <img src="img/carrito-añadir.svg" alt="Comprar"> Agregar
                    </button>
                    <span class="mensaje-agregado"></span>
                </div>
            </div>
            <img class="vehiculo__imagen" src="img/lamborghini_.png" alt="Vehículo">
        </form>
    </section>

    </main>

    <!-- Script del carrusel -->
    <script src="js/carousel.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const dropdown = document.querySelector('.header__dropdown');

    if (menuToggle && dropdown) {
        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (!dropdown.contains(e.target) && !menuToggle.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });
    }

    // Agregar al carrito sin recargar
    const formularios = document.querySelectorAll('.vehiculo__card');

    formularios.forEach(formulario => {
        formulario.addEventListener('submit', function(e) {
            e.preventDefault(); // Evita que se recargue la página

            const formData = new FormData(formulario);

            fetch('php/agregar_carrito.php', {
                method: 'POST',
                body: formData
            })
            .then(respuesta => respuesta.json())
            .then(data => {
                const mensaje = formulario.querySelector('.mensaje-agregado');
                mensaje.textContent = '✅ Agregado al carrito';
                mensaje.style.color = 'green';

                // ACTUALIZA EL CONTADOR
                const contador = document.querySelector('.carrito__contador');
                if (contador) {
                    contador.textContent = data.total;
                } else {
                    const nuevoContador = document.createElement('span');
                    nuevoContador.className = 'carrito__contador';
                    nuevoContador.textContent = data.total;

                    const iconoCarrito = document.querySelector('.dropdown__cart');
                    if (iconoCarrito) {
                        iconoCarrito.appendChild(nuevoContador);
                    }
                }

                // Quita el mensaje después de 2 segundos
                setTimeout(() => {
                    mensaje.textContent = '';
                }, 2000);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>

    <?php include 'php/include/footer.php'; ?>
</body>
</html>