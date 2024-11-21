<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Cargar variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../.env');
$dotenv->load();

// Conexión a la base de datos
$conn = new mysqli(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASSWORD'],
    $_ENV['DB_NAME']
);

if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error, 3, __DIR__ . "/../logs/errors.log");
    die("Error de conexión.");
}
?>
