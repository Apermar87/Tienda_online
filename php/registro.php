<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Registro</title>
</head>

<body>
    <form action="registro_handler.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>

        <label for="contraseña_confirmada">Confirmar Contraseña:</label>
        <input type="password" id="contraseña_confirmada" name="contraseña_confirmada" required>

        <button type="submit">Registrarse</button>
    </form>

</body>

</html>