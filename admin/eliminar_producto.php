<?php
session_start();

// Validación de sesión para el área de administración
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Acceso no autorizado.']);
    exit();
}

include '../conexion.php';

// Obtener el ID del producto a eliminar
$id_producto = $_GET['id'] ?? null;

if ($id_producto) {
    // Eliminar producto de la base de datos
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $id_producto);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Producto eliminado correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Hubo un problema al eliminar el producto.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de producto no válido.']);
}

$stmt->close();
$conexion->close();
?>
