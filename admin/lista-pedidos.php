<?php
require_once '../conexion.php';

// Estados válidos
$estados_permitidos = ['pendiente', 'preparando', 'enviado', 'entregado'];

// Obtener filtro si se envió
$estado_filtro = isset($_GET['estado']) ? $_GET['estado'] : '';

// Consulta base
$sql = "SELECT pedidos.*, usuarios.nombre 
        FROM pedidos 
        INNER JOIN usuarios ON pedidos.usuario_id = usuarios.id";

// Filtro por estado si es válido
if ($estado_filtro && in_array($estado_filtro, $estados_permitidos)) {
    $estado_seguro = $conexion->real_escape_string($estado_filtro);
    $sql .= " WHERE pedidos.estado = '$estado_seguro'";
}

$sql .= " ORDER BY pedidos.fecha DESC";

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

        <div class="listar-pedidos__acciones">
            <a href="admin-index.php" class="btn-link">← Panel de administración</a>
            <a href="../index.php" class="btn-link">← Inicio</a>
        </div>

        <h2 class="listar-pedidos__titulo">Lista de Pedidos</h2>

        <!-- Filtro por estado -->
        <form method="GET" class="listar-pedidos__filtro">
            <label for="estado">Filtrar por estado:</label>
            <select name="estado" id="estado" onchange="this.form.submit()">
                <option value="">Todos</option>
                <?php foreach ($estados_permitidos as $estado): ?>
                    <option value="<?= $estado ?>" <?= $estado === $estado_filtro ? 'selected' : '' ?>>
                        <?= ucfirst($estado) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <!-- Lista de pedidos -->
        <ul class="listar-pedidos__lista">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($pedido = $result->fetch_assoc()): ?>
                    <li class="listar-pedidos__item">
                        <a href="detalle-pedido.php?id=<?= $pedido['id']; ?>" class="listar-pedidos__link">
                            <strong>Pedido #<?= $pedido['id']; ?></strong><br>
                            <?= htmlspecialchars($pedido['nombre']) ?> - 
                            <?= htmlspecialchars($pedido['estado']) ?> - 
                            <?= htmlspecialchars($pedido['fecha']) ?> - 
                            $<?= number_format($pedido['coste'], 2) ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li class="listar-pedidos__item">
                    <p class="listar-pedidos__link">
                        No hay pedidos registrados<?= $estado_filtro ? " con estado '<strong>$estado_filtro</strong>'" : '' ?>.
                    </p>
                </li>
            <?php endif; ?>
        </ul>

    </section>
</body>
</html>
