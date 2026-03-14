// Ye raha tumhara **script.js** ka **Final Fixed Version**.

// Maine tumhare code se sab galat `fetch` (PHP wala code) hata diya hai jo single file app mein kaam nahi karta tha. Ab yeh pura code **`app` object** ke andar hai aur **localStorage** use karta hai (Database ki tarah). Koi error nahi aayega.

// Bas is code ko copy karo aur apne `script.js` file mein paste kar do.

// ```javascript
// script.js - Final Fixed Version

// --- Dummy Data (Products Database) ---
const productsDB = [
    { id: 1, name: "Wireless Headphones", price: 2999, img: "https://picsum.photos/seed/tech1/300/200" },
    { id: 2, name: "Smart Watch", price: 4500, img: "https://picsum.photos/seed/tech2/300/200" },
    { id: 3, name: "Running Shoes", price: 1800, img: "https://picsum.photos/seed/shoe1/300/200" },
    { id: 4, name: "Denim Jacket", price: 2200, img: "https://picsum.photos/seed/cloth1/300/200" },
    { id: 5, name: "Gaming Mouse", price: 1200, img: "https://picsum.photos/seed/tech3/300/200" },
    { id: 6, name: "Backpack", price: 1500, img: "https://picsum.photos/seed/bag1/300/200" }
];

// --- Main App Object ---
const app = {
    state: {
        cart: JSON.parse(localStorage.getItem('cart')) || [],
        wishlist: JSON.parse(localStorage.getItem('wishlist')) || [],
        user: JSON.parse(localStorage.getItem('user')) || { name: "Guest User", email: "guest@example.com", address: "" }
    },

    // --- INIT FUNCTION (App Start) ---
   init: function() {
    this.renderProducts();
    this.renderCart();
    this.renderWishlist();
    this.updateBadges();
    this.loadProfile();
},

    // --- NAVIGATION LOGIC ---
    showSection: function(sectionId) {
        // 1. Sab sections hide karo
        document.querySelectorAll('.section').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.nav-btn').forEach(el => el.classList.remove('active'));

        // 2. Target section show karo
        const target = document.getElementById(sectionId + '-section');
        if (target) target.classList.add('active');

        // 3. Navbar button active karo
        const btnMap = { 'home': 0, 'cart': 1, 'wishlist': 2, 'profile': 3 };
        const navBtns = document.querySelectorAll('.nav-btn');
        if (navBtns[btnMap[sectionId]]) navBtns[btnMap[sectionId]].classList.add('active');

        // 4. Agar koi specific section khula hai toh uska fresh data load karo
        if (sectionId === 'cart') this.renderCart();
        if (sectionId === 'wishlist') this.renderWishlist();
    },

    // --- PRODUCT RENDERING ---
    renderProducts: function() {
        const container = document.getElementById('product-list');
        if (!container) return;

        container.innerHTML = productsDB.map(product => {
            // Check if item is already in wishlist
            const isWishlisted = this.state.wishlist.some(item => item.id === product.id);
            
            return `
            <div class="product-card">
                <img src="${product.img}" alt="${product.name}" class="product-img">
                <div class="product-info">
                    <h3 class="product-title">${product.name}</h3>
                    <span class="product-price">₹${product.price}</span>
                    <div class="action-buttons">
                        <button class="btn btn-primary" onclick="app.addToCart(${product.id})">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                        <button class="btn btn-outline ${isWishlisted ? 'btn-wishlisted' : ''}" 
                                onclick="app.toggleWishlist(${product.id})">
                            <i class="${isWishlisted ? 'fas' : 'far'} fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
            `;
        }).join('');
    },

    // --- CART LOGIC ---
    addToCart: function(id) {
        const product = productsDB.find(p => p.id === id);
        const existingItem = this.state.cart.find(item => item.id === id);

        if (existingItem) {
            existingItem.qty += 1;
        } else {
            this.state.cart.push({ ...product, qty: 1 });
        }

        this.saveState();
        this.updateBadges();
        this.showToast("Item added to Cart!");
    },

    removeFromCart: function(id) {
        this.state.cart = this.state.cart.filter(item => item.id !== id);
        this.saveState();
        this.renderCart(); // Cart page ko refresh karo
        this.updateBadges();
        this.showToast("Item removed from Cart");
    },

    changeQty: function(id, change) {
        const item = this.state.cart.find(i => i.id === id);
        if (item) {
            item.qty += change;
            if (item.qty <= 0) {
                this.removeFromCart(id);
                return;
            }
        }
        this.saveState();
        this.renderCart();
    },

    renderCart: function() {
        const container = document.getElementById('cart-content');
        if (!container) return;

        if (this.state.cart.length === 0) {
            container.innerHTML = '<div class="empty-msg"><i class="fas fa-shopping-basket fa-3x"></i><br><br>Your cart is empty.</div>';
            return;
        }

        let total = 0;
        let html = `
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
        `;

        this.state.cart.forEach(item => {
            const itemTotal = item.price * item.qty;
            total += itemTotal;
            html += `
                <tr>
                    <td>
                        <div class="item-summary">
                            <img src="${item.img}" class="thumb-img">
                            <span>${item.name}</span>
                        </div>
                    </td>
                    <td>₹${item.price}</td>
                    <td>
                        <button class="qty-btn" onclick="app.changeQty(${item.id}, -1)">-</button>
                        <span>${item.qty}</span>
                        <button class="qty-btn" onclick="app.changeQty(${item.id}, 1)">+</button>
                    </td>
                    <td>₹${itemTotal}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="app.removeFromCart(${item.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        });

        html += `
                </tbody>
            </table>
            <div class="cart-total">
                Grand Total: ₹${total}
                <br><br>
                <button class="btn btn-primary" onclick="app.checkout()">Checkout Now</button>
            </div>
        `;

        container.innerHTML = html;
    },

    checkout: function() {
        if (this.state.cart.length === 0) {
            this.showToast("Cart is empty!");
            return;
        }
        if(confirm("Are you sure you want to place order?")) {
            this.state.cart = []; // Cart clear karo
            this.saveState();
            this.renderCart();
            this.updateBadges();
            this.showToast("Order Placed Successfully! 🎉");
            setTimeout(() => this.showSection('home'), 1500);
        }
    },

    // --- WISHLIST LOGIC ---
    toggleWishlist: function(id) {
        const index = this.state.wishlist.findIndex(item => item.id === id);
        const product = productsDB.find(p => p.id === id);

        if (index === -1) {
            this.state.wishlist.push(product);
            this.showToast("Added to Wishlist ❤️");
        } else {
            this.state.wishlist.splice(index, 1);
            this.showToast("Removed from Wishlist");
        }
        
        this.saveState();
        this.updateBadges();
        this.renderProducts(); // Home page ke heart icons update karo
        
        // Agar wishlist page khula hai toh wahan bhi update karo
        if (document.getElementById('wishlist-section').classList.contains('active')) {
            this.renderWishlist();
        }
    },

    renderWishlist: function() {
        const container = document.getElementById('wishlist-content');
        if (!container) return;

        if (this.state.wishlist.length === 0) {
            container.innerHTML = '<div class="empty-msg"><i class="far fa-heart fa-3x"></i><br><br>Your wishlist is empty.</div>';
            return;
        }

        let html = '<div class="product-grid">'; // Re-use grid class
        this.state.wishlist.forEach(item => {
            html += `
                <div class="product-card">
                    <img src="${item.img}" class="product-img">
                    <div class="product-info">
                        <h4>${item.name}</h4>
                        <p class="product-price">₹${item.price}</p>
                        <div class="action-buttons">
                            <button class="btn btn-primary" onclick="app.addToCart(${item.id}); app.toggleWishlist(${item.id})">Move to Cart</button>
                            <button class="btn btn-danger" onclick="app.toggleWishlist(${item.id})"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        container.innerHTML = html;
    },

    // --- PROFILE LOGIC ---
    loadProfile: function() {
        // Display values update karo
        const nameDisplay = document.getElementById('profile-name-display');
        const emailDisplay = document.getElementById('profile-email-display');
        
        if (nameDisplay) nameDisplay.innerText = this.state.user.name;
        if (emailDisplay) emailDisplay.innerText = this.state.user.email;

        // Input fields fill karo
        const nameInput = document.getElementById('input-name');
        const emailInput = document.getElementById('input-email');
        const addressInput = document.getElementById('input-address');

        if (nameInput) nameInput.value = this.state.user.name;
        if (emailInput) emailInput.value = this.state.user.email;
        if (addressInput) addressInput.value = this.state.user.address || '';
    },

    saveProfile: function(e) {
        e.preventDefault(); // Form submit prevent karo
        const name = document.getElementById('input-name').value;
        const email = document.getElementById('input-email').value;
        const address = document.getElementById('input-address').value;

        if(name && email) {
            this.state.user = { name, email, address };
            this.saveState();
            this.loadProfile();
            this.showToast("Profile Updated Successfully!");
        } else {
            this.showToast("Please fill all fields");
        }
    },

    // --- UTILITIES ---
    saveState: function() {
        localStorage.setItem('cart', JSON.stringify(this.state.cart));
        localStorage.setItem('wishlist', JSON.stringify(this.state.wishlist));
        localStorage.setItem('user', JSON.stringify(this.state.user));
    },

    updateBadges: function() {
        const cartCount = this.state.cart.reduce((sum, item) => sum + item.qty, 0);
        const wishCount = this.state.wishlist.length;

        const cartBadge = document.getElementById('cart-badge');
        const wishBadge = document.getElementById('wish-badge');

        if (cartBadge) {
            cartBadge.innerText = cartCount;
            cartBadge.style.display = cartCount > 0 ? 'block' : 'none';
        }

        if (wishBadge) {
            wishBadge.innerText = wishCount;
            wishBadge.style.display = wishCount > 0 ? 'block' : 'none';
        }
    },

        showToast: function(message) {
        let toast = document.getElementById("toast");
        if (!toast) return;
        toast.innerText = message;
        toast.className = "show";
        setTimeout(function(){
            toast.className = toast.className.replace("show", "");
        }, 3000);
    }
};

// App Start
document.addEventListener('DOMContentLoaded', () => {
    app.init();
});