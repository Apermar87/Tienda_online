<?php
// Iniciar sesión
session_start();

// Incluir el archivo de conexión a la base de datos y cargar variables de entorno
include 'conexion_bd.php';

use Dotenv\Dotenv;

// Cargar variables de entorno desde el archivo .env
$variablesEntorno = Dotenv::createImmutable(__DIR__ . '/../.env');
$variablesEntorno->load();

// Recibir las credenciales del formulario
$email = $_POST['email'];
$contraseña = $_POST['contraseña'];

// Consulta preparada para evitar SQL Injection
$consultaSQL = "SELECT * FROM usuarios WHERE email = ?";
$sentenciaPreparada = mysqli_prepare($conexionBD, $consultaSQL);

// Verificar si la preparación de la consulta fue exitosa
if (!$sentenciaPreparada) {
    error_log("Error en la preparación de la consulta: " . mysqli_error($conexionBD), 3, __DIR__ . '/../logs/errores.log');
    die("Error en la base de datos. Por favor, inténtalo más tarde.");
}

// Vincular parámetros a la consulta
mysqli_stmt_bind_param($sentenciaPreparada, "s", $email);  // 's' indica que el parámetro es una cadena
mysqli_stmt_execute($sentenciaPreparada);
$resultado = mysqli_stmt_get_result($sentenciaPreparada);

// Verificar si se obtuvo algún resultado
if (!$resultado) {
    error_log("Error al obtener los resultados: " . mysqli_error($conexionBD), 3, __DIR__ . '/../logs/errores.log');
    echo "Error al consultar el usuario. Por favor, inténtalo más tarde.";
    exit();
}

$usuario = mysqli_fetch_assoc($resultado);

// Verificar la contraseña ingresada
if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
    // Establecer variables de sesión
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nombre_usuario'] = $usuario['nombre'];
    $_SESSION['rol_usuario'] = $usuario['rol'];

    // Redirigir según el rol del usuario
    if ($usuario['rol'] === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: productos.php");
    }
    exit();
} else {
    // Registrar el intento fallido de inicio de sesión
    error_log("Intento de inicio de sesión fallido para el email: $email", 3, __DIR__ . '/../logs/errores.log');
    echo "Credenciales inválidas. <a href='login.php'>Intentar nuevamente</a>";
}

// Configurar tiempo de expiración de la sesión
$duracionSesion = 3600; // 1 hora
$_SESSION['ultimo_acceso'] = time();

// Verificar si la sesión ha expirado
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso']) > $duracionSesion) {
    session_unset(); // Elimina las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location: ../index.html");
    exit();
}

// Cerrar la conexión
mysqli_stmt_close($sentenciaPreparada);
mysqli_close($conexionBD);
?>