<?php
// Datos de conexión
$servidor = "localhost";
$usuario = "root";
$contrasena = "";  //si alguno necesita cambiar esto por la contraseña haganlo solo para pruebas claramente 
$base_de_datos = "carros";

try {
    // esto es para que con el pdo se pueda realizar una peticion o una consulta a la base de datos y que se puedan utilizar las funciones de la clase PDO
    $pdo = new PDO("mysql:host=$servidor;dbname=$base_de_datos", $usuario, $contrasena);
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// esto es nada la conexion de la base de datos para los usuarios y admins
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);

// esto es para realizar una validacion a la conexion que acabamos de hacer 
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}



?>

