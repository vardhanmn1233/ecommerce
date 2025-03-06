<?php
session_start();
include 'includes/db.php'; // Ensure db.php uses PDO for the connection

// Fetch products from the database
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MobiClicks - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
 * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* Body Styling */
body {
    background: #f5f5f5; /* Light gray background */
    color: #333;
}

/* Navigation Bar */
nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #333; /* Light black */
    padding: 20px 20px;
    position: fixed;
    width: 100vw;
    left: 0;
    top: 0;
    z-index: 1000;
}

/* Left Section - MobiClicks & Featured Mobiles */
.nav-left {
    display: flex;
    align-items: center;
    font-size: 22px;
    font-weight: bold;
    color: white;
}

.nav-left span {
    margin-left: 10px;
    font-size: 20px;
    font-weight: normal;
}

/* Center Section - Welcome to Store */
.nav-center {
    font-size: 18px;
    font-weight: bold;
    color: white;
    text-align: center;
    flex-grow: 1;
    display: flex;
    justify-content: center; /* Ensure text is centered */
}

/* Right Section - Login, Register, Cart, Logout */
.nav-right {
    display: flex;
    align-items: center;
    gap: 10px; /* Add space between icons */
}

/* Navigation Links */
.nav-right a, .nav-right form {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 20px;
    padding: 8px 12px;
    display: flex;
    align-items: center;
}

/* Cart Icon */
.cart-link {
    display: flex;
    align-items: center;
}

.cart-icon {
    width: 20px;
    height: 20px;
    margin-right: 5px;
}

/* Logout Button */
.logout-button {
    background: #e74c3c; /* Red */
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 20px;
    margin-left: 10px;
}

.logout-button:hover {
    background: darkred;
}

/* Main Container */
.container {
    max-width: 1200px;
    margin: 80px auto 20px;
    padding: 20px;
    text-align: center;
}

/* Products Section */
.products {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.product {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    width: 250px;
    text-align: center;
    transition: transform 0.3s ease;
}

.product:hover {
    transform: scale(1.05);
}

.product img {
    width: 100%;
    border-radius: 10px;
}

.product h3 {
    margin: 10px 0;
    font-size: 18px;
}

.product p {
    font-size: 16px;
    color: #2c3e50;
    font-weight: bold;
}

/* Buttons */
.btn {
    background: #2c3e50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background: #1a252f;
}

/* Footer */
footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
}

  </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to our Store</h1>
        <h2>Featured Mobiles</h2>
        
        <nav>
    <div class="nav-left">
        MobiClicks <span>Featured Mobiles</span>
    </div>
    <div class="nav-right">
        <a href="pages/login.php">Login</a>
        <a href="pages/register.php">Register</a>
        <a href="pages/cart.php" class="cart-link">
            <img src="images/cart.jpeg" alt="Cart" class="cart-icon"> Cart
        </a>
        <form method="POST" style="display: inline;">
            <button type="submit" name="logout" class="logout-button">Logout</button>
        </form>
    </div>
</nav>



        <div class="products">
            <?php if (empty($products)) : ?>
                <p class="text-center text-danger">No products available</p>
            <?php else : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="product">
                        <?php if (!empty($product['image'])) : ?>
                            <img src="images/<?= htmlspecialchars($product['image']); ?>" 
                                 alt="<?= htmlspecialchars($product['name']); ?>">
                        <?php endif; ?>
                        <h3><?= htmlspecialchars($product['name']); ?></h3>
                        <p><?= htmlspecialchars($product['description']); ?></p>
                        <p><strong>Price: $<?= number_format($product['price'], 2); ?></strong></p>
                        <form method="POST" action="pages/cart.php">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                            <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
