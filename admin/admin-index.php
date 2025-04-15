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
    <link rel="stylesheet" href="/carros/css/header.css">
    <link rel="stylesheet" href="../css/styles.css"> <!-- Crea este si deseas estilos nuevos -->
</head>
<body>

<?php include '../php/include/header.php'; ?> <!-- Tu header normal -->

<main class="admin-panel">
    <h2>Bienvenido, <?= htmlspecialchars($nombreAdmin) ?> 👋</h2>
    <p>Selecciona una sección para gestionar el contenido:</p>

    <div class="admin-menu">
        <a href="productos.php" class="admin-card">🛠️ Gestión de productos</a>
        <a href="categorias.php" class="admin-card">📂 Gestión de categorías</a>
        <a href="usuarios.php" class="admin-card">👥 Gestión de usuarios</a>
        <a href="nuevo-admin.php" class="admin-card">➕ Agregar administrador</a>
    </div>
</main>

</body>
</html>