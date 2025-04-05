<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Vehículo</title>
    <link rel="stylesheet" href="../css/Normalize.css">
    <link rel="stylesheet" href="../css/detalles_producto.css">
</head>
<body>
    <header class="header">
        <div class="container header__container">
            <div class="header__menu-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="header__logo-group">
                <h1 class="header__title">NOMBRE__CONCESIONARIO</h1>
                <img src="img/car-sports-svgrepo-com.svg" alt="Icono de auto" class="header__car-image">
            </div>
            
            <div class="header__buttons">
                <button class="header__button header__button--config">CONFIGURAR</button>
                <button class="header__button header__button--login">LOG IN</button>
            </div>
        </div>
    </header>
    
    <main class="container">
        <div class="product">
            <div class="product__image-container">
                <img src="img/Corolla-SEG-400x400-2.png" alt="Imagen del vehículo" class="product__image">
            </div>
            <div class="product__info">
                <div class="product__info-row">
                    <div class="product__info-label">Marca</div>
                    <input type="text" class="product__info-input" value="Toyota" readonly>
                </div>
                <div class="product__info-row">
                    <div class="product__info-label">Modelo</div>
                    <input type="text" class="product__info-input" value="Corolla" readonly>
                </div>
                <div class="product__info-row">
                    <div class="product__info-label">Año fabricación</div>
                    <input type="text" class="product__info-input" value="2023" readonly>
                </div>
                <div class="product__info-row">
                    <div class="product__info-label">Kilometraje</div>
                    <input type="text" class="product__info-input" value="15,000 km" readonly>
                </div>
                <div class="product__info-row">
                    <div class="product__info-label">Condiciones Vehículo</div>
                    <input type="text" class="product__info-input" value="Excelente" readonly>
                </div>
                <div class="product__info-row">
                    <div class="product__info-label">Precio</div>
                    <input type="text" class="product__info-input" value="$18,500" readonly>
                </div>
                <div class="product__info-row product__info-row--description">
                    <div class="product__info-label">Descripción</div>
                    <textarea class="product__info-textarea" readonly>Vehículo en excelentes condiciones, único dueño, mantenimiento al día, aire acondicionado, sistema de navegación, cámara de reversa y más características.</textarea>
                </div>
                <div class="product__actions">
                    <button class="product__button product__button--primary">COMPRAR</button>
                    <button class="product__button product__button--secondary">CARRITO</button>
                </div>
            </div>
        </div>
    </main>
    
    <footer class="footer">
        <div class="container footer__container">
            <div class="footer__section">
                <div class="footer__icon">
                    <img src="img/steering-wheel-svgrepo-com.svg" alt="Icono de volante" class="footer__icon-image">
                </div>
                <div class="footer__text">TEST DRIVE</div>
            </div>

            <div class="footer__section">
                <div class="footer__logo">
                    <div class="footer__text">NOMBRE__CONCESIONARIO</div>
                </div>
                <div class="footer__car-icon">
                    <img src="img/car-sports-svgrepo-com.svg" alt="Icono de auto" class="footer__icon-image">
                </div>
            </div>

            <div class="footer__section">
                <div class="footer__icon">
                    <img src="img/phone-svgrepo-com.svg" alt="Icono de teléfono" class="footer__icon-image">
                </div>
                <div class="footer__text">CONTACTANOS</div>
            </div>
        </div>
    </footer>
</body>
</html>