<?php
require_once '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    // Validar que las contraseñas coincidan
    if ($contrasena !== $confirmar) {
        echo "<p style='color:red; text-align:center;'>❌ Las contraseñas no coinciden.</p>";
        exit();
    }

    // Verificar que el correo no exista ya
    $consulta = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<p style='color:red; text-align:center;'>❌ Este correo ya está registrado.</p>";
        exit();
    }

    // Encriptar la contraseña
    $contrasenaSegura = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar nuevo usuario
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $contrasenaSegura);

    if ($stmt->execute()) {
        header("Location: login.php?registro=exitoso");
        exit();
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Error al registrar el usuario.</p>";
    }

    $stmt->close();
}
?>
