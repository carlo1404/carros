<?php
require_once '../conexion.php';

// Consulta con JOIN para mostrar nombre del usuario
$sql = "SELECT pedidos.*, usuarios.nombre 
        FROM pedidos 
        INNER JOIN usuarios ON pedidos.usuario_id = usuarios.id 
        ORDER BY pedidos.fecha DESC";

$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Pedidos</title>
    <link rel="stylesheet" href="../css/pedidos.css">
</head>
<body>
    <section class="listar-pedidos">
        <h2 class="listar-pedidos__titulo">Lista de Pedidos</h2>

        <ul class="listar-pedidos__lista">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li class="listar-pedidos__item">
                        <a href="detalle-pedido.php?id=<?= $row['id']; ?>" class="listar-pedidos__link">
                            <strong>Pedido #<?= $row['id']; ?></strong><br>
                            <?= htmlspecialchars($row['nombre']) ?> -
                            <?= htmlspecialchars($row['estado']) ?> -
                            <?= htmlspecialchars($row['fecha']) ?> -
                            $<?= number_format($row['total'], 2) ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li class="listar-pedidos__item">
                    <p class="listar-pedidos__link">No hay pedidos registrados.</p>
                </li>
            <?php endif; ?>
        </ul>

        <div class="listar-pedidos__acciones">
            <a href="admin-index.php" class="btn-link">← Volver al panel de administración</a>
            <a href="../index.php" class="btn-link">← Volver al inicio</a>
        </div>
    </section>
</body>
</html>
