<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="css/Normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="body">
    <header class="header">
        <img src="../img/logo.png" class="header__logo" alt="logotipo">
        <a href="/carros/index.php" class="header__home-link">
            <img src="../img/icono-home.png" class="header__home-icon" alt="icono del home">
        </a>
    </header>

    <main class="login">
        <form class="login__form" action="login-proceso.php" method="POST">
            <h1 class="login__title">Iniciar Sesión</h1>

            <input type="text" class="login__input" name="usuario" id="usuario" placeholder="Email" required>

            <input type="password" class="login__input" name="contrasena" id="contrasena" placeholder="Contraseña" required>
            <a class="login__link" href="#">Olvidaste tu contraseña?</a>
            <a class="login__link" href="register.php">¿No tienes cuenta? Regístrate</a>

            <button type="submit" class="login__button">Iniciar Sesión</button>

        </form>
    </main>
    <footer class="footer">
    <div class="footer-content">
      <div class="footer-section about">
        <h3>Sobre Nosotros</h3>
        <p>SolarAuto es tu concesionario de confianza para compra de autos 100% seguros.</p>
      </div>
      <div class="footer-section contact">
        <h3>Contacto</h3>
        <p>📞 +57 123 456 7890</p>
        <p>📧 contacto@solarauto.com</p>
      </div>
      <div class="footer-section location">
        <h3>Ubicación</h3>
        <p>🚗 Av. Automotriz #123, PEREIRA</p>
      </div>
      <div class="footer-section social-icons">
        <h3>Síguenos</h3>
        <img src="../img/facebook.png" alt="Facebook">
        <img src="../img/instagram.gif" alt="Instagram">
        <img src="../img/twitter.png" alt="Twitter">
      </div>
    </div>

  </footer>
    
</body>
</html>