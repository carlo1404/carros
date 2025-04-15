
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Vehículo</title>
    <link rel="stylesheet" href="../css/Normalize.css">
    <link rel="stylesheet" href="../css/detalles_producto.css">
</head>
<body>
<?php
$nombre = $_GET['nombre'] ?? 'Nombre no disponible';
$descripcion = $_GET['descripcion'] ?? 'Sin descripción';
$precio = $_GET['precio'] ?? '0';
$imagen = $_GET['imagen'] ?? 'default.png';
include 'include/header.php';
?>
<main class="container">
    <div class="product">
        <div class="product__image-container">
            <img src="../img/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen del vehículo" class="product__image">
        </div>
        <div class="product__info">
            <div class="product__info-row">
                <div class="product__info-label">Nombre</div>
                <input type="text" class="product__info-input" value="<?php echo htmlspecialchars($nombre); ?>" readonly>
            </div>
            <div class="product__info-row">
                <div class="product__info-label">Precio</div>
                <input type="text" class="product__info-input" value="$<?php echo htmlspecialchars($precio); ?>" readonly>
            </div>
            <div class="product__info-row product__info-row--description">
                <div class="product__info-label">Descripción</div>
                <textarea class="product__info-textarea" readonly><?php echo htmlspecialchars($descripcion); ?></textarea>
            </div>
            <div class="product__actions">
                <a href="#pagina murillo"><button class="product__button product__button--primary">COMPRAR</button></a>
                <button class="product__button product__button--secondary">CARRITO</button>
            </div>
        </div>
    </div>
</main>
<?php include 'include/footer.php'; ?>
</body>
</html>
