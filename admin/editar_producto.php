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

// Verificar si se ha pasado un id de producto
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del producto desde la base de datos
    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit();
    }
} else {
    echo "No se ha especificado el producto a editar.";
    exit();
}

// Procesar los datos del formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen = $_FILES['imagen']['name'];

    // Nombre de la imagen por defecto
    $nombreImagen = $producto['imagen'];

    // Verificar si hay una nueva imagen
    if ($imagen) {
        $nombreImagen = uniqid() . '-' . basename($imagen); // Nombre único para la imagen
        $rutaImagen = '../img/' . $nombreImagen;

        // Verificar si el archivo se carga correctamente
        if ($_FILES['imagen']['error'] == 0) {
            $imagenTipo = getimagesize($_FILES['imagen']['tmp_name']);
            if ($imagenTipo !== false) {
                // Mover el archivo a la carpeta img
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
                    // Eliminar la imagen antigua si existe
                    if ($producto['imagen'] !== $nombreImagen && file_exists('../img/' . $producto['imagen'])) {
                        unlink('../img/' . $producto['imagen']);
                    }
                } else {
                    echo "Error al subir la nueva imagen. Verifica el tamaño del archivo y las configuraciones del servidor.";
                    exit();
                }
            } else {
                echo "El archivo no es una imagen válida.";
                exit();
            }
        } else {
            echo "Error al cargar la imagen.";
            exit();
        }
    }

    // Actualizar los datos del producto en la base de datos
    $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, imagen = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ssdiis', $nombre, $descripcion, $precio, $stock, $nombreImagen, $id);

    if ($stmt->execute()) {
        // Redirigir a la página de productos después de la actualización
        header("Location: productos.php");
        exit();
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
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
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #f9f871;
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }

        form {
            background: #1e1e1e;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        label {
            font-size: 1.2rem;
            color: #f1f1f1;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="number"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 20px 0;
            background-color: #333;
            border: 1px solid #444;
            border-radius: 8px;
            color: #fff;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button {
            background-color: #2196F3;
            color: white;
            font-size: 1.2rem;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
            display: block;
            margin: 0 auto;
        }

        button:hover {
            background-color: #1976D2;
        }

        .img-preview {
            max-width: 200px;
            margin-top: 10px;
            border-radius: 8px;
        }

        .img-preview img {
            width: 100%;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<?php include '../php/include/header.php'; ?>

<main class="main__content">
    <h1>Editar Producto</h1>

    <form action="editar_producto.php?id=<?php echo $producto['id']; ?>" method="POST" enctype="multipart/form-data">
        <div>
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
        </div>

        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
        </div>

        <div>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
        </div>

        <div>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($producto['stock']); ?>" required>
        </div>

        <div>
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen">
            <div class="img-preview">
                <p>Imagen actual:</p>
                <img src="../img/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Imagen del producto">
            </div>
        </div>

        <button type="submit">Actualizar Producto</button>
    </form>
</main>

</body>
</html>
