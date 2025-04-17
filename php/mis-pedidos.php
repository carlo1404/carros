<?php
session_start();
require_once '../conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "Debes iniciar sesión para ver tus pedidos.";
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$estado_filtro = isset($_GET['estado']) ? $_GET['estado'] : '';
$estados_permitidos = ['pendiente', 'preparando', 'enviado', 'entregado'];

// Base SQL
$sql = "SELECT * FROM pedidos WHERE usuario_id = ?";
$params = [$usuario_id];
$types = "i";

if ($estado_filtro && in_array($estado_filtro, $estados_permitidos)) {
    $sql .= " AND estado = ?";
    $params[] = $estado_filtro;
    $types .= "s";
}

$sql .= " ORDER BY fecha DESC";

// Ejecutar consulta preparada
$stmt = $conexion->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <link rel="stylesheet" href="../css/pedidos.css">
</head>
<body>
    <section class="listar-pedidos">
        <div class="listar-pedidos__acciones">
            <a href="../index.php" class="btn-link">← Volver al inicio</a>
        </div>

        <h2 class="listar-pedidos__titulo">Mis Pedidos</h2>

        <!-- Formulario de filtro -->
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

        <!-- Lista de pedidos del usuario -->
        <ul class="listar-pedidos__lista">
            <?php if ($resultado->num_rows > 0): ?>
                <?php while ($pedido = $resultado->fetch_assoc()): ?>
                    <li class="listar-pedidos__item">
                        <a href="ver-pedido.php?id=<?= $pedido['id'] ?>" class="listar-pedidos__link">
                            <strong>Pedido #<?= $pedido['id'] ?></strong><br>
                            <?= htmlspecialchars($pedido['estado']) ?> -
                            <?= htmlspecialchars($pedido['fecha']) ?> -
                            $<?= number_format($pedido['coste'], 2) ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li class="listar-pedidos__item">
                    <p class="listar-pedidos__link">No hay pedidos registrados<?= $estado_filtro ? " con estado '$estado_filtro'" : '' ?>.</p>
                </li>
            <?php endif; ?>
        </ul>
    </section>
</body>
</html>
