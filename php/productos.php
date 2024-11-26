<?php
session_start();

// Si no hay sesión iniciada, redirige a index.php
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../css/productos.css">
</head>

<body>
    <!-- Enlace para cerrar sesión -->
    <a href="cerrar_sesion.php" style="display: block; margin-bottom: 20px;">Cerrar sesión</a>
    <header>
        <h1>Nuestros Productos</h1>
        <div id="carrito-contenedor">
            <h3>Carrito</h3>
            <ul id="carrito">
                <!-- Productos agregados al carrito aparecerán aquí -->
            </ul>
        </div>
    </header>
    <div class="contenedor-productos" id="contenedor-productos">
        <!-- Los productos se cargarán aquí dinámicamente -->
    </div>

    <!-- Script para manejar la carga dinámica de productos -->
    <script src="../js/productos.js"></script>
</body>

</html>