<?php
session_start(); //Inicia sesión
session_unset(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión actual
header("Location: ../index.html"); // Redirigir a la página de inicio
exit();
?>
