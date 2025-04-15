<!-- filepath: c:\xampp\htdocs\carros\php\olvide_contraseña\olvide_contraseña.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Olvidé mi contraseña</title>
  <link rel="stylesheet" href="../../css/login.css"> <!-- Asegúrate de que la ruta sea correcta -->
</head>
<body class="forgot-password">
  <main class="forgot-password__main">
    <h2 class="forgot-password__title">¿Olvidaste tu contraseña?</h2>
    <form class="forgot-password__form" action="envio_enlace.php" method="POST">
      <label class="forgot-password__label" for="email">Correo electrónico:</label>
      <input class="forgot-password__input" type="email" name="email" id="email" required>
      <button class="forgot-password__button" type="submit">Enviar enlace de restablecimiento</button>
    </form>
  </main>
</body>
</html>