<!-- filepath: c:\xampp\htdocs\carros\php\olvide_contraseña\actualizar_contraseña.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar contraseña</title>
  <link rel="stylesheet" href="../../css/login.css"> <!-- Ruta al archivo CSS -->
</head>
<body class="update-password">
  <main class="update-password__main">
    <div class="update-password__content">
      <?php
      $host = 'localhost';
      $user = 'root'; // Cambia esto si usas otro usuario
      $password = ''; // Cambia esto si tienes una contraseña configurada
      $database = 'carros'; // Cambia esto al nombre de tu base de datos

      $conn = new mysqli($host, $user, $password, $database);

      // Verificar conexión
      if ($conn->connect_error) {
          die("<p class='update-password__error'>Error de conexión: " . $conn->connect_error . "</p>");
      }

      if ($_SERVER["REQUEST_METHOD"] === "POST") {
          $token = $_POST['token'];
          $password = $_POST['password'];
          $confirm = $_POST['confirm'];

          if ($password !== $confirm) {
              echo "<p class='update-password__error'>Las contraseñas no coinciden.</p>";
              exit;
          }

          $hashed = password_hash($password, PASSWORD_DEFAULT);

          // Actualizar contraseña y eliminar token
          $stmt = $conn->prepare("UPDATE usuarios SET password = ?, reset_token = NULL, token_expira = NULL WHERE reset_token = ?");
          $stmt->bind_param("ss", $hashed, $token);
          if ($stmt->execute()) {
              echo "<p class='update-password__success'>¡Contraseña actualizada correctamente!</p>";
              echo "<a class='update-password__link' href='../login.php'>Iniciar sesión</a>";
          } else {
              echo "<p class='update-password__error'>Error al actualizar la contraseña.</p>";
          }
      }
      ?>
    </div>
  </main>
</body>
</html>