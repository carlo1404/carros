<?php
// Iniciar la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Crear el carrito si aún no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Verificar que se envían los datos requeridos vía POST
if (isset($_POST['id'], $_POST['nombre'], $_POST['precio'])) {
    $producto = [
        'id' => $_POST['id'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio']
    ];

    // Agregar el producto al carrito
    $_SESSION['carrito'][] = $producto;

    // Responder con éxito y cantidad total en el carrito
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'total' => count($_SESSION['carrito']),
        'message' => 'Producto agregado correctamente'
    ]);
    exit;
}

// Si faltan datos, enviar error
header('Content-Type: application/json');
echo json_encode([
    'success' => false,
    'message' => 'Faltan datos del producto'
]);
exit;
