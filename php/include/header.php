<header class="header">
    <div class="header__logo">
        <!-- Agregamos un id para capturar el clic en el icono -->
        <img src="img/menu_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="icono" id="menu-toggle">
    </div>

    <div class="header__title">
        <h1>Solar Cars</h1>
        <img src="img/logo.png" alt="Auto">
    </div>

    <div class="header__nav">
        <nav>
            <ul>
                <li><a href="#">Configurar</a></li>
                <li><a href="php/login.php">Log in</a></li>
            </ul>
        </nav>
    </div>

    <!-- Menú desplegable oculto por defecto -->
    <div class="header__dropdown">
        <!-- Aquí puedes agregar el icono de carrito de compras -->
        <a href="#" class="dropdown__cart">
            <img src="img/shopping_cart_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.svg" alt="Carrito">
        </a>
        <!-- Puedes agregar más elementos si lo deseas -->
    </div>
</header>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const dropdown = document.querySelector('.header__dropdown');

    menuToggle.addEventListener('click', () => {
        dropdown.classList.toggle('active');
    });
});
</script>