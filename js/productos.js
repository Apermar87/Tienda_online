document.addEventListener("DOMContentLoaded", () => {
    const contenedorProductos = document.getElementById("contenedor-productos");
    const carrito = []; // Declarar correctamente como un array vacío

    // Obtener productos desde el backend
    fetch("../php/obtener_productos.php")
        .then(respuesta => respuesta.json())
        .then(datos => {
            if (datos.length > 0) {
                datos.forEach(producto => {
                    // Crear tarjeta para cada producto
                    const tarjetaProducto = `
                        <div class="producto">
                            <img src="../${producto.imagen}" alt="${producto.nombre}">
                            <h2>${producto.nombre}</h2>
                            <p>${producto.descripcion}</p>
                            <span>$${producto.precio}</span>
                            <button class="agregar-al-carrito" data-id="${producto.id_producto}" data-nombre="${producto.nombre}" data-precio="${producto.precio}">Agregar al carrito</button>
                        </div>
                    `;
                    contenedorProductos.innerHTML += tarjetaProducto;
                });

                // Agregar eventos a los botones de "Agregar al carrito"
                const botones = document.querySelectorAll(".agregar-al-carrito");
                botones.forEach(boton => {
                    boton.addEventListener("click", () => {
                        const id = boton.getAttribute("data-id");
                        const nombre = boton.getAttribute("data-nombre");
                        const precio = boton.getAttribute("data-precio");

                        // Agregar producto al carrito
                        carrito.push({ id, nombre, precio });
                        actualizarCarrito();
                    });
                });
            } else {
                contenedorProductos.innerHTML = "<p>No hay productos disponibles.</p>";
            }
        })
        .catch(error => {
            console.error("Error al cargar los productos:", error);
        });

    // Actualizar visualización del carrito
    const actualizarCarrito = () => {
        const contenedorCarrito = document.getElementById("carrito");
        contenedorCarrito.innerHTML = "";
        carrito.forEach(item => {
            const elementoCarrito = `<li>${item.nombre} - $${item.precio}</li>`;
            contenedorCarrito.innerHTML += elementoCarrito;
        });
    };
});
