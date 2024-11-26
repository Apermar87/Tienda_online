<?php
// Incluir el archivo de conexión a la base de datos y cargar variables de entorno
include 'conexion_bd.php';
use Dotenv\Dotenv;

// Cargar variables de entorno
$variablesEntorno = Dotenv::createImmutable(__DIR__ . '/../.env');
$variablesEntorno->load();

// Obtener los valores de los campos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contraseña = $_POST['contraseña'];
$contraseñaConfirmada = $_POST['contraseña_confirmada'];

// Validación del correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    error_log("Error de validación: El correo electrónico no es válido.", 3, __DIR__ . '/../logs/errores.log');
    echo "El correo electrónico no es válido.";
    exit;
}

// Validación de la contraseña
if (strlen($contraseña) < 8 || !preg_match('/[A-Za-z]/', $contraseña) || !preg_match('/[0-9]/', $contraseña)) {
    error_log("Error de validación: La contraseña no cumple los requisitos.", 3, __DIR__ . '/../logs/errores.log');
    echo "La contraseña debe tener al menos 8 caracteres, y contener letras y números.";
    exit;
}

// Verificar que las contraseñas coincidan
if ($contraseña !== $contraseñaConfirmada) {
    error_log("Error de validación: Las contraseñas no coinciden.", 3, __DIR__ . '/../logs/errores.log');
    echo "Las contraseñas no coinciden.";
    exit;
}

// Hashear la contraseña para almacenarla de forma segura
$contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

// Consulta preparada para evitar SQL Injection
$consultaSQL = "INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES (?, ?, ?, ?)";
$rol = 'cliente';
$sentenciaPreparada = mysqli_prepare($conexionBD, $consultaSQL);

// Verificar si la preparación de la consulta fue exitosa
if (!$sentenciaPreparada) {
    error_log("Error en la preparación de la consulta: " . mysqli_error($conexionBD), 3, __DIR__ . '/../logs/errores.log');
    die("Error en la base de datos. Por favor, inténtalo más tarde.");
}

// Vincular los parámetros a la consulta
mysqli_stmt_bind_param($sentenciaPreparada, "ssss", $nombre, $email, $contraseña_hash, $rol);  // 'ssss' indica que los parámetros son cadenas

// Ejecutar la consulta
if (mysqli_stmt_execute($sentenciaPreparada)) {
    header("refresh:3;url=../index.html"); // Redirigir tras 3 segundos
    echo "Registro exitoso. Por favor, inicia sesión.";
    exit();
} else {
    // Registra el error si la ejecución falla
    error_log("Error al ejecutar la consulta de registro: " . mysqli_error($conexionBD), 3, __DIR__ . '/../logs/errores.log');
    echo "Error al registrar el usuario. Por favor, inténtalo más tarde.";
}

// Cerrar la conexión
mysqli_stmt_close($sentenciaPreparada);
mysqli_close($conexionBD);
?>
