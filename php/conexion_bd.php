<?php
// Cargar las dependencias del proyecto
require_once __DIR__ . '/../vendor/autoload.php';

// Cargar las variables de entorno desde el archivo .env
$variablesEntorno = Dotenv\Dotenv::createImmutable(__DIR__ . '/../.env');
$variablesEntorno->load();

// Configurar la conexión a la base de datos
$conexionBD = new mysqli(
    $_ENV['DB_HOST'],       // Host de la base de datos
    $_ENV['DB_USER'],       // Usuario de la base de datos
    $_ENV['DB_PASSWORD'],   // Contraseña de la base de datos
    $_ENV['DB_NAME']        // Nombre de la base de datos
);

// Comprobar si hubo errores en la conexión
if ($conexionBD->connect_error) {
    error_log("Error de conexión a la base de datos: " . $conexionBD->connect_error, 3, __DIR__ . "/../logs/errores.log");
    die("Error al conectar con la base de datos.");
}
?>
