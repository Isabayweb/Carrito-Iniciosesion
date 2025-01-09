

if (window.innerWidth < 700){

    function moveLeft() {
        const container = document.querySelector('.cards-container');
        container.scrollBy({ left: -220, behavior: 'smooth' }); // Ajusta el valor según sea necesario
    }
    
    function moveRight() {
        const container = document.querySelector('.cards-container');
        container.scrollBy({ left: 220, behavior: 'smooth' }); // Ajusta el valor según sea necesario
    }     

} else{

    function moveLeft() {
        const container = document.querySelector('.cards-container');
        container.scrollBy({ left: -320, behavior: 'smooth' }); // Ajusta el valor según sea necesario
    }
    
    function moveRight() {
        const container = document.querySelector('.cards-container');
        container.scrollBy({ left: 320, behavior: 'smooth' }); // Ajusta el valor según sea necesario
    }


}

const cartContainer = document.getElementById('cart-container');
const cartItems = document.getElementById('cart-items');

function toggleCart() {
    cartContainer.style.display = cartContainer.style.display === 'none' ? 'block' : 'none';
}

function closeCart() {
    cartContainer.style.display = 'none';
}

function loadCart() {
    fetch('cart.php')
        .then(response => response.json())
        .then(data => {
            cartItems.innerHTML = '';
            data.forEach(item => {
                const li = document.createElement('li');
                li.textContent = `${item.name} - $${item.price} x ${item.quantity}`;
                cartItems.appendChild(li);
            });
        });
}

function addToCart(productId, quantity) {
    fetch('cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `product_id=${productId}&quantity=${quantity}`
    }).then(() => {
        alert('Producto agregado al carrito');
        loadCart();
    });
}

// Cargar el carrito al abrirlo
document.getElementById('cart-button').addEventListener('click', loadCart);


document.getElementById("whatsappButton").addEventListener("click", function() {
    // Número de teléfono con el código de país, pero sin signos de + o espacios
    const phoneNumber = "541158093520"; 

    const productosTexto = productos.join(", ");

    // Mensaje a enviar
    const message = `¡Hola! He realizado mi compra por la página web: \n\n${productosTexto}  \n\n El total es: $${total}. \n\n ¿Cómo coordinamos la compra?`;

    // URL de WhatsApp con el número y el mensaje
    const whatsappUrl = "https://api.whatsapp.com/send?phone=" + phoneNumber + "&text=" + encodeURIComponent(message);

    // Redireccionar a la URL de WhatsApp
    window.location.href = whatsappUrl;
});

