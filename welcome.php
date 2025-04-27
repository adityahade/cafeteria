<?php
// cafeteria_menu.php
session_start();

// Define menu items
$menu = [
    "Drinks" => [
        "Coffee" => 2.50,
        "Tea" => 2.00,
        "Smoothie" => 4.00,
        "Water" => 1.00
    ],
    "Snacks" => [
        "Sandwich" => 5.00,
        "Muffin" => 3.00,
        "Cookie" => 1.50,
        "Chips" => 2.00
    ],
    "Meals" => [
        "Burger" => 8.00,
        "Pizza Slice" => 4.50,
        "Pasta" => 7.00,
        "Salad" => 6.00
    ]
];

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle Add to Cart
if (isset($_POST['item']) && isset($_POST['price']) && isset($_POST['quantity'])) {
    $item = $_POST['item'];
    $price = (float)$_POST['price'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity > 0) {
        $_SESSION['cart'][] = [
            'item' => $item,
            'price' => $price,
            'quantity' => $quantity
        ];
    }
}

// Handle Clear Cart
if (isset($_POST['clear'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cafeteria Menu</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function updateQuantityValue(slider, displayId) {
            document.getElementById(displayId).innerText = slider.value;
        }
    </script>
</head>
<body>

    <h1>Welcome to Our Cafeteria!</h1>

    <?php foreach ($menu as $category => $items): ?>
        <div class="menu-section">
            <h2><?php echo htmlspecialchars($category); ?></h2>
            <?php foreach ($items as $item => $price): 
                $id = md5($item); // unique ID for quantity display
            ?>
                <div class="item">
                    <div><?php echo htmlspecialchars($item); ?> - $<?php echo number_format($price, 2); ?></div>
                    <form method="post">
                        <input type="hidden" name="item" value="<?php echo htmlspecialchars($item); ?>">
                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
                        <input type="range" name="quantity" min="1" max="10" value="1" onchange="updateQuantityValue(this, 'qty_<?php echo $id; ?>')">
                        <span class="quantity-display" id="qty_<?php echo $id; ?>">1</span>
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <div class="cart-section">
        <h2>Your Cart</h2>
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $cartItem): 
                    $subtotal = $cartItem['price'] * $cartItem['quantity'];
                    $total += $subtotal;
            ?>
                <div class="cart-item">
                    <?php echo htmlspecialchars($cartItem['item']); ?> x <?php echo $cartItem['quantity']; ?> - $<?php echo number_format($subtotal, 2); ?>
                </div>
            <?php endforeach; ?>
            <h3>Total: $<?php echo number_format($total, 2); ?></h3>
            <form method="post">
                <button type="submit" name="clear">Clear Cart</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

</body>
</html>
