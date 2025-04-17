<?php
session_start();
require_once('../conexion.php');

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    echo "<p class='alerta__error'>Debes iniciar sesión para realizar una compra.</p>";
    echo "<a href='login.php' class='volver'>Iniciar sesión</a>";
    exit();
}

// Obtener los datos del usuario desde la sesión
$usuario = $_SESSION['usuario'];
$nombre = isset($usuario['nombre']) ? $usuario['nombre'] : '';
$correo = isset($usuario['email']) ? $usuario['email'] : 'Correo no disponible';
$telefono = isset($usuario['telefono']) ? $usuario['telefono'] : 'No disponible';

// Si no hay productos en el carrito
if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0) {
    echo "<p class='alerta'>No hay productos en el carrito.</p>";
    exit();
}

$productos = [];
$total = 0;

foreach ($_SESSION['carrito'] as $producto) {
    $producto_id = $producto['id'];
    $cantidad = isset($producto['cantidad']) ? $producto['cantidad'] : 1;

    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
    $stmt->bindParam(':id', $producto_id, PDO::PARAM_INT);
    $stmt->execute();
    $datos = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($datos) {
        $datos['cantidad'] = $cantidad;
        $productos[] = $datos;
        $total += $datos['precio'] * $cantidad;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Elegante</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/factura.css">
</head>
<body>

<div class="container">
    <header>
        <h1><i class="bi bi-receipt-cutoff"></i> Factura de Compra</h1>
    </header>

    <section class="card">
        <h2>👤 Datos del Usuario</h2>
        <?php if ($usuario): ?>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($correo); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($telefono); ?></p>
        <?php endif; ?>
    </section>

    <form action="agradecimiento.php" method="post">
        <section class="card">
            <h2>📦 Dirección de Envío</h2>

            <label for="pais">País:</label>
            <input type="text" name="pais" id="pais" required>

            <label for="localidad">Ciudad o Localidad:</label>
            <input type="text" name="localidad" id="localidad" required>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" required>
        </section>

        <section class="card">
            <h2>🛍 Productos</h2>
            <ul class="productos-lista">
                <?php foreach ($productos as $prod): ?>
                    <li>
                        <span><?php echo $prod['nombre']; ?> x <?php echo $prod['cantidad']; ?></span>
                        <span>$<?php echo $prod['precio'] * $prod['cantidad']; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="total">Total: $<?php echo $total; ?></div>
        </section>

        <section class="card">
            <h2>💳 Método de Pago</h2>
            <label><input type="radio" name="metodo_pago" value="Efectivo" required> Efectivo</label>
            <label><input type="radio" name="metodo_pago" value="Nequi"> Nequi</label>
            <label><input type="radio" name="metodo_pago" value="Bancolombia"> Bancolombia</label>
            <label><input type="radio" name="metodo_pago" value="Davivienda"> Davivienda</label>
            <label><input type="radio" name="metodo_pago" value="PayPal"> PayPal</label>
        </section>

        <button type="submit"><i class="bi bi-check-circle-fill"></i> Confirmar y Generar Factura</button>
    </form>

    <footer>
        <p>Gracias por comprar con nosotros. 🌙✨</p>
    </footer>
</div>

</body>
</html>
