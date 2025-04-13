<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$imagenPerfil = "/carros/img/perfil.jpg";  // Imagen predeterminada

if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario']['imagen'])) {
    $imagenPerfil = "/carros/uploads/" . $_SESSION['usuario']['imagen'];
}

$rolUsuario = $_SESSION['usuario']['rol'] ?? '';
$carritoTotal = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;

$current_page = basename($_SERVER['PHP_SELF']);  // Obtener la página actual
?>

<header class="header">
    <div class="header__container">

        <!-- Lado izquierdo -->
        <div class="header__left">
            <?php if (isset($_SESSION['usuario'])): ?>
                <!-- Perfil -->
                <a href="/carros/php/mis-datos.php" title="Ver perfil">
                    <div class="perfil-foto">
                        <img src="<?= $imagenPerfil ?>" alt="Foto de perfil">
                    </div>
                </a>

                <!-- Link de configuración si es admin -->
                <?php if ($rolUsuario === 'admin'): ?>
                    <a href="/carros/configurar.php" class="config-link <?= $current_page == 'configurar.php' ? 'active' : '' ?>" title="Configurar">
                        <span>Configurar</span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Carrito -->
            <a href="/carros/php/tu-shopping-car.php" class="cart-link" title="Ver tu carrito">
                <img src="/carros/img/shopping_cart_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Carrito">
                <span class="cart-badge"><?= $carritoTotal ?></span>
                <span class="cart-text">Carrito</span>
            </a>
        </div>

        <!-- Centro -->
        <div class="header__center">
            <img src="/carros/img/logo.png" alt="Logo" class="header-logo">
            <h1 class="brand-title">Solar Cars</h1>
        </div>

        <!-- Navegación -->
        <nav class="header__right">
            <ul class="nav-links">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li><a href="/carros/php/logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="/carros/php/login.php">Log in</a></li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
</header>
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

    // Agregar al carrito sin recargar la página
    const formularios = document.querySelectorAll('.vehiculo__card');

    formularios.forEach(formulario => {
        formulario.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(formulario);

            fetch('php/agregar_carrito.php', {
                method: 'POST',
                body: formData
            })
            .then(respuesta => respuesta.json())
            .then(data => {
                if (data.total !== undefined) {
                    // Mostrar mensaje
                    let mensaje = formulario.querySelector('.mensaje-agregado');
                    if (!mensaje) {
                        mensaje = document.createElement('div');
                        mensaje.className = 'mensaje-agregado';
                        formulario.appendChild(mensaje);
                    }
                    mensaje.textContent = '✅ Agregado al carrito';
                    mensaje.style.color = 'green';

                    // Actualizar o crear el contador
                    const iconoCarrito = document.querySelector('.cart-link');
                    let contador = iconoCarrito.querySelector('.cart-badge');

                    if (contador) {
                        contador.textContent = data.total;
                    } else {
                        const nuevoContador = document.createElement('span');
                        nuevoContador.className = 'cart-badge';
                        nuevoContador.textContent = data.total;
                        iconoCarrito.appendChild(nuevoContador);
                    }

                    // Limpiar mensaje luego de 2 segundos
                    setTimeout(() => {
                        mensaje.textContent = '';
                        mensaje.style.color = '';
                    }, 2000);
                } else {
                    console.error('Respuesta inesperada:', data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>