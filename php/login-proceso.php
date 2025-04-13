<?php
session_start();
require_once '../conexion.php'; // Ajusta la ruta si es necesario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['usuario'];
    $contrasenaIngresada = $_POST['contrasena'];

    // Consulta para buscar el usuario
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña cifrada utilizando password_verify
        if (password_verify($contrasenaIngresada, $usuario['password'])) {
            // Login exitoso
            $_SESSION['usuario'] = $usuario;

            // Verificar si el email contiene 'admin@' (para identificar como admin)
            if (strpos($usuario['email'], 'admin@') !== false) {
                // Redirigir al área de administración si el correo contiene 'admin@'
                header("Location: ../admin_dashboard.php");
            } else {
                // Si no es admin, redirigir a la página principal
                header("Location: ../index.php");
            }
            exit();
        } else {
            echo "<p style='color:red; text-align:center;'>❌ Contraseña incorrecta.</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Usuario no encontrado.</p>";
    }

    $stmt->close();
}
?>
