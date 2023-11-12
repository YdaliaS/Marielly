const container_cart = document.getElementById('cart');
const content_cart = container_cart.querySelector('.navb-productos');
const cartTotal = document.getElementById('cart-total');
const clearCart = document.getElementById('clear-cart');
const comprar = document.getElementById('comprar');

document.querySelectorAll('.mas-cantidad').forEach(btn => {
    btn.addEventListener('click', () => {
        const input = btn.parentElement.querySelector('input');
        input.value = parseInt(input.value) + 1;
    });
});

document.querySelectorAll('.menos-cantidad').forEach(btn => {
    btn.addEventListener('click', () => {
        const input = btn.parentElement.querySelector('input');
        const nuevoValor = parseInt(input.value) - 1;
        input.value = nuevoValor < 1 ? 1 : nuevoValor;
    });
});

// Obtiene los datos del carrito
let cartDatos = JSON.parse(localStorage.getItem('cartDatos')) || [];
let cartTotalPrice = parseFloat(localStorage.getItem('cartTotal')) || 0;
// Funciones

/**
 * Total del carrito
 */
function getCartTotal() {
    return cartDatos.reduce((sum, item) => sum + (parseFloat(item.precio) * parseInt(item.cantidad)), 0);
}

/**
 * Actualiza el contenido del carrito
 */
function actualizarCart() {
    // Limpia el contenido actual
    content_cart.innerHTML = '';

    // Recorre los elementos del carrito
    cartDatos.forEach(item => {
        const content = document.createElement('div');
        content.className = "info-cart"

        const totalPrecio = parseFloat(item.precio) * parseInt(item.cantidad);

        content.innerHTML = `
        <div class="producto-bolsa">
            <div class="producto-bolsa-img">
                <img src="${item.imageUrl}" alt="">
            </div>
            <div class="navb-productos-detalles">
                <div class="navb-detalles-one">
                    <div class="navb-nombre-producto">
                        <p>${item.nombre}</p>
                    </div>
                    <div class="navb-precio-producto">
                        <p>${item.precio}</p>
                    </div>
                </div>
                <div class="navb-detalles-two">
                    <div class="navb-detalles-cantidad">
                        <div class="navb-detalles-label">
                            <label for="cantidad-producto">cantidad</label>
                        </div>
                        <div class="navb-detalles-input">
                            <input type="number" name="cantidad-producto" id="cantidad-producto" value="${item.cantidad}">
                        </div>
                    </div>
                    <div class="navb-btn-actualizar">
                        <p>actualizar</p>
                    </div>
                    <div class="navb-acciones">
                        <div class="navb-editar">
                            <img src="../img/edit.svg" alt="">
                        </div>
                        <div class="navb-delete">
                            <img src="../img/delete.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;

        content_cart.appendChild(content)
    })

    const totalCantidad = cartDatos.reduce((sum, item) => sum + item.cantidad, 0)

    // Calcular total
    const total = getCartTotal().toFixed(2);
    cartTotal.textContent = `Total: S/${total}`;

    // Guardar el total en el Local Storage
    localStorage.setItem('cartTotalPrice', total.toString());

    const infocarrito = document.querySelector('.logo_empresa .navb-articulos p')
    const numbercarrito = document.querySelector('.logo_empresa .cantidad-bolsa p')

    if (cartDatos.length > 0) {
        infocarrito.textContent = `${totalCantidad} productos`
        numbercarrito.textContent = `${totalCantidad}`
    } else {
        infocarrito.textContent = `Carrito vacío`
        numbercarrito.textContent = `0`
    }

}

/**
 * Agrega producto al carrito
 */
function agregarACarrito(item) {
    const itemExistente = cartDatos.find(i => i.id == item.id);

    if (itemExistente) {
        // Si el producto existe en el carrito, actualiza la cantidad
        itemExistente.cantidad += item.cantidad;
    } else {
        cartDatos.push(item);
    }

    // Guardar cambios del carrito
    localStorage.setItem('cartDatos', JSON.stringify(cartDatos));

    // Actualizar el carrito
    actualizarCart();
    enviaCarrito();
}

/**
 * Elimina producto del carrito
 */
function removerItem(itemId) {
    cartDatos = cartDatos.filter(item => item.id !== itemId);

    // Guarda los cambios
    localStorage.setItem('cartDatos', JSON.stringify(cartDatos));

    // Actualiza el carrito
    actualizarCart();
    enviaCarrito();
}

/**
 * Vaciar carrito
 */
function vaciarCart() {
    cartDatos = [];

    // Guarda los cambios
    localStorage.setItem('cartDatos', JSON.stringify(cartDatos));

    // Actualiza el carrito
    actualizarCart();
    enviaCarrito();
}

/**
 * Boton para agregar al carrito
 */
document.querySelectorAll('.add-cart').forEach(btn => {
    btn.addEventListener('click', () => {

        const productoContentDiv = btn.closest('.seccion01_info');
        const productNombre = productoContentDiv.querySelector('.title').textContent;
        const productPrecio = productoContentDiv.querySelector('.tag p').textContent;
        const productCantidad = 1;
        const productImgUrl = productoContentDiv.querySelector('.img-muestra').src;
        const productId = btn.dataset.id;

        const item = {
            id: productId,
            nombre: productNombre,
            precio: productPrecio,
            cantidad: productCantidad,
            imageUrl: productImgUrl
        };

        console.log(productPrecio)

        agregarACarrito(item);
    })
})

/**
 * eliminar y vaciar carrito
 */
container_cart.addEventListener('click', e => {
    if (e.target.classList.contains('eliminar-item')) {
        const itemId = e.target.getAttribute('data-id')
        removerItem(itemId)
    } else if (e.target.id == 'clear-cart') {
        vaciarCart();
    }
})

/**
 * Abrir carrito
 */
// var abreCarrito = document.querySelector('.car-shop');
// var carrito = document.querySelector('.productos-car');
// abreCarrito.addEventListener('click', function () {
//     if (carrito.style.display === 'none') {
//         carrito.style.display = 'block'
//     } else {
//         carrito.style.display = 'none'
//     }
// })



function enviaCarrito() {
    actualizarCart();
    const datos = localStorage.getItem('cartDatos');
    const datoPrice = localStorage.getItem('cartTotalPrice');

    document.cookie = 'datosC=' + encodeURIComponent(datos) + '; path=/';
    document.cookie = 'datosP=' + encodeURIComponent(datoPrice) + '; path=/';
}


enviaCarrito();
actualizarCart();