<?php
session_set_cookie_params(0, '/');
session_start();

// Validación de sesión para el área de administración
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: ../php/login.php");
    exit();
}

// Conectar a la base de datos
include '../conexion.php';

// Consultar todos los productos
$sql = "SELECT * FROM productos";
$result = $conexion->query($sql);

$productos = [];
if ($result && $result->num_rows > 0) {
    while ($producto = $result->fetch_assoc()) {
        $productos[] = $producto;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos - Admin</title>
    <link rel="stylesheet" href="../css/Normalize.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .main__content {
            padding: 2rem 1rem;
        }

        .titulo-productos {
            color: #f1f1f1;
            font-size: 3.2rem;
            font-weight: bold;
            text-align: center;
            margin: 2rem 0;
        }

        .btn-agregar {
            display: block;
            margin: 0 auto 2rem auto;
            padding: 12px 30px;
            background: #2196F3;
            color: #fff;
            font-size: 1.4rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s ease;
            text-align: center;
            width: fit-content;
        }

        .btn-agregar:hover {
            background: #1976D2;
        }

        .productos-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .producto-card {
            background: #1e1e1e;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            width: 300px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
        }

        .producto-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(255, 255, 255, 0.05);
        }

        .producto-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .producto-card .info {
            padding: 20px;
            flex-grow: 1;
        }

        .producto-card .info h3 {
            font-size: 1.6rem;
            color: #f9f871;
            margin-bottom: 10px;
        }

        .producto-card .info p {
            font-size: 1.2rem;
            color: #ccc;
            margin: 6px 0;
        }

        .producto-card .info strong {
            color: #fff;
        }

        .producto-card .actions {
            padding: 15px;
            background: #2a2a2a;
            border-top: 1px solid #444;
            text-align: center;
        }

        .producto-card .actions a {
            margin: 0 10px;
            text-decoration: none;
            font-size: 1.2rem;
            color: #4FC3F7;
            font-weight: bold;
            transition: color 0.2s;
        }

        .producto-card .actions a:hover {
            color: #81D4FA;
        }
    </style>
</head>
<body>

<?php include '../php/include/header.php'; ?>

<main class="main__content">
    <h1 class="titulo-productos">Gestión de Productos</h1>
    <a href="crear_producto.php" class="btn-agregar">➕ Agregar Producto</a>

    <div class="productos-container">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto-card">
                    <?php
                    // Definir la ruta de la imagen
                    $imagenRuta = "../img/" . htmlspecialchars($producto['imagen']);
                    
                    // Verificar si la imagen existe
                    if (file_exists($imagenRuta)) {
                        $imagenMostrar = $imagenRuta;
                    } else {
                        $imagenMostrar = "../img/default.png";
                    }
                    ?>
                    <img src="<?php echo $imagenMostrar; ?>"
                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                         onerror="this.onerror=null; this.src='../img/default.png';">
                    <div class="info">
                        <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                        <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                        <p><strong>$<?php echo number_format($producto['precio'], 2); ?></strong></p>
                        <p>Stock: <?php echo htmlspecialchars($producto['stock']); ?></p>
                    </div>
                    <div class="actions">
                        <a href="editar_producto.php?id=<?php echo $producto['id']; ?>" class="editar-producto">Editar</a> |
                        <a href="#" class="eliminar-producto" data-id="<?php echo $producto['id']; ?>">Eliminar</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron productos.</p>
        <?php endif; ?>
    </div>
</main>

<!-- Incluir jQuery y el script JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Cuando se hace clic en el enlace de eliminar
        $('.eliminar-producto').click(function (e) {
            e.preventDefault();

            // Confirmar si realmente desea eliminar el producto
            var productoCard = $(this).closest('.producto-card');
            var idProducto = $(this).data('id');

            if (confirm('¿Estás seguro de eliminar este producto?')) {
                // Enviar solicitud AJAX para eliminar el producto
                $.ajax({
                    url: 'eliminar_producto.php',
                    method: 'GET',
                    data: { id: idProducto },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            // Eliminar el producto de la vista
                            productoCard.remove();
                            alert(response.message); // Mensaje de éxito
                        } else {
                            alert(response.message); // Mostrar mensaje de error
                        }
                    },
                    error: function () {
                        alert('Hubo un problema al eliminar el producto.');
                    }
                });
            }
        });
    });
</script>
</body>
</html>
