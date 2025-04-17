<?php
session_start();
require_once('../conexion.php');

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    echo "<p class='alerta__error'>Debes iniciar sesión para realizar una compra.</p>";
    echo "<a href='login.php' class='volver'>Iniciar sesión</a>";
    exit();
}

$usuario = $_SESSION['usuario'];
$usuario_id = $usuario['id'];

// Validar si llegaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pais = $_POST['pais'] ?? '';  // Ahora se usa 'pais'
    $localidad = $_POST['localidad'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $metodo_pago = $_POST['metodo_pago'] ?? '';

    // Validar carrito
    if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) === 0) {
        echo "<p class='alerta'>No hay productos en el carrito.</p>";
        exit();
    }

    // Calcular total y coste
    $total = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $precio = isset($producto['precio']) ? $producto['precio'] : 0;
        $cantidad = isset($producto['cantidad']) ? $producto['cantidad'] : 1;
        $total += $precio * $cantidad;
    }

    $estado = 'pendiente';
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $coste = $total; // El mismo total será el coste

    // Insertar pedido en la base de datos
    $stmt = $pdo->prepare("INSERT INTO pedidos (usuario_id, pais, localidad, direccion, coste, estado, fecha, hora, metodo_pago, total) 
                           VALUES (:usuario_id, :pais, :localidad, :direccion, :coste, :estado, :fecha, :hora, :metodo_pago, :total)");

    $stmt->execute([
        ':usuario_id' => $usuario_id,
        ':pais' => $pais,  // Ahora se usa el campo "pais"
        ':localidad' => $localidad,
        ':direccion' => $direccion,
        ':coste' => $coste,
        ':estado' => $estado,
        ':fecha' => $fecha,
        ':hora' => $hora,
        ':metodo_pago' => $metodo_pago,
        ':total' => $total
    ]);

    // Limpiar carrito
    unset($_SESSION['carrito']);

    // Mensaje de confirmación
    $mensaje = "¡Gracias por tu compra, {$usuario['nombre']}! Tu pedido ha sido registrado con éxito.";
} else {
    $mensaje = "No se han enviado los datos del formulario.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Gracias por tu compra!</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/factura.css">
</head>
<body>

<div class="container">
    <header>
        <h1>🎉 ¡Compra Exitosa!</h1>
    </header>

    <section class="card">
        <h2>🧾 Detalles del Pedido</h2>
        <p><?php echo $mensaje; ?></p>
        <p><strong>Fecha:</strong> <?php echo $fecha; ?></p>
        <p><strong>Hora:</strong> <?php echo $hora; ?></p>
        <p><strong>Total Pagado:</strong> $<?php echo number_format($total, 2); ?></p>
        <p><strong>Método de Pago:</strong> <?php echo htmlspecialchars($metodo_pago); ?></p>
        <p><strong>Dirección:</strong> <?php echo htmlspecialchars($direccion) . ", " . htmlspecialchars($localidad) . ", " . htmlspecialchars($pais); ?></p>
    </section>

    <footer>
        <a href="../index.php" class="volver">🏠 Volver al inicio</a>
    </footer>
</div>

</body>
</html>
