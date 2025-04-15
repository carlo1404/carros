<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="css/Normalize.css">
</head>
<body class="login-body">
    <header class="login-header">
        <img src="../img/logo.png" class="login-header__logo" alt="logotipo">
        <a href="/carros/index.php" class="login-header__home-link">
            <img src="../img/icono-home.png" class="login-header__home-icon" alt="icono del home">
        </a>
    </header>

    <main class="login-main">
        <form class="login-main__form" action="login-proceso.php" method="POST">
            <h1 class="login-main__title">Iniciar Sesión</h1>

            <input type="text" class="login-main__input" name="usuario" id="usuario" placeholder="Email" required>
            <input type="password" class="login-main__input" name="contrasena" id="contrasena" placeholder="Contraseña" required>

            <a class="login-main__link" href="../php/olvide_contraseña/olvide_contraseña.php">Olvidaste tu contraseña?</a>
            <a class="login-main__link" href="register.php">¿No tienes cuenta? Regístrate</a>

            <button type="submit" class="login-main__button">Iniciar Sesión</button>
        </form>
    </main>

    <?php include 'include/login-footer.php'; ?>
    
</body>
</html>