<?php
include('../conexion.php'); // Asegúrate de ajustar la ruta según tu estructura

$id = $_GET['id'];

// Obtener datos del usuario
$usuario = $conexion->query("SELECT * FROM usuarios WHERE id = $id")->fetch_assoc();

// Buscar su pedido
$pedido = $conexion->query("SELECT * FROM pedidos WHERE usuario_id = $id LIMIT 1")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/usuarios.css">
</head>
<body>
    <section class="ver-usuario">
        <h2 class="ver-usuario__titulo">Datos del usuario</h2>
        <div class="ver-usuario__info">
            <p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
            <p><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
            <p><strong>Teléfono:</strong> <?php echo $usuario['telefono']; ?></p>
        </div>

        <div class="ver-usuario__pedido">
            <?php if ($pedido): ?>
                <a href="detalle-pedido.php?id=<?php echo $pedido['id']; ?>" class="ver-usuario__link">Ver pedido realizado</a>
            <?php else: ?>
                <p><em>Este usuario no ha realizado pedidos.</em></p>
            <?php endif; ?>
        </div>

        <div class="ver-usuario__acciones">
            <a href="lista-usuarios.php" class="ver-usuario__link">← Volver a la lista de usuarios</a>
            <a href="admin-index.php" class="ver-usuario__link">← Volver al panel de administración</a>
        </div>
    </section>
</body>
</html>
