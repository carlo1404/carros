<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: /carros/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configuración - Admin</title>
    <link rel="stylesheet" href="">
</head>
<body>
<?php include '../include/header.php'; ?>

<main class="main__content">
    <h2>Panel de configuración</h2>
    <!-- Formulario para añadir vehículos -->
    <section>
        <h3>Añadir nuevo vehículo</h3>
        <form action="php/admin/agregar_vehiculo.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre del vehículo" required>
            <input type="number" name="precio" placeholder="Precio" required>
            <textarea name="descripcion" placeholder="Descripción"></textarea>
            <input type="file" name="imagen" accept="image/*" required>
            <button type="submit">Agregar Vehículo</button>
        </form>
    </section>

    <!-- Formulario para añadir categorías -->
    <section>
        <h3>Añadir categoría</h3>
        <form action="php/admin/agregar_categoria.php" method="POST">
            <input type="text" name="nombre_categoria" placeholder="Nombre de la categoría" required>
            <button type="submit">Agregar Categoría</button>
        </form>
    </section>
</main>

<?php include '../include/footer.php'; ?>
</body>
</html>