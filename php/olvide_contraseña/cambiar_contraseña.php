<!-- filepath: c:\xampp\htdocs\carros\php\olvide_contraseña\cambiar_contraseña.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cambiar contraseña</title>
  <link rel="stylesheet" href="../../css/login.css"> <!-- Ruta al archivo CSS -->
</head>
<body class="change-password">
  <main class="change-password__main">
    <div class="change-password__content">
      <?php
      $host = 'localhost';
      $user = 'root'; // Cambia esto si usas otro usuario
      $password = ''; // Cambia esto si tienes una contraseña configurada
      $database = 'carros'; // Cambia esto al nombre de tu base de datos

      $conn = new mysqli($host, $user, $password, $database);

      // Verificar conexión
      if ($conn->connect_error) {
          die("<p class='change-password__error'>Error de conexión: " . $conn->connect_error . "</p>");
      }

      if (isset($_GET['token'])) {
          $token = $_GET['token'];

          $stmt = $conn->prepare("SELECT * FROM usuarios WHERE reset_token = ? AND token_expira > NOW()");
          $stmt->bind_param("s", $token);
          $stmt->execute();
          $resultado = $stmt->get_result();

          if ($resultado->num_rows > 0) {
              // Mostrar formulario
              ?>
              <h2 class="change-password__title">Cambiar contraseña</h2>
              <form class="change-password__form" action="actualizar_contraseña.php" method="POST">
                  <input type="hidden" name="token" value="<?php echo $token; ?>">
                  <label class="change-password__label" for="password">Nueva contraseña:</label>
                  <input class="change-password__input" type="password" name="password" id="password" required>
                  <label class="change-password__label" for="confirm">Confirmar contraseña:</label>
                  <input class="change-password__input" type="password" name="confirm" id="confirm" required>
                  <button class="change-password__button" type="submit">Cambiar contraseña</button>
              </form>
              <?php
          } else {
              echo "<p class='change-password__error'>El token es inválido o ha expirado.</p>";
          }
      }
      ?>
    </div>
  </main>
</body>
</html>