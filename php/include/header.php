<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si la clave 'usuario' existe en la sesión antes de intentar acceder a ella
$imagenPerfil = "/carros/img/perfil.jpg";  // Imagen predeterminada

// Solo se actualiza si el usuario está autenticado y tiene imagen
if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario']['imagen'])) {
    $imagenPerfil = "/carros/uploads/" . $_SESSION['usuario']['imagen'];
}
?>
<header class="header">
    <div class="header__container">

        <!-- Lado izquierdo -->
        <div class="header__left">
            <!-- Enlace al perfil -->
            <a href="/carros/php/mis-datos.php" title="Ver perfil">
                <div class="perfil-foto">
                    <img src="<?= $imagenPerfil ?>" alt="Foto de perfil">
                </div>
            </a>

            <!-- Enlace al carrito -->
            <a href="/carros/php/tu-shopping-car.php" class="cart-link" title="Ver tu carrito">
                <img src="/carros/img/shopping_cart_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Carrito">
                <span class="cart-badge">
                    <?= isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>
                </span>
                <span class="cart-text">Carrito</span>
            </a>
        </div>

        <!-- Centro: logo y título -->
        <div class="header__center">
            <img src="/carros/img/logo.png" alt="Logo" class="header-logo">
            <h1 class="brand-title">Solar Cars</h1>
        </div>

        <!-- Lado derecho: navegación -->
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
