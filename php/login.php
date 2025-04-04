<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <header class="header">
        <img src="../img/logo.png" class="header__logo" alt="logotipo">
        <a href="#" class="header__home-link">
            <img src="../img/icono-home.png" class="header__home-icon" alt="icono del home">
        </a>
    </header>

    <main class="login">
        <form class="login__form" action="" method="POST">
            <h1 class="login__title">Iniciar Sesión</h1>

            <input type="text" class="login__input" name="usuario" id="usuario" placeholder="Email" required>

            <input type="password" class="login__input" name="contrasena" id="contrasena" placeholder="Contraseña" required>

            <button type="submit" class="login__button">Iniciar Sesión</button>
        </form>
    </main>
    <footer class="footer"></footer>
</body>
</html>