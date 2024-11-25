<?php
session_start();

// Incluir el archivo de conexión a la base de datos y cargar variables de entorno
include 'db_connection.php';

use Dotenv\Dotenv;

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../.env');
$dotenv->load();

$email = $_POST['email'];
$contraseña = $_POST['contraseña'];

// Usar una consulta preparada para evitar SQL Injection
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);

// Verificar si la preparación de la consulta fue exitosa
if (!$stmt) {
    error_log("Error en la preparación de la consulta: " . mysqli_error($conn), 3, __DIR__ . '/../logs/errors.log');
    die("Error en la base de datos. Por favor, inténtalo más tarde.");
}

mysqli_stmt_bind_param($stmt, "s", $email);  // 's' indica que el parámetro es una cadena
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    error_log("Error al obtener los resultados: " . mysqli_error($conn), 3, __DIR__ . '/../logs/errors.log');
    echo "Error al consultar el usuario. Por favor, inténtalo más tarde.";
    exit();
}

$user = mysqli_fetch_assoc($result);

// Verificar la contraseña
if ($user && password_verify($contraseña, $user['contraseña'])) {
    $_SESSION['user_id'] = $user['id_usuario'];
    $_SESSION['user_name'] = $user['nombre'];
    $_SESSION['user_rol'] = $user['rol'];

    if ($user['rol'] === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: productos.php");
    }
    exit();
} else {
    // Registro de error de credenciales incorrectas
    error_log("Intento de inicio de sesión fallido para el email: $email", 3, __DIR__ . '/../logs/errors.log');
    echo "Credenciales inválidas. <a href='login.php'>Intentar nuevamente</a>";
}

// Configura un tiempo de expiración de sesión en segundos
$duracion_sesion = 3600; // 1 hora
$_SESSION['ultimo_acceso'] = time();

// Verificar si la sesión ha expirado
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso']) > $duracion_sesion) {
    session_unset(); // Elimina las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location: ../index.php");
    exit();
}

// Cerrar la conexión
mysqli_stmt_close($stmt);
mysqli_close($conn);
