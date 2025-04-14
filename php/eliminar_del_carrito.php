<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //  buscamos el id en el array de productos del carrito
    if (isset($_SESSION['carrito'])) {
        $key = array_search($id, $_SESSION['carrito']);
        if ($key !== false) {
            unset($_SESSION['carrito'][$key]);
            // Reindexar el array para evitar huecos en los índices
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
        }
    }
}

// Redirigir de nuevo al carrito
header('Location: carrito.php');
exit();
?>