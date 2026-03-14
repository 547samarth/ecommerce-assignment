<?php
// index.php

// --- 1. BACKEND SETUP (Database Logic) ---
// Hum yahan PHP Sessions use kar rahe hain data save karne ke liye.
// Real MySQL ki jagah hum Server Side Session use kar rahe hain taaki bina file permission issues kaam kare.

session_start();

// Initial Data Setup agar session pehli baar bana ho
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [
        1 => ['id' => 1, 'name' => 'Wireless Headphones', 'price' => 2999, 'img' => 'https://picsum.photos/seed/tech1/300/200'],
        2 => ['id' => 2, 'name' => 'Smart Watch', 'price' => 4500, 'img' => 'https://picsum.photos/seed/tech2/300/200'],
        3 => ['id' => 3, 'name' => 'Running Shoes', 'price' => 1800, 'img' => 'https://picsum.photos/seed/shoe1/300/200'],
        4 => ['id' => 4, 'name' => 'Denim Jacket', 'price' => 2200, 'img' => 'https://picsum.photos/seed/cloth1/300/200'],
        5 => ['id' => 5, 'name' => 'Gaming Mouse', 'price' => 1200, 'img' => 'https://picsum.photos/seed/tech3/300/200'],
        6 => ['id' => 6, 'name' => 'Backpack', 'price' => 1500, 'img' => 'https://picsum.photos/seed/bag1/300/200']
    ];
}

// Default Page
 $page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce App (PHP Version)</title>
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- TUMHARI STYLE.CSS FILE KA LINK -->
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

    <!-- NAVBAR -->
    <header>
        <nav>
<a href="?page=home" class="logo">ShopKart</a>

<ul class="nav-links">

<li>
<a href="?page=home" class="nav-btn <?php echo $page == 'home' ? 'active' : ''; ?>">
<i class="fas fa-home"></i> <span>Home</span>
</a>
</li>

<li>
<a href="?page=cart" class="nav-btn <?php echo $page == 'cart' ? 'active' : ''; ?>">
<i class="fas fa-shopping-cart"></i> <span>Cart</span>
<span id="cart-badge" class="badge">0</span>
</a>
</li>

<li>
<a href="?page=wishlist" class="nav-btn <?php echo $page == 'wishlist' ? 'active' : ''; ?>">
<i class="fas fa-heart"></i> <span>Wishlist</span>
<span id="wish-badge" class="badge">0</span>
</a>
</li>

<li>
<a href="?page=profile" class="nav-btn <?php echo $page == 'profile' ? 'active' : ''; ?>">
<i class="fas fa-user"></i> <span>Profile</span>
</a>
</li>

</ul>
</nav>
    </header>

    <main>
        <!-- 1. PRODUCT SECTION (HOME) -->
        <section id="home-section" class="section <?php echo $page == 'home' ? 'active' : ''; ?>">
            <h2 style="margin-bottom: 20px;">Latest Products</h2>
            <div class="product-grid" id="product-list">
                <!-- JS se products yahan inject honge -->
                <p>Loading products...</p>
            </div>
        </section>

        <!-- 2. CART SECTION -->
        <section id="cart-section" class="section <?php echo $page == 'cart' ? 'active' : ''; ?>">
            <h2 style="margin-bottom: 20px;">My Cart</h2>
            <div class="cart-container">
                <div id="cart-content">
                    <!-- Cart items yahan aayenge -->
                    <p>Loading cart...</p>
                </div>
            </div>
        </section>

        <!-- 3. WISHLIST SECTION -->
        <section id="wishlist-section" class="section <?php echo $page == 'wishlist' ? 'active' : ''; ?>">
            <h2 style="margin-bottom: 20px;">My Wishlist</h2>
            <div class="wishlist-container">
                <div id="wishlist-content">
                    <!-- Wishlist items yahan aayenge -->
                    <p>Loading wishlist...</p>
                </div>
            </div>
        </section>

        <!-- 4. PROFILE SECTION -->
        <section id="profile-section" class="section <?php echo $page == 'profile' ? 'active' : ''; ?>">
            <div class="profile-header">
                <img src="https://picsum.photos/seed/user1/200/200" alt="Avatar" class="avatar">
                <div>
                    <h2 id="profile-name-display">Guest User</h2>
                    <p id="profile-email-display" style="color: var(--secondary-color);">guest@example.com</p>
                </div>
            </div>

            <div class="profile-form">
                <h3>Edit Profile</h3>
                <form id="profile-form" onsubmit="app.saveProfile(event)">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="input-name" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" id="input-email" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea id="input-address" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </section>
    </main>

    <!-- Toast Notification Element -->
    <div id="toast">Message here</div>

    <!-- SCRIPT LINK -->
    <!-- Yahan hum apni script.js file load kar rahe hain -->
    
<script src="script.js"></script>
</body>
</html>