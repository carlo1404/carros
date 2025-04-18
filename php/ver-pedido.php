<?php
session_start();
require_once '../conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "Debes iniciar sesión para ver esta página.";
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if (!isset($_GET['id'])) {
    echo "ID de pedido no especificado.";
    exit;
}

$pedido_id = intval($_GET['id']);

// Consulta segura: solo mostrar si el pedido pertenece al usuario logueado
$sql = "SELECT * FROM pedidos WHERE id = ? AND usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $pedido_id, $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Pedido no encontrado o no tienes acceso.";
    exit;
}

$pedido = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Pedido #<?= $pedido['id'] ?></title>
    <link rel="stylesheet" href="../css/pedidos.css">
</head>
<body>
    <section class="listar-pedidos">
        <div class="listar-pedidos__acciones">
            <a href="mis-pedidos.php" class="btn-link">← Volver a mis pedidos</a>
        </div>

        <h2 class="listar-pedidos__titulo">Detalle del Pedido #<?= $pedido['id'] ?></h2>

        <div class="listar-pedidos__detalle">
            <p><strong>Estado:</strong> <?= htmlspecialchars($pedido['estado']) ?></p>
            <p><strong>Fecha:</strong> <?= htmlspecialchars($pedido['fecha']) ?></p>
            <p><strong>Dirección:</strong> <?= htmlspecialchars($pedido['direccion']) ?>, <?= htmlspecialchars($pedido['localidad']) ?>, <?= htmlspecialchars($pedido['pais']) ?></p>
            <p><strong>Cantidad total de productos:</strong> <?= intval($pedido['cantidad']) ?></p>
            <p><strong>Método de pago:</strong> <?= htmlspecialchars($pedido['metodo_pago']) ?></p>
            <p><strong>Total:</strong> $<?= number_format($pedido['coste'], 2) ?></p>
        </div>
    </section>
</body>
</html>
