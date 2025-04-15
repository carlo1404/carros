<?php
// Suponiendo que ya tienes una sesión iniciada y validada para el admin
session_start();
if (!isset($_SESSION['admin'])) {
    // Redirigir si no está autenticado como admin
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>
        /* Estilos generales del panel de administración */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #2C3E50;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav {
            background-color: #34495E;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            padding: 20px;
            background-color: white;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #2C3E50;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: absolute;
            width: 100%;
            bottom: 0;
        }

        footer p {
            margin: 0;
        }

        section {
            text-align: center;
        }

        section h2 {
            color: #34495E;
        }
    </style>
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
    </header>

    <nav>
        <ul>
            <li><a href="productos.php">Gestión de Productos</a></li>
            <li><a href="categorias.php">Gestión de Categorías</a></li>
            <li><a href="usuarios.php">Gestión de Usuarios</a></li>
            <li><a href="nuevo-admin.php">Agregar Administrador</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h2>Bienvenido al Panel de Administración</h2>
            <p>Aquí puedes gestionar los productos, categorías, usuarios y agregar nuevos administradores.</p>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Tu Empresa - Todos los derechos reservados</p>
    </footer>
</body>
</html>
