<?php
session_start();
include '../conexion.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

// Proteger acceso a usuarios no logueados
// Solo permitir acceso a administradores
if ($_SESSION['usuario']['rol'] !== 'admin') {
    // Puedes redirigirlo a otra página, mostrar error o simplemente salir
    echo "Acceso denegado. No tienes permisos para ver esta página.";
    exit();
}
// Agregar categoría
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'])) {
    $nombre = trim($_POST['nombre']);
    if (!empty($nombre)) {
        $stmt = $pdo->prepare("INSERT INTO categorias (nombre) VALUES (:nombre)");
        $stmt->execute(['nombre' => $nombre]);
    }
    header("Location: categorias.php");
    exit;
}

// Eliminar categoría
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $check = $pdo->prepare("SELECT COUNT(*) FROM productos WHERE categoria_id = ?");
    $check->execute([$id]);
    if ($check->fetchColumn() == 0) {
        $stmt = $pdo->prepare("DELETE FROM categorias WHERE id = ?");
        $stmt->execute([$id]);
    }
    header("Location: categorias.php");
    exit;
}

// Obtener todas las categorías
$stmt = $pdo->query("SELECT * FROM categorias");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Categorías</title>
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
            margin-top: 50px; /* Este es el margen que añadí para separar más la tabla del header */
        }

        .titulo {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #fff;
        }

        .formulario-categoria {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .input-categoria {
            padding: 0.6rem;
            font-size: 1rem;
            width: 60%;
            border: 1px solid #444;
            border-radius: 6px;
            background-color: #2b2b2b;
            color: #fff;
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

        .tabla-categorias {
            width: 100%;
            border-collapse: collapse;
            background-color: #1a1a1a;
            border-radius: 8px;
            overflow: hidden;
        }

        .tabla-categorias th,
        .tabla-categorias td {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid #333;
        }

        .tabla-categorias thead {
            background-color: #2b2b2b;
        }

        .tabla-categorias tbody tr:hover {
            background-color: #2a2a2a;
        }

        .btn-editar, .btn-eliminar {
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 5px;
            color: white;
            transition: background 0.3s ease;
        }

        .btn-editar {
            background-color: #198754;
        }

        .btn-editar:hover {
            background-color: #157347;
        }

        .btn-eliminar {
            background-color: #dc3545;
        }

        .btn-eliminar:hover {
            background-color: #bb2d3b;
        }
    </style>
</head>
<body>

<?php include '../php/include/header.php'; ?>

<main class="admin__categorias-contenedor">
    <h1 class="titulo">Gestión de Categorías</h1>

    <form method="POST" class="formulario-categoria">
        <input type="text" name="nombre" placeholder="Nueva categoría" required class="input-categoria">
        <button type="submit" class="btn-agregar">Agregar Categoría</button>
    </form>

    <table class="tabla-categorias">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?= $categoria['id'] ?></td>
                <td><?= htmlspecialchars($categoria['nombre']) ?></td>
                <td>
                    <a class="btn-editar" href="editar_categoria.php?id=<?= $categoria['id'] ?>">Editar</a>
                    <a class="btn-eliminar" href="categorias.php?eliminar=<?= $categoria['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

</body>
</html>
