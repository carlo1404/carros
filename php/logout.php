<?php
session_start();
session_unset();     // Limpia todas las variables de sesión
session_destroy();   // Destruye la sesión

// Redirige a la página principal (puedes cambiar por login.php si prefieres)
header("Location: /carros/index.php");
exit();