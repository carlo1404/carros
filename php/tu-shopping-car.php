<?php
session_start();
require_once('../conexion.php');  

// Verificar si el carrito tiene productos
if (!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0) {
    echo "<p>Tu carrito está vacío.</p>";
    exit();
}

// Obtener los datos completos de cada producto en el carrito
$productos_carrito = [];
foreach ($_SESSION['carrito'] as $producto) {
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
    $stmt->bindParam(':id', $producto['id'], PDO::PARAM_INT);
    $stmt->execute();
    $productoDatos = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($productoDatos) {
        $productos_carrito[] = $productoDatos;
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
        // Mostrar cada producto en formato de card
        foreach ($productos_carrito as $producto) {
            echo "<div class='carrito-card' id='producto-{$producto['id']}'>";
            echo "<div class='carrito-imagen'><img src='../img/{$producto['imagen']}' alt='{$producto['nombre']}'></div>";
            echo "<h2 class='carrito-titulo'>{$producto['nombre']}</h2>";
            echo "<p class='carrito-descripcion'>{$producto['descripcion']}</p>";
            echo "<p class='carrito-precio'>Precio: \${$producto['precio']}</p>";
            echo "<button class='carrito-btn' onclick=\"window.location.href='detalles_producto.php?id={$producto['id']}'\">Detalles</button>";
            // Botón de eliminar modificado para usar AJAX
            echo "<button class='carrito-btn eliminar-btn' data-id='{$producto['id']}'>Eliminar</button>";
            echo "</div>";
        }
        ?>
    </div>
    <div class="carrito-footer">
        <button class="pagar-todo-btn" onclick="window.location.href='pagar_todo.php'">PAGAR TODO</button>
    </div>
</main>
<!-- JavaScript para manejar la eliminación asíncrona -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones de eliminación
    const eliminarBtns = document.querySelectorAll('.eliminar-btn');

    eliminarBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault(); // Evita la acción por defecto

            // Obtener el contenedor de la card correspondiente
            const card = this.closest('.carrito-card');
            const productId = this.getAttribute('data-id');

            // Realizar la petición AJAX para eliminar el producto del carrito
            fetch(`eliminar_del_carrito.php?id=${productId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.ok) {
                    // Remover la card del DOM al eliminar el producto
                    card.remove();
                } else {
                    console.error('Error al eliminar el producto.');
                }
            })
            .catch(error => console.error('Error en la petición:', error));
        });
    });
});
</script>
</body>
</html>
