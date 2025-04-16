<?php
include '../conexion.php';
include '../php/include/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoria_id = $_POST["categoria_id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $oferta = $_POST["oferta"];
    $fecha = date('Y-m-d');
    $imagen = "";

    // Validación de los campos
    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stock)) {
        echo "<p style='color:red;'>Por favor, completa todos los campos obligatorios.</p>";
    } else {
        // Subida de imagen
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
            $carpeta_destino = "../img/";
            $nombre_imagen = basename($_FILES["imagen"]["name"]);
            $ruta_imagen = $carpeta_destino . $nombre_imagen;
            $tipo_imagen = $_FILES["imagen"]["type"];

            if (in_array($tipo_imagen, ['image/jpeg', 'image/png', 'image/gif'])) {
                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen)) {
                    $imagen = $nombre_imagen;
                } else {
                    echo "<p style='color:red;'>Error al subir la imagen. Verifique los permisos de la carpeta.</p>";
                }
            } else {
                echo "<p style='color:red;'>Solo se permiten imágenes JPEG, PNG o GIF.</p>";
            }
        }

        // Insertar el producto en la base de datos
        try {
            $sql = "INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$categoria_id, $nombre, $descripcion, $precio, $stock, $oferta, $fecha, $imagen]);

            echo "<p style='color:green; text-align: center;'>Producto agregado correctamente.</p>";
        } catch (Exception $e) {
            echo "<p style='color:red;'>Error al agregar el producto: " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Producto</title>
  <link rel="stylesheet" href="../css/styles.css">
  <style>
    /* Estilos globales */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      background-color: #121212;
      color: #e0e0e0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      overflow: hidden;
    }
    main {
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(100vh - 80px); /* Restando altura del header */
    }
    .form-container {
      width: 90%;
      max-width: 360px;
      padding: 15px 20px;
      background-color: #1e1e1e;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.7);
    }
    .form-container h2 {
      text-align: center;
      color: #ffd700;
      margin-bottom: 15px;
      font-size: 20px;
    }
    label {
      font-size: 13px;
      color: #ccc;
      margin-bottom: 4px;
      display: block;
    }
    input, textarea, select {
      width: 100%;
      padding: 8px 10px;
      margin-bottom: 10px;
      border: 1px solid #333;
      border-radius: 4px;
      background-color: #292929;
      color: #e0e0e0;
    }
    button {
      width: 100%;
      padding: 10px;
      background-color: #ffd700;
      border: none;
      border-radius: 4px;
      color: #121212;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
    }
    button:hover {
      background-color: #ffcc00;
    }
    @media screen and (max-width: 600px) {
      .form-container {
        max-width: 90%;
      }
    }
  </style>
</head>
<body>
  <main>
      <div class="form-container">
        <h2>Nuevo Producto</h2>
        <form action="" method="POST" enctype="multipart/form-data">
          <label for="categoria_id">Categoría:</label>
          <select name="categoria_id" required>
            <option value="1">Carros</option>
          </select>
          
          <label for="nombre">Nombre:</label>
          <input type="text" name="nombre" required>
          
          <label for="descripcion">Descripción:</label>
          <textarea name="descripcion" rows="3" required></textarea>
          
          <label for="precio">Precio:</label>
          <input type="number" name="precio" step="0.01" required>
          
          <label for="stock">Stock:</label>
          <input type="number" name="stock" required>
          
          <label for="oferta">Oferta:</label>
          <select name="oferta">
            <option value="">Sin oferta</option>
            <option value="SI">Sí</option>
            <option value="NO">No</option>
          </select>
          
          <label for="imagen">Imagen:</label>
          <input type="file" name="imagen" accept="image/*">
          
          <button type="submit">Agregar Producto</button>
        </form>
      </div>
  </main>
</body>
</html>
