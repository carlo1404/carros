<?php
session_start();
require_once '../conexion.php';

// 1) Verificar usuario autenticado
if (!isset($_SESSION['usuario'])) {
    echo "<p class='alerta__error'>Debes iniciar sesión para realizar una compra.</p>";
    echo "<a href='login.php' class='volver'>Iniciar sesión</a>";
    exit();
}

// 2) Verificar carrito con productos
if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) === 0) {
    echo "<p class='alerta'>No hay productos en el carrito.</p>";
    exit();
}

// 3) Obtener detalles de productos y calcular total inicial
$productos = [];
$total_inicial = 0;
foreach ($_SESSION['carrito'] as $item) {
    // Determinar cantidad por producto (por defecto 1)
    $cant_item = isset($item['cantidad']) ? (int)$item['cantidad'] : 1;

    // Obtener datos del producto
    $stmt = $pdo->prepare("SELECT id, nombre, precio FROM productos WHERE id = :id");
    $stmt->execute([':id' => $item['id']]);
    $prod = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($prod) {
        $prod['cantidad'] = $cant_item;
        $prod['subtotal'] = $prod['precio'] * $cant_item;
        $productos[] = $prod;
        $total_inicial += $prod['subtotal'];
    }
}

// Variable de error
$error = '';

// 4) Procesar envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar campos obligatorios
    if (isset($_POST['pais'], $_POST['localidad'], $_POST['direccion'], $_POST['metodo_pago'])
        && !empty($_POST['pais']) && !empty($_POST['localidad']) && !empty($_POST['direccion']) && !empty($_POST['metodo_pago'])
    ) {
        // Recopilar datos de formulario y usuario
        $nombre_usuario   = $_SESSION['usuario']['nombre'];
        $email_usuario    = $_SESSION['usuario']['email'];
        $telefono_usuario = $_SESSION['usuario']['telefono'];
        $pais             = trim($_POST['pais']);
        $localidad        = trim($_POST['localidad']);
        $direccion        = trim($_POST['direccion']);
        $metodo_pago      = $_POST['metodo_pago'];

        // Recalcular totales según cantidades modificadas
        $productos_compra = [];
        $total           = 0;
        $cantidad_total  = 0;
        foreach ($productos as $prod) {
            $id  = $prod['id'];
            // Verificar si existen nuevas cantidades enviadas
            if (isset($_POST['cantidad'][$id])) {
                $cant = max(1, (int)$_POST['cantidad'][$id]);
            } else {
                $cant = $prod['cantidad'];
            }
            $subtotal = $prod['precio'] * $cant;
            $productos_compra[] = [
                'id'       => $id,
                'nombre'   => $prod['nombre'],
                'precio'   => $prod['precio'],
                'cantidad' => $cant,
                'subtotal' => $subtotal,
            ];
            $total          += $subtotal;
            $cantidad_total += $cant;
        }

        // Guardar datos en sesión para factura
        $_SESSION['pago'] = [
            'nombre'      => $nombre_usuario,
            'email'       => $email_usuario,
            'telefono'    => $telefono_usuario,
            'pais'        => $pais,
            'localidad'   => $localidad,
            'direccion'   => $direccion,
            'metodo_pago' => $metodo_pago,
            'total'       => $total,
            'cantidad'    => $cantidad_total,
        ];
        $_SESSION['pago_productos'] = $productos_compra;

        // Redirigir a factura
        header('Location: agradecimiento.php');
        exit();
    } else {
        $error = "Por favor completa todos los campos del formulario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body { font-family: 'Outfit', sans-serif; background-color: #181818; color: #f5f5f5; margin:0; padding:0; box-sizing:border-box; }
    .container { width:90%; max-width:1000px; margin:30px auto; padding:25px; background:#242424; border-radius:12px; box-shadow:0 8px 20px rgba(0,0,0,0.8); }
    header { text-align:center; margin-bottom:30px; }
    header h1 { font-size:2.8rem; color:#fff; text-transform:uppercase; letter-spacing:3px; margin-bottom:25px; font-weight:600; }
    .card { background:#333; padding:20px; margin-bottom:20px; border-radius:8px; }
    .card h2 { color:#fff; margin-bottom:15px; }
    label, .card p { color:#ddd; font-size:1rem; }
    input[type="text"], input[type="number"] { width:100%; padding:10px; margin-top:5px; margin-bottom:15px; border-radius:6px; border:1px solid #555; background:#333; color:#fff; }
    .productos-lista { list-style:none; padding:0; margin:0; }
    .productos-lista li { display:flex; justify-content:space-between; align-items:center; padding:12px; background:#3a3a3a; border-radius:6px; margin-bottom:10px; }
    .productos-lista li span { font-size:1rem; color:#f5f5f5; }
    .cantidad { width:60px; padding:6px; border-radius:6px; border:1px solid #555; background:#333; color:#fff; text-align:center; }
    .total { font-size:1.5rem; font-weight:bold; color:#28a745; text-align:right; margin-top:10px; }
    .metodos label { display:flex; align-items:center; margin-bottom:10px; color:#ddd; }
    .metodos input { margin-right:8px; }
    button { width:100%; padding:12px; background:#007bff; color:#fff; font-size:1.2rem; border:none; border-radius:6px; cursor:pointer; margin-top:20px; }
    button:hover { background:#0056b3; }
    .error { color:#ff4d4f; text-align:center; margin-bottom:15px; }
    .volver { color:#1e90ff; text-decoration:none; }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1><i class="bi bi-credit-card-2-back"></i> Finalizar Compra</h1>
    </header>

    <?php if (!empty($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <section class="card">
            <h2>👤 Datos del Usuario</h2>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['usuario']['email']); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($_SESSION['usuario']['telefono']); ?></p>
        </section>

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
        <?php 
        // Consulta para obtener el stock de los productos
        foreach ($productos as $prod): 
            // Obtener el stock del producto
            $sql = "SELECT stock FROM productos WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$prod['id']]);
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);
            $stock = $producto['stock'];
        ?>
        <li>
            <span class="nombre"><?php echo htmlspecialchars($prod['nombre']); ?></span>
            <span class="precio">$<?php echo number_format($prod['precio'], 2, ',', '.'); ?></span>
            <span>
                <input 
                    type="number" 
                    name="cantidad[<?php echo $prod['id']; ?>]" 
                    value="<?php echo $prod['cantidad']; ?>" 
                    min="1" 
                    max="<?php echo $stock; ?>" 
                    class="cantidad"
                >
                <span>Stock disponible: <?php echo $stock; ?></span>
            </span>
        </li>
        <?php endforeach; ?>
    </ul>
    <div class="total" id="total">Total: $<?php echo number_format($total_inicial, 2, ',', '.'); ?></div>
</section>


        <section class="card">
            <?php /* Método de Pago */ ?>
            <h2>💳 Método de Pago</h2>
            <div class="metodos">
                <label><input type="radio" name="metodo_pago" value="Efectivo" checked required> Efectivo</label>
                <label><input type="radio" name="metodo_pago" value="Nequi"> Nequi</label>
                <label><input type="radio" name="metodo_pago" value="Bancolombia"> Bancolombia</label>
                <label><input type="radio" name="metodo_pago" value="Davivienda"> Davivienda</label>
                <label><input type="radio" name="metodo_pago" value="PayPal"> PayPal</label>
            </div>
        </section>

        <button type="submit">Confirmar y Generar Factura</button>
    </form>
</div>

<script>
    // Actualizar total en tiempo real al cambiar cantidades
    const qtyInputs = document.querySelectorAll('.cantidad');
    function updateTotal() {
        let sum = 0;
        document.querySelectorAll('.productos-lista li').forEach(li => {
            const priceText = li.querySelector('.precio').innerText.replace(/\./g, '').replace(',', '.').replace('$','');
            const price = parseFloat(priceText) || 0;
            const qty = parseInt(li.querySelector('.cantidad').value) || 0;
            sum += price * qty;
        });
        // Formatear a dos decimales con coma
        const formatted = sum.toFixed(2).replace('.', ',');
        document.getElementById('total').textContent = 'Total: $' + formatted;
    }
    qtyInputs.forEach(input => input.addEventListener('input', updateTotal));
</script>
</body>
</html>
