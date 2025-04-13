<?php
// Datos de conexión
$servidor = "localhost";
$usuario = "root";
$contrasena = "";  // Cambia esta si tienes contraseña en tu MySQL
$base_de_datos = "carros";

try {
    // Crear la conexión PDO
    $pdo = new PDO("mysql:host=$servidor;dbname=$base_de_datos", $usuario, $contrasena);
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Crear la conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

