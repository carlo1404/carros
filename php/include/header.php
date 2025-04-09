<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header">
    <div class="header__container">

        <!-- Lado izquierdo -->
        <div class="header__left">
            <button id="menu-toggle" class="menu-btn" title="Menú">
                <img src="img/menu_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Menú">
            </button>

            <a href="/carros/php/tu-shopping-car.php" class="cart-link" title="Ver tu carrito">
                <img src="/carros/img/shopping_cart_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Carrito">
                <span class="cart-badge">
                    <?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>
                </span>
                <span class="cart-text">Carrito</span>
            </a>
        </div>

        <!-- Centro -->
        <div class="header__center">
            <img src="/carros/img/logo.png" alt="Logo" class="header-logo">
            <h1 class="brand-title">Solar Cars</h1>
        </div>

        <!-- Derecha -->
        <nav class="header__right">
            <ul class="nav-links">
                <li><a href="/carros/configurar.php">Configurar</a></li>
                <?php if (!isset($_SESSION['usuario'])): ?>
                    <li><a href="/carros/php/login.php">Log in</a></li>
                <?php else: ?>
                    <li><a href="/carros/php/logout.php">Cerrar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
</header>
