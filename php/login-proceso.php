<?php
session_set_cookie_params(0, '/'); 
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
            // Login exitoso: guardar datos en la sesión
            $_SESSION['usuario'] = $usuario;
            // Asignar explícitamente el ID y el rol
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_rol'] = $usuario['rol'];
            
            // Redirigir según el rol
            if ($_SESSION['usuario_rol'] === 'admin') {
                header("Location: ..//admin/productos.php");
            } else {
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
