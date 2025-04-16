<?php
session_start();
include '../conexion.php';

// Verificar si hay un id de categoría en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Obtener la categoría desde la base de datos
    $stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra la categoría, redirigir a la lista
    if (!$categoria) {
        header("Location: categorias.php");
        exit;
    }

    // Procesar la actualización si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nuevo_nombre = trim($_POST['nombre']);
        if (!empty($nuevo_nombre)) {
            // Actualizar el nombre de la categoría
            $stmt = $pdo->prepare("UPDATE categorias SET nombre = :nombre WHERE id = :id");
            $stmt->execute(['nombre' => $nuevo_nombre, 'id' => $id]);
            header("Location: categorias.php");
            exit;
        }
    }
} else {
    // Si no hay un id, redirigir a categorías
    header("Location: categorias.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="../css/Normalize.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: 'Segoe UI', sans-serif;
        }

        .admin__categorias-contenedor {
            padding: 2rem;
            max-width: 900px;
            margin: auto;
            background-color: #1e1e1e;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.6);
            margin-top: 50px;
        }

        .titulo {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #fff;
        }

        .input-categoria {
            padding: 0.6rem;
            font-size: 1rem;
            width: 60%;
            border: 1px solid #444;
            border-radius: 6px;
            background-color: #2b2b2b;
            color: #fff;
            margin-bottom: 1rem;
        }

        .btn-agregar {
            padding: 0.6rem 1.2rem;
            background-color: #0d6efd;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-agregar:hover {
            background-color: #0a58ca;
        }
    </style>
</head>
<body>

<?php include '../php/include/header.php'; ?>

<main class="admin__categorias-contenedor">
    <h1 class="titulo">Editar Categoría</h1>

    <form method="POST">
        <input type="text" name="nombre" value="<?= htmlspecialchars($categoria['nombre']) ?>" required class="input-categoria">
        <button type="submit" class="btn-agregar">Actualizar Categoría</button>
    </form>
</main>

</body>
</html>
