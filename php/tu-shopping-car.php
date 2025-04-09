<?php
session_start();
// Aquí puedes cargar productos del carrito desde sesión o base de datos si lo deseas
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
            <!-- Repite este bloque por cada carro del carrito -->
            <div class="carrito-card">
                <div class="carrito-imagen"></div>
                <h2 class="carrito-titulo">Carro Deportivo</h2>
                <p class="carrito-descripcion">Modelo 2025, motor V8, color rojo mate.</p>
                <button class="carrito-btn"  onclick="window.location.href='detalles_producto.php'">Detalles</button>
            </div>

            <div class="carrito-card">
                <div class="carrito-imagen"></div>
                <h2 class="carrito-titulo">Carro Clásico</h2>
                <p class="carrito-descripcion">Estilo retro, restaurado completamente.</p>
                <button class="carrito-btn"  onclick="window.location.href='detalles_producto.php'">Detalles</button>
            </div>

            <div class="carrito-card">
                <div class="carrito-imagen"></div>
                <h2 class="carrito-titulo">SUV Familiar</h2>
                <p class="carrito-descripcion">Espacioso, ideal para viajes largos.</p>
                <button class="carrito-btn" onclick="window.location.href='detalles_producto.php'">Detalles</button>
            </div>
        </div>

        <div class="carrito-footer">
            <button class="pagar-todo-btn">PAGAR TODO</button>
        </div>
    </main>
</body>
</html>
