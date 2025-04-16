<?php
session_start();
include '../conexion.php';

// Verificar si hay un id de categoría en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Verificar si la categoría existe antes de eliminar
    $stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si la categoría no existe, redirigir a la lista
    if (!$categoria) {
        header("Location: categorias.php");
        exit;
    }

    // Eliminar la categoría
    $stmt = $pdo->prepare("DELETE FROM categorias WHERE id = :id");
    $stmt->execute(['id' => $id]);

    // Redirigir de vuelta a la lista de categorías
    header("Location: categorias.php");
    exit;
} else {
    // Si no hay id, redirigir a categorías
    header("Location: categorias.php");
    exit;
}
?>
