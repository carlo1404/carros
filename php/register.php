<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro - SolarAuto</title>
  <link rel="stylesheet" href="../css/register.css">
</head>
<body>

  <header class="header">
    <div class="logo">
      <img src="../img/logo.png" alt="Logo">
      <h1>SolarAuto</h1>
    </div>
    <a href="/carros/index.php" class="header__home-link">
            <img src="../img/icono-home.png" class="header__home-icon" alt="icono del home">
        </a>
  </header>

  <div class="side-decor left"></div>
  <div class="side-decor right"></div>

  <main>
    <div class="form-container glass">
      <div class="icon-top">
        <img src="../img/silueta.png" alt="Icono Registro">
      </div>
      <h2>Registrarse</h2>
      <form action="register-proceso.php" method="POST">
          <input type="text" name="nombre" placeholder="Nombre Completo" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" name="contrasena" placeholder="Contraseña" required>
          <input type="password" name="confirmar" placeholder="Confirmar Contraseña" required>
            <button type="submit">Registrarse</button>
      </form>
    </div>
  </main>

  <?php include 'include/login-footer.php'; ?>

</body>
</html>
