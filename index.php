<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <div class="container">
        <div class="form-box login">
            <form action="php/login_handler.php" method="POST">
                <h1>Iniciar Sesión</h1>
                <div class="input-box">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <i class="bx bxs-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required>
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <button type="submit" class="btn">Accede</button>
            </form>
        </div>

        <div class="form-box register">
            <form action="php/registro_handler.php" method="POST">
                <h1>Registro</h1>
                <div class="input-box">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <i class="bx bxs-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required>
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="password" id="contraseña_confirmada" name="contraseña_confirmada" placeholder="Repetir Contraseña" required>
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <button type="submit" class="btn">Registrarse</button>
            </form>

        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>¡Bienvenido!</h1>
                <p>¿No tienes una cuenta?</p>
                <button class="btn register-btn">Regístrate</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>¡Bienvenido de nuevo!</h1>
                <p>¿Ya tienes una cuenta?</p>
                <button class="btn login-btn">Accede</button>
            </div>
        </div>
    </div>

    <script src="js/index.js"></script>
</body>

</html>