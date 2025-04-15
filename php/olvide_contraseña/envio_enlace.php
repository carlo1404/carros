<!-- filepath: c:\xampp\htdocs\carros\php\olvide_contraseña\envio_enlace.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enlace de recuperación</title>
  <link rel="stylesheet" href="../../css/login.css"> <!-- Ruta al archivo CSS -->
</head>
<body class="recovery-link">
  <main class="recovery-link__main">
    <div class="recovery-link__content">
      <?php
      $host = 'localhost';
      $user = 'root'; // Cambia esto si usas otro usuario
      $password = ''; // Cambia esto si tienes una contraseña configurada
      $database = 'carros'; // Cambia esto al nombre de tu base de datos

      $conn = new mysqli($host, $user, $password, $database);

      // Verificar conexión
      if ($conn->connect_error) {
          die("<p class='recovery-link__error'>Error de conexión: " . $conn->connect_error . "</p>");
      }

      if ($_SERVER["REQUEST_METHOD"] === "POST") {
          $email = $_POST["email"];

          // Verificar si el correo existe
          $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $resultado = $stmt->get_result();

          if ($resultado->num_rows > 0) {
              // Crear token
              $token = bin2hex(random_bytes(50));
              $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

              // Guardar token en la base de datos
              $stmt = $conn->prepare("UPDATE usuarios SET reset_token = ?, token_expira = ? WHERE email = ?");
              $stmt->bind_param("sss", $token, $expira, $email);
              $stmt->execute();

              // Enlace de recuperación
              $enlace = "http://localhost/carros/php/olvide_contraseña/cambiar_contraseña.php?token=$token";

              // Mostrar mensaje de éxito
              echo "<p class='recovery-link__success'>Hemos enviado un enlace a tu correo:</p>";
              echo "<a class='recovery-link__link' href='$enlace'>$enlace</a>";
          } else {
              echo "<p class='recovery-link__error'>Este correo no está registrado.</p>";
          }
      }
      ?>
    </div>
  </main>
</body>
</html>