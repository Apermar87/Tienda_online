<?php
// Incluir el archivo de conexión a la base de datos y cargar variables de entorno
include 'db_connection.php';
use Dotenv\Dotenv;

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../.env');
$dotenv->load();

// Obtener los valores de los campos
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contraseña = $_POST['contraseña'];
$contraseña_confirmada = $_POST['contraseña_confirmada'];

// Validación del email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    error_log("Error de validación: El correo electrónico no es válido.", 3, __DIR__ . '/../logs/errors.log');
    echo "El correo electrónico no es válido.";
    exit;
}

// Validación de la contraseña
if (strlen($contraseña) < 8 || !preg_match('/[A-Za-z]/', $contraseña) || !preg_match('/[0-9]/', $contraseña)) {
    error_log("Error de validación: La contraseña no cumple los requisitos.", 3, __DIR__ . '/../logs/errors.log');
    echo "La contraseña debe tener al menos 8 caracteres, y contener letras y números.";
    exit;
}

// Verificar que las contraseñas coincidan
if ($contraseña !== $contraseña_confirmada) {
    error_log("Error de validación: Las contraseñas no coinciden.", 3, __DIR__ . '/../logs/errors.log');
    echo "Las contraseñas no coinciden.";
    exit;
}

// Hashear la contraseña
$contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

// Usar una consulta preparada para evitar SQL Injection
$sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

// Verificar si la preparación de la consulta fue exitosa
if (!$stmt) {
    error_log("Error en la preparación de la consulta: " . mysqli_error($conn), 3, __DIR__ . '/../logs/errors.log');
    die("Error en la base de datos. Por favor, inténtalo más tarde.");
}

mysqli_stmt_bind_param($stmt, "sss", $nombre, $email, $contraseña_hash);  // 'sss' indica que los parámetros son cadenas

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt)) {
    echo "Registro exitoso. Redirigiendo al inicio de sesión...";
    header("refresh:3;url=login.php"); // Redirigir tras 3 segundos
    exit();
} else {
    // Registra el error si la ejecución falla
    error_log("Error al ejecutar la consulta de registro: " . mysqli_error($conn), 3, __DIR__ . '/../logs/errors.log');
    echo "Error al registrar el usuario. Por favor, inténtalo más tarde.";
}

// Cerrar la conexión
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
