<?php
session_start();

if (!isset($_SESSION['usuario']['imagen'])) {
    // Mostrar una imagen por defecto si no hay imagen de usuario
    $rutaImagen = "../img/perfil.jpg";
} else {
    $rutaImagen = "../img/perfiles/" . $_SESSION['usuario']['imagen'];
}

// Verifica que el archivo existe antes de mostrarlo
if (file_exists($rutaImagen)) {
    $info = getimagesize($rutaImagen);
    header("Content-Type: " . $info['mime']);
    readfile($rutaImagen);
    exit;
} else {
    // Si no se encuentra la imagen, muestra una imagen por defecto
    header("Content-Type: image/jpeg");
    readfile("../img/perfil.jpg");
    exit;
}
