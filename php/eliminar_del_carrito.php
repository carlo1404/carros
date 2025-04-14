<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar el producto a eliminar en el carrito (se asume que cada elemento en $_SESSION['carrito'] es un arreglo asociativo con 'id')
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $key => $producto) {
            if ($producto['id'] == $id) {
                unset($_SESSION['carrito'][$key]);
                // Reindexar el array para evitar huecos en los índices
                $_SESSION['carrito'] = array_values($_SESSION['carrito']);
                break;
            }
        }
    }
}

// Si la petición se realizó por AJAX, devolver una respuesta JSON sin redirección
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success']);
    exit();
}

// Si no es una petición AJAX, redirigir de nuevo al carrito
header('Location: carrito.php');
exit();
?>
