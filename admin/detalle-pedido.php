<?php
require_once '../conexion.php';

if (!isset($_GET['id'])) {
    echo "ID de pedido no proporcionado.";
    exit;
}

$id = intval($_GET['id']);

// Consulta el pedido con datos del usuario
$sql = "SELECT pedidos.*, usuarios.nombre, usuarios.email, usuarios.telefono 
        FROM pedidos 
        INNER JOIN usuarios ON pedidos.usuario_id = usuarios.id 
        WHERE pedidos.id = $id 
        LIMIT 1";

$resultado = $conexion->query($sql);

if ($resultado->num_rows === 0) {
    echo "Pedido no encontrado.";
    exit;
}

$pedido = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Pedido #<?= $pedido['id'] ?></title>
    <link rel="stylesheet" href="../css/pedidos.css">
</head>
<body>
    <section class="ver-pedido">
        <h2 class="ver-pedido__titulo">Detalle del pedido #<?= $pedido['id'] ?></h2>

        <div class="ver-pedido__info">
            <p><strong>Estado:</strong> <?= htmlspecialchars($pedido['estado']) ?></p>
            <p><strong>Fecha:</strong> <?= htmlspecialchars($pedido['fecha']) ?> <?= htmlspecialchars($pedido['hora']) ?></p>
            <p><strong>Dirección:</strong> <?= htmlspecialchars($pedido['direccion']) ?>, <?= htmlspecialchars($pedido['localidad']) ?>, <?= htmlspecialchars($pedido['pais']) ?></p>
            <p><strong>Método de pago:</strong> <?= htmlspecialchars($pedido['metodo_pago']) ?></p>
            <p><strong>Cantidad total de productos:</strong> <?= intval($pedido['cantidad']) ?></p>
            <p><strong>Total:</strong> $<?= number_format($pedido['coste'], 2) ?></p>
        </div>

        <h3 class="ver-pedido__subtitulo">Datos del usuario</h3>
        <div class="ver-pedido__info">
            <p><strong>Nombre:</strong> <?= htmlspecialchars($pedido['nombre']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($pedido['email']) ?></p>
            <p><strong>Teléfono:</strong> <?= htmlspecialchars($pedido['telefono']) ?></p>
        </div>
        <?php if (isset($_GET['estado']) && $_GET['estado'] === 'actualizado'): ?>
            <div class="mensaje-exito">
                ✅ Estado actualizado correctamente.
            </div>
        <?php endif; ?>

        <div class="ver-pedido__acciones">
            <form action="actualizar-estado.php" method="POST">
                <input type="hidden" name="id_pedido" value="<?= $pedido['id'] ?>">
                <select name="nuevo_estado" class="ver-pedido__select">
                    <option value="pendiente" <?= $pedido['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="preparando" <?= $pedido['estado'] === 'preparando' ? 'selected' : '' ?>>Preparando</option>
                    <option value="enviado" <?= $pedido['estado'] === 'enviado' ? 'selected' : '' ?>>Enviado</option>
                    <option value="entregado" <?= $pedido['estado'] === 'entregado' ? 'selected' : '' ?>>Entregado</option>
                </select>
                <button type="submit" class="btn-link">Actualizar Estado</button>
            </form>
        </div>

        <div class="ver-pedido__acciones">
            <a href="lista-pedidos.php" class="btn-link">← Volver al listado</a>
            <a href="admin-index.php" class="btn-link">← Panel de administración</a>
        </div>
    </section>
</body>
</html>
