<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SolarAuto - Detalles de las Compras</title>
    <link href="https://www.dafont.com/es/search.php?q=nasa" rel="stylesheet">
    <link rel="stylesheet" href="../css/detalles_compra.css">
    <link rel="stylesheet" href="../css/Normalize.css"> <link rel="stylesheet" href="../css/detalles_producto.css"> <style>
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: center; /* Centrar las tarjetas si hay espacio */
        }

        .product {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 300px; /* Ancho fijo para cada producto */
        }

        .product__image-container {
            width: 100%;
            max-height: 200px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .product__image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .product__info {
            padding: 15px;
            width: 100%;
        }

        .product__info-row {
            margin-bottom: 10px;
        }

        .product__info-label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .product__info-input,
        .product__info-textarea {
            width: calc(100% - 10px);
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
            resize: none;
        }

        .product__info-textarea {
            min-height: 80px;
        }

        .product__actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
            width: 100%;
        }

        .product__button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .product__button--primary {
            background-color: #007bff;
            color: white;
        }

        .product__button--secondary {
            background-color: #6c757d;
            color: white;
        }

        .product__button--primary:hover {
            background-color: #0056b3;
        }

        .product__button--secondary:hover {
            background-color: #545b62;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="left-section">
            <img src="../img/logo.png" class="logo-left">
        </div>

        <div class="center-section">
            <div class="title">Detalles de las Compras</div>
        </div>

        <div class="right-section">
            <a href="/"><img src="/img/icono-home.png" class="logo-right"></a>
        </div>
    </div>

    <div class="progress-section">
        <button class="progress-item">
            <div class="progress-line"></div>
            <div class="progress-text">TIPO DE VEHICULO</div>
        </button>

        <button class="progress-item">
            <div class="progress-line"></div>
            <div class="progress-text">MARCA AUTOMOTRIZ</div>
        </button>

        <button class="progress-item">
            <div class="progress-line"></div>
            <div class="progress-text">LINEA VEHICULO</div>
        </button>

        <button class="progress-item">
            <div class="progress-line"></div>
            <div class="progress-text">AGENDA TU CITA</div>
        </button>
    </div>


    <div class="cards-container">

        <?php
        // Datos de conexión a la base de datos
        $servername = "localhost"; // Reemplaza con tu servidor si es diferente
        $username = "tu_usuario_bd"; // Reemplaza con tu nombre de usuario de la base de datos
        $password = "tu_contraseña_bd"; // Reemplaza con tu contraseña de la base de datos
        $dbname = "carros";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL para obtener todos los productos
        $sql = "SELECT nombre, descripcion, precio, fecha, imagen FROM productos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los datos de cada producto en un "product" div
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<div class="product__image-container">';
                if (!empty($row["imagen"])) {
                    echo '<img src="../img/' . htmlspecialchars($row["imagen"]) . '" alt="' . htmlspecialchars($row["nombre"]) . '" class="product__image">';
                } else {
                    echo '<img src="../img/placeholder.png" alt="Imagen no disponible" class="product__image">';
                }
                echo '</div>';
                echo '<div class="product__info">';
                echo '<div class="product__info-row">';
                echo '<div class="product__info-label">Nombre</div>';
                echo '<input type="text" class="product__info-input" value="' . htmlspecialchars($row["nombre"]) . '" readonly>';
                echo '</div>';
                echo '<div class="product__info-row">';
                echo '<div class="product__info-label">Precio</div>';
                echo '<input type="text" class="product__info-input" value="$' . number_format($row["precio"], 2) . '" readonly>';
                echo '</div>';
                echo '<div class="product__info-row product__info-row--description">';
                echo '<div class="product__info-label">Descripción</div>';
                echo '<textarea class="product__info-textarea" readonly>' . htmlspecialchars($row["descripcion"]) . '</textarea>';
                echo '</div>';
                echo '<div class="product__info-row">';
                echo '<div class="product__info-label">Fecha</div>';
                echo '<input type="text" class="product__info-input" value="' . htmlspecialchars($row["fecha"]) . '" readonly>';
                echo '</div>';
                echo '<div class="product__actions">';
                echo '<a href="detalles_compra.php?id=' . $row["id"] . '"><button class="product__button product__button--primary">COMPRAR</button></a>'; // Puedes pasar el ID si lo necesitas
                echo '<button class="product__button product__button--secondary">CARRITO</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No se encontraron productos.</p>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>

    </div>

    <div class="button-container">
        <button class="back-button">Volver</button>
    </div>
</body>

</html>