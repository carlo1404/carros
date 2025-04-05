<?php
// Datos de conexión
$servidor = "localhost";
$usuario = "root";
$contrasena = "root"; // Cambia esta si tienes contraseña en tu MySQL
$base_de_datos = "carros";

// Crear la conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
$conexion->set_charset("utf8");

// Puedes usar esto para verificar si se conectó correctamente
// echo "Conexión exitosa a la base de datos '$base_de_datos'";
?>
