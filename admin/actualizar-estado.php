<?php
require_once '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pedido = isset($_POST['id_pedido']) ? intval($_POST['id_pedido']) : 0;
    $nuevo_estado = isset($_POST['nuevo_estado']) ? trim($_POST['nuevo_estado']) : '';

    $estados_permitidos = ['pendiente', 'preparando', 'enviado', 'entregado'];

    if ($id_pedido > 0 && in_array($nuevo_estado, $estados_permitidos)) {
        $stmt = $conexion->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $nuevo_estado, $id_pedido);

        if ($stmt->execute()) {
            header("Location: detalle-pedido.php?id=$id_pedido&estado=actualizado");
            exit;
        } else {
            echo "Error al actualizar el estado: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Datos inválidos.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>
