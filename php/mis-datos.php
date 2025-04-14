<?php
session_start();
include('../conexion.php');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];
$imagenPerfil = $_SESSION['usuario']['imagen'];
$telefono = isset($_SESSION['usuario']['telefono']) ? $_SESSION['usuario']['telefono'] : '';  // Verifica que exista en la sesión
$mensaje = "";

// Procesar el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $telefono = $_POST['telefono'];
    $nueva_password = $_POST['nueva_password'];
    $imagen = $imagenPerfil; // Mantener la imagen actual

    // Subir nueva imagen si se proporciona
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = basename($_FILES["imagen"]["name"]);
        $rutaDestino = "../img/perfiles/" . $nombreImagen;  // Ruta donde se guarda la imagen

        // Crear el directorio si no existe
        $directorio = "../img/perfiles/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        // Mover la imagen al directorio
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)) {
            $imagen = $nombreImagen;  // Actualizamos el nombre de la imagen
        } else {
            $mensaje = "❌ Error al subir la imagen.";
        }
    }

    // Actualizar contraseña si se proporciona
    if (!empty($nueva_password)) {
        $hash = password_hash($nueva_password, PASSWORD_BCRYPT);
        $sql = "UPDATE usuarios SET imagen = ?, telefono = ?, password = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssi", $imagen, $telefono, $hash, $usuario_id);
    } else {
        $sql = "UPDATE usuarios SET imagen = ?, telefono = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssi", $imagen, $telefono, $usuario_id);
    }

    if ($stmt->execute()) {
        $mensaje = "✅ Datos actualizados correctamente.";
        $_SESSION['usuario']['imagen'] = $imagen;
        $_SESSION['usuario']['telefono'] = $telefono;  // Actualizamos el teléfono en la sesión
        $imagenPerfil = $imagen; // Actualizamos la imagen en la sesión
    } else {
        $mensaje = "❌ Error al actualizar los datos.";
    }
}

// Obtener los datos del usuario
$sql = "SELECT nombre, email, imagen, telefono FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($nombre, $email, $imagenPerfil, $telefono);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Datos</title>
    <link rel="stylesheet" href="../css/mis-datos.css">
</head>
<body>
    <header>
        <h1>Mis Datos</h1>
        <nav>
            <a href="../index.php">Inicio</a>
        </nav>
    </header>

    <form action="mis-datos.php" method="POST" enctype="multipart/form-data">
        <h2>Bienvenido, <?= htmlspecialchars($nombre) ?></h2>
        <p>Email: <?= htmlspecialchars($email) ?></p>

        <?php if ($mensaje): ?>
            <div class="mensaje"><?= $mensaje ?></div>
        <?php endif; ?>

        <div>
            <label for="imagen">Imagen de perfil:</label>
            <img src="../img/perfiles/<?= htmlspecialchars($imagenPerfil) ?>" alt="Foto de perfil" class="imagen-perfil" id="previewImagen">
            <input type="file" name="imagen" id="imagen " onchange="previewImage(event)">
        </div>

        <div>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($telefono) ?>" placeholder="Teléfono">
        </div>

        <div>
            <label for="nueva_password">Nueva contraseña:</label>
            <input type="password" id="nueva_password" name="nueva_password" placeholder="Nueva contraseña">
        </div>

        <button type="submit">Actualizar datos</button>
    </form>
</body>
</html>
