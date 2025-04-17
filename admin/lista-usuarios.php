<?php
require_once '../conexion.php'; 

// Consulta
$result = $conexion->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="../css/usuarios.css">
</head>
<body>
    <section class="lista-usuarios">
    <div class="lista-usuarios__acciones">
            <a href="admin-index.php" class="link">← Volver al panel de administración</a>
            <a href="../index.php" class="link">← Volver al inicio</a>
        </div>
        
        <h2 class="lista-usuarios__titulo">Usuarios registrados</h2>

        <input type="text" id="buscador" class="lista-usuarios__buscador" placeholder="Buscar por nombre, correo o teléfono...">

        <ul id="listaUsuarios" class="lista-usuarios__lista">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="lista-usuarios__item">
                    <a href="ver-usuario.php?id=<?= $row['id']; ?>" class="lista-usuarios__link">
                        <?= htmlspecialchars($row['nombre']) ?><br>
                        <small><?= htmlspecialchars($row['email']) ?> - <?= htmlspecialchars($row['telefono']) ?></small>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>

    </section>

    <script>
        const buscador = document.getElementById('buscador');
        const lista = document.getElementById('listaUsuarios');
        const usuarios = lista.getElementsByTagName('li');

        buscador.addEventListener('input', function() {
            const filtro = this.value.toLowerCase();

            for (let i = 0; i < usuarios.length; i++) {
                const texto = usuarios[i].textContent.toLowerCase();
                usuarios[i].style.display = texto.includes(filtro) ? '' : 'none';
            }
        });
    </script>
</body>
</html>
