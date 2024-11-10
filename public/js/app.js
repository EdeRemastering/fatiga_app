import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.channel('productos')
    .listen('ProductoAgregado', (e) => {
        // Aquí puedes manipular el DOM para mostrar el nuevo producto
        console.log('Nuevo producto agregado:', e.producto);
        agregarProductoAlCliente(e.producto);
    });

// Función para actualizar la interfaz del cliente
function agregarProductoAlCliente(producto) {
    // Suponiendo que tienes un contenedor donde se muestran los productos
    const productosContainer = document.getElementById('productos-container');
    
    const productoHtml = `
        <div class="col-md-4 mb-4">
            <div class="card-servicios">
                <div class="card-body">
                    <h5 class="card-title">${producto.nombre}</h5>
                    <p class="card-text">${producto.descripcion}</p>
                    <p class="card-text"><strong>Precio:</strong> $${producto.precio}</p>
                    <form action="/productos/solicitar/${producto.id}" method="POST">
                        <button type="submit" class="btn btn-primary">Solicitar producto</button>
                    </form>
                </div>
            </div>
        </div>
    `;

    // Añadir el nuevo producto al contenedor
    productosContainer.insertAdjacentHTML('beforeend', productoHtml);
}
