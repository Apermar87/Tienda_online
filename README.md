# Tienda Online

Este es un proyecto de una tienda en línea básica desarrollada en PHP, MySQL, y con un sistema de autenticación utilizando sesiones. El proyecto permite a los usuarios registrarse, iniciar sesión y acceder a productos protegidos por autenticación.

## Funcionalidades Implementadas

- **Registro de usuario**: Los usuarios pueden registrarse proporcionando un nombre, correo electrónico y contraseña. La contraseña es cifrada antes de almacenarse en la base de datos.
  
- **Inicio de sesión**: Los usuarios registrados pueden iniciar sesión con su correo electrónico y contraseña. La autenticación se maneja mediante sesiones.

- **Sistema de sesiones**: La sesión del usuario se mantiene activa mientras navega por la tienda. Si el usuario no está autenticado, será redirigido a la página de inicio de sesión.

- **Página de productos**: Una vez que el usuario inicia sesión, puede acceder a la página de productos, donde se le muestra la oferta disponible.

## Tecnologías Utilizadas

- **PHP**: Lenguaje principal utilizado para la lógica de backend y manejo de sesiones.
- **MySQL**: Base de datos para almacenar la información de usuarios y productos.
- **CSS**: Estilos básicos para la interfaz de usuario.
- **JavaScript**: Para interactividad en la tienda (aunque aún no implementado, se planea usar para futuras funcionalidades).
- **Composer**: Gestor de dependencias de PHP, se utiliza para cargar las bibliotecas necesarias.

## Instalación

Para instalar este proyecto en tu máquina local, sigue estos pasos:

1. Clona el repositorio:
    ```bash
    git clone https://github.com/tu_usuario/tienda_online.git
    ```

2. Navega a la carpeta del proyecto:
    ```bash
    cd tienda_online
    ```

3. Asegúrate de tener una base de datos MySQL configurada y ejecuta el script SQL para crear las tablas necesarias.

4. Instala las dependencias de Composer:
    ```bash
    composer install
    ```

5. Configura el archivo `.env` con tus credenciales de base de datos y otras configuraciones.

6. Ejecuta el servidor PHP:
    ```bash
    php -S localhost:8000
    ```

7. Accede a `http://localhost:8000` en tu navegador.

## Lo que falta por hacer

- **Interactividad en la tienda**: Se planea agregar funcionalidades como agregar productos al carrito y realizar compras.
- **Validación de formulario más avanzada**: Mejorar la validación del lado del cliente y del servidor para un registro y login más robustos.
- **Diseño responsivo**: Mejorar la apariencia y hacer que la tienda sea completamente responsiva para dispositivos móviles.

