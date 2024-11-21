<?php
session_start();

// Si no hay sesión iniciada, redirige a login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<a href="logout.php">Cerrar sesión</a>


