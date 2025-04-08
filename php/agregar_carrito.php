<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['id'], $_POST['nombre'], $_POST['precio'])) {
    $producto = [
        'id' => $_POST['id'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio']
    ];

    $_SESSION['carrito'][] = $producto;

    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'total' => count($_SESSION['carrito'])
    ]);
    exit;
}

header('Content-Type: application/json');
echo json_encode([
    'success' => false,
    'message' => 'Faltan datos del producto'
]);
exit;