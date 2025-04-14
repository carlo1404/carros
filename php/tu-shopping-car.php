<?php
session_start();
require_once('../conexion.php');  

// Verificar si el carrito tiene productos
if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0) {
    echo "<p>Tu carrito está vacío.</p>";
    exit();
}

// esto es para obtener la id del producto y la cantidad de este en el carrito
$productos_carrito = [];
foreach ($_SESSION['carrito'] as $producto) {   // $producto es un arreglo asociativo
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
    $stmt->bindParam(':id', $producto['id'], PDO::PARAM_INT); // esto es para que el valor del id sea un int
    $stmt->execute(); // esto es para ejecutar la consulta
    $productoDatos = $stmt->fetch(PDO::FETCH_ASSOC); // y esto es para obtener los datos de la consulta
    if ($productoDatos) {
        $productos_carrito[] = $productoDatos; // Agregar el producto completo al array
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito</title>
    <link rel="stylesheet" href="../css/carrito.css">
</head>
<body>
<header class="carrito-header">
    <div class="header-left">
        <img src="../img/logo.png" alt="Carrito" class="logo">
    </div>

    <div class="header-center">
        <h1>Tu carrito</h1>
    </div>

    <div class="header-right">
        <a href="../index.php" class="btn-home">
            <img src="../img/icono-home.png" alt="Inicio">
        </a>
    </div>
</header>

<main class="carrito-main">
    <div class="carrito-container">
        <?php
        // recorremos el array de productos y mostramos cada uno de ellos para que generen cards 
        foreach ($productos_carrito as $producto) {
            echo "<div class='carrito-card'>";
            echo "<div class='carrito-imagen'><img src='../img/{$producto['imagen']}' alt='{$producto['nombre']}'></div>";
            echo "<h2 class='carrito-titulo'>{$producto['nombre']}</h2>";
            echo "<p class='carrito-descripcion'>{$producto['descripcion']}</p>";
            echo "<p class='carrito-precio'>Precio: \${$producto['precio']}</p>";
            echo "<button class='carrito-btn' onclick=\"window.location.href='detalles_producto.php?id={$producto['id']}'\">Detalles</button>";
            // Botón de eliminar producto
            echo "<a href='eliminar_del_carrito.php?id={$producto['id']}' class='carrito-btn eliminar-btn'>Eliminar</a>";
            echo "</div>";
        }
        ?>
    </div>

    <div class="carrito-footer">
        <button class="pagar-todo-btn">PAGAR TODO</button>
    </div>
</main>

</body>
</html>
