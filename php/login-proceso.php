<?php
session_start();
require_once '../conexion.php'; // Ajusta la ruta si es necesario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['usuario'];
    $password = $_POST['contrasena'];

    // Consulta para buscar el usuario
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        // Comparar contraseña (aquí no usamos hash aún)
        if ($usuario['password'] === $password) {
            // Login exitoso
            $_SESSION['usuario'] = $usuario;
            header("Location: ../index.php");
            exit();
        } else {
            echo "❌ Contraseña incorrecta.";
        }
    } else {
        echo "❌ Usuario no encontrado.";
    }

    $stmt->close();
}
?>