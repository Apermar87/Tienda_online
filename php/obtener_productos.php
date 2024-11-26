<?php
// Incluir archivo de conexión a la base de datos
include 'conexion_bd.php';

// Consulta para obtener todos los productos
$consultaSQL = "SELECT id_producto, nombre, descripcion, precio, imagen FROM productos";
$resultado = mysqli_query($conexionBD, $consultaSQL);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $productos = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $productos[] = $row;
    }
    // Retornar productos como JSON
    echo json_encode($productos);
} else {
    echo json_encode([]);
}

// Cerrar conexión
mysqli_close($conexionBD);
?>
