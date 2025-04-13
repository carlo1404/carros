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

    // Verificar si el producto ya está en el carrito
    $producto_existente = false;
    foreach ($_SESSION['carrito'] as $item) {
        if ($item['id'] == $producto['id']) {
            $producto_existente = true;
            break;
        }
    }

    // Si el producto no está en el carrito, agregarlo
    if (!$producto_existente) {
        $_SESSION['carrito'][] = $producto;
        $response = [
            'success' => true,
            'total' => count($_SESSION['carrito']),
            'message' => 'Producto agregado correctamente'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Este producto ya está en tu carrito'
        ];
    }

    // Responder con éxito y cantidad total en el carrito
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Si faltan datos, enviar error
header('Content-Type: application/json');
echo json_encode([
    'success' => false,
    'message' => 'Faltan datos del producto'
]);
exit;
?>
