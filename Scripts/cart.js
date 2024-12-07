let cart = JSON.parse(localStorage.getItem('cart')) || [];

document.addEventListener('DOMContentLoaded', updateCartCount);

const addToCartButtons = document.querySelectorAll('.add-to-cart');
addToCartButtons.forEach(button => {
    button.addEventListener('click', () => {
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const price = button.getAttribute('data-price');

        addToCart(id, name, price);
    });
});

function addToCart(id, name, price) {
    const existingItem = cart.find(item => item.id === id);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: id,
            name: name,
            price: parseFloat(price),
            quantity: 1
        });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
}

// Update the cart count in the navigation bar
function updateCartCount() {
    const cartCountElement = document.getElementById('cart-count');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCountElement.textContent = totalItems;
}

// Display cart items
if (document.getElementById('cart-items')) {
    displayCartItems();
}

function displayCartItems() {
    const cartItemsContainer = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('total-price');
    let totalPrice = 0;

    cartItemsContainer.innerHTML = '';

    cart.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.innerHTML = `
            <p>${item.name} - Rs.${item.price} x ${item.quantity}</p>
            <button class="remove-from-cart" data-id="${item.id}">Remove</button>
        `;

        cartItemsContainer.appendChild(itemElement);

        totalPrice += item.price * item.quantity;
    });

    totalPriceElement.textContent = totalPrice.toFixed(2);

    // Add event listeners to 'Remove' buttons
    const removeButtons = document.querySelectorAll('.remove-from-cart');
    removeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            removeFromCart(id);
        });
    });
}

// Remove item from cart
function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCartItems();
    updateCartCount();
    syncCartToSession();
}

// Event listener for the checkout button
document.getElementById('checkout-btn')?.addEventListener('click', () => {
    if (cart.length === 0) {
        showCheckoutModal("Cart Is Empty!");
    } else {
        showCheckoutModal("Checkout complete!");

        // Clear the cart
        cart = [];
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        displayCartItems();
    }
});

function showCheckoutModal(message) {
    const modal = document.getElementById("checkoutModal");
    const modalMessage = modal.querySelector('h3');
    modalMessage.innerText = message;
    modal.style.display = "flex";
}

function closeCheckoutModal() {
    document.getElementById("checkoutModal").style.display = "none";
}

// Function to send cart data to PHP session
function syncCartToSession() {
    fetch('Model/sync_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(cart)
    });
}

// Sync cart to session on every update
addToCartButtons.forEach(button => {
    button.addEventListener('click', () => {
        // ... add to cart logic
        syncCartToSession();
    });
});
