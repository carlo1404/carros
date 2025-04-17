<?php
session_start();
require_once '../conexion.php';

// Verificar que existan datos de pago y productos
if (!isset($_SESSION['pago']) || !isset($_SESSION['pago_productos'])) {
    echo "<p class='alerta__error'>No hay datos de compra disponibles.</p>";
    echo "<a href='index.php' class='volver'>Volver al inicio</a>";
    exit();
}

// Obtener datos de sesión
$pago      = $_SESSION['pago'];
$productos = $_SESSION['pago_productos'];
$usuario_id = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : null;

// Insertar pedido en la base de datos
try {
    $stmt = $pdo->prepare("INSERT INTO pedidos (usuario_id, pais, localidad, direccion, coste, estado, fecha, hora, metodo_pago, total, cantidad)
                           VALUES (:usuario_id, :pais, :localidad, :direccion, :coste, :estado, :fecha, :hora, :metodo_pago, :total, :cantidad)");
    $stmt->execute([
        ':usuario_id'  => $usuario_id,
        ':pais'        => $pago['pais'],
        ':localidad'   => $pago['localidad'],
        ':direccion'   => $pago['direccion'],
        ':coste'       => $pago['total'],
        ':estado'      => 'confirmado',
        ':fecha'       => date('Y-m-d'),
        ':hora'        => date('H:i:s'),
        ':metodo_pago' => $pago['metodo_pago'],
        ':total'       => $pago['total'],
        ':cantidad'    => $pago['cantidad'],
    ]);
} catch (PDOException $e) {
    echo "<p class='alerta__error'>Error al guardar el pedido: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Limpiar datos de sesión (opcional)
unset($_SESSION['pago']);
unset($_SESSION['pago_productos']);

// Limpiar el carrito después de realizar el pedido
unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por su compra</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Outfit', sans-serif;
        background-color: #121212;
        color: #e0e0e0;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 90%;
        max-width: 800px;
        margin: 40px auto;
        background: #1e1e1e;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }
    h1 {
        text-align: center;
        color: #0d6efd;
        margin-bottom: 25px;
        font-weight: 500;
    }
    .datos, .productos {
        margin-bottom: 20px;
    }
    .datos h2, .productos h2 {
        font-size: 1.5rem;
        border-bottom: 2px solid #333;
        padding-bottom: 8px;
        margin-bottom: 15px;
        color: #0d6efd;
    }
    .datos p {
        margin: 6px 0;
        font-size: 1rem;
    }
    .datos strong {
        color: #f1f1f1;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    th, td {
        padding: 12px 8px;
        text-align: left;
        border-bottom: 1px solid #444;
    }
    th {
        background-color: #333;
        color: #f1f1f1;
        font-weight: 500;
    }
    tr:nth-child(even) {
        background-color: #222;
    }
    .total {
        text-align: right;
        font-size: 1.2rem;
        margin-top: 15px;
    }
    .total strong {
        color: #f1f1f1;
    }
    .volver {
        display: inline-block;
        margin-top: 25px;
        padding: 10px 20px;
        background-color: #0d6efd;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }
    .volver:hover {
        background-color: #0b5ed7;
    }
    .mensaje {
        background-color: #222;
        color: #f1f1f1;
        padding: 15px;
        border-radius: 5px;
        margin-top: 20px;
        font-size: 1rem;
        text-align: center;
    }
    </style>
</head>
<body>
<div class="container">
    <h1><i class="bi bi-check-circle-fill"></i> ¡Gracias por tu compra!</h1>

    <div class="datos">
        <h2>Detalles del Pedido</h2>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($pago['nombre']); ?></p>
        <p><strong>Correo:</strong> <?php echo htmlspecialchars($pago['email']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($pago['telefono']); ?></p>
        <p><strong>País:</strong> <?php echo htmlspecialchars($pago['pais']); ?></p>
        <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($pago['localidad']); ?></p>
        <p><strong>Dirección:</strong> <?php echo htmlspecialchars($pago['direccion']); ?></p>
        <p><strong>Método de Pago:</strong> <?php echo htmlspecialchars($pago['metodo_pago']); ?></p>
    </div>

    <div class="productos">
        <h2>Productos Comprados</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                    <td><?php echo (int)$item['cantidad']; ?></td>
                    <td>$<?php echo number_format($item['precio'], 2, ',', '.'); ?></td>
                    <td>$<?php echo number_format($item['subtotal'], 2, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total">
            <strong>Total Productos:</strong> <?php echo (int)$pago['cantidad']; ?><br>
            <strong>Total a Pagar:</strong> $<?php echo number_format($pago['total'], 2, ',', '.'); ?>
        </div>
    </div>

    <a class="volver" href="../index.php">Volver al inicio</a>

    <div class="mensaje">
        <p>Tu factura también te llegará de forma electrónica a tu correo electrónico. ¡Gracias por confiar en nosotros!</p>
    </div>
</div>
</body>
</html>
