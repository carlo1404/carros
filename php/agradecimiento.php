<?php
// Iniciar la sesión para poder acceder a las variables de sesión
session_start();

// Vaciar el carrito y reiniciar el contador
unset($_SESSION['carrito']);
$_SESSION['contador_carrito'] = 0; // Reiniciar contador del carrito
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por tu compra</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Outfit', sans-serif;
        background: linear-gradient(135deg, #0f0f0f, #1a1a1a);
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 2rem;
        text-align: center;
    }

    .mensaje {
        background-color: #1f1f1f;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 0 25px rgba(0, 255, 204, 0.2);
        max-width: 600px;
        width: 100%;
    }

    .mensaje h1 {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #00ffc3;
    }

    .mensaje p {
        font-size: 1.1rem;
        color: #dcdcdc;
    }

    .btn-regresar {
        margin-top: 2rem;
        display: inline-block;
        background-color: #00ffc3;
        color: #000;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-regresar:hover {
        background-color: #00c2a1;
    }
</style>
</head>
<body>
    <div class="mensaje">
        <h1>¡Gracias por tu compra!</h1>
        <p>Tu pedido ha sido procesado exitosamente. 🛒</p>
        <p>Recibirás una <strong>factura electrónica</strong> en tu correo electrónico en unos minutos.</p>
        <a href="../index.php" class="btn-regresar">Volver al Inicio</a>
        <?php
        $correo = $_POST['email'] ?? 'tu correo electrónico';
        ?>
    <p>La factura será enviada a: <strong><?= htmlspecialchars($correo) ?></strong></p>
    </div>
</body>
</html>