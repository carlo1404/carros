<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header('Location: /carros/index.php');
    exit;
}

$nombreAdmin = $_SESSION['usuario']['nombre'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../css/admin-panel.css">
    <link rel="stylesheet" href="../css/styles.css"> <!-- Crea este si deseas estilos nuevos -->
    <style>
        html {
    font-size: 62.5%;
}

body {
    background-color: #1e1e1e;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #ffffff;
    margin: 0;
    padding: 0;
}

.admin-panel {
    max-width: 1000px;
    margin: 4rem auto;
    padding: 4rem;
    background-color: #2b2b2b;
    border-radius: 2rem;
    box-shadow: 0 0.4rem 1.2rem rgba(0, 0, 0, 0.3);
    text-align: center;
}

.admin-panel h2 {
    font-size: 2.8rem;
    color: #ffde59;
    margin-bottom: 1rem;
}

.admin-panel p {
    font-size: 1.6rem;
    color: #cccccc;
    margin-bottom: 3rem;
}

.admin-menu {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2rem;
}

.admin-card {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #3a3a3a;
    padding: 2rem;
    border-radius: 1.6rem;
    text-decoration: none;
    color: #ffffff;
    font-size: 1.6rem;
    font-weight: 600;
    transition: 0.3s ease;
    box-shadow: 0 0.3rem 0.8rem rgba(0, 0, 0, 0.2);
}

.admin-card:hover {
    background-color: #ffde59;
    color: #1e1e1e;
    transform: translateY(-4px);
    box-shadow: 0 0.5rem 1.2rem rgba(0, 0, 0, 0.3);
}
    </style>
</head>
<body>

<?php include '../php/include/header.php'; ?> <!-- Tu header normal -->

<main class="admin-panel">
    <h2>Bienvenido, <?= htmlspecialchars($nombreAdmin) ?> 👋</h2>
    <p>Selecciona una sección para gestionar el contenido:</p>

    <div class="admin-menu">
        <a href="productos.php" class="admin-card">🛠️ Gestión de productos</a>
        <a href="categorias.php" class="admin-card">📂 Gestión de categorías</a>
        <a href="lista-pedidos.php" class="admin-card">👥 Mis pedidos</a>
        <a href="nuevo-admin.php" class="admin-card">➕ Agregar administrador</a>
        <a href="lista-usuarios.php" class="admin-card">👨‍🦰Usuarios</a>
    </div>
</main>

</body>
</html>