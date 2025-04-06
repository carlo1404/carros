<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header">
    <div class="header__logo dropdown__wrapper">
        <!-- Ícono del menú con ID para el toggle -->
        <img src="img/menu_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="icono" id="menu-toggle">

        <!-- Contenedor del menú desplegable -->
        <div class="header__dropdown">
            <!-- Ver tu carrito con ícono -->
            <a href="php/carrito.php" class="dropdown__cart carrito__enlace" style="position: relative; display: flex; align-items: center; gap: 6px;">
                <img src="img/shopping_cart_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Carrito" style="width: 20px;">
                <span>Ver tu carrito</span>
                <?php if (!empty($_SESSION['carrito'])): ?>
                    <span class="carrito__contador"><?php echo count($_SESSION['carrito']); ?></span>
                <?php endif; ?>
            </a>

            <!-- Cerrar sesión -->
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="php/logout.php" class="cerrar__sesion" style="margin-top: 10px; display: block; color: #fff; text-decoration: underline; font-size: 14px;">
                    Cerrar sesión
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="header__title">
        <h1>Solar Cars</h1>
        <img src="img/logo.png" alt="Auto">
    </div>

    <div class="header__nav">
        <nav>
            <ul>
                <li><a href="#">Configurar</a></li>
                <?php if (!isset($_SESSION['usuario'])): ?>
                    <a href="php/login.php" class="login__link">Log in</a>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>