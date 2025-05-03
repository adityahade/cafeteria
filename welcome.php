<?php
session_start();

$menu = [
    "Drinks" => [
        "Kitchen Tea" => 10,
        "Cold Coffee" => 18, 
        "Coke" => 21,
        "Lassi" => 18
    ],
    "Snacks" => [
        "Aloo Patties" => 16,
        "Paneer Patties" => 25,
        "Burger" => 30,
        "Chips" => 19
    ],
    "Meals" => [
        "Bread Omelette" => 22,
        "Boiled Egg" => 9,
        "Pizza" => 80,
        "Pasta" => 25
        
    ]
];

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle Add to Cart
if (isset($_POST['item'], $_POST['price'], $_POST['quantity'])) {
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
    <style>

        .menu-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }
        .menu-section {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 10px 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            width: 300px;
        }
        .menu-section h2 {
            background-color:rgb(164, 239, 232);
            color: black;
            margin: -20px -20px 20px -20px;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            text-align: center;
        }
        .item {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .item form {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        button {
            background-color:rgb(164, 239, 232);
            color: black;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover {
            background-color:rgb(164, 239, 232);
        }
        .quantity-display {
            min-width: 25px;
            text-align: center;
            font-weight: bold;
        }
        .cart-section {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .cart-section h2 {

            text-align: center;
            margin-bottom: 20px;
        }
        .cart-item {
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
            text-align: right;
        }
    </style>
    <script>
        function updateQuantityValue(slider, displayId) {
            document.getElementById(displayId).innerText = slider.value;
        }
    </script>
</head>
<body>

    <h1> Welcome to Our Cafeteria </h1>

    <div class="menu-container">
        <?php foreach ($menu as $category => $items): ?>
            <div class="menu-section">
                <h2><?php echo htmlspecialchars($category); ?></h2>
                <?php foreach ($items as $item => $price): 
                    $id = md5($item); // unique ID for quantity display
                ?>
                    <div class="item">
                        <div>
                            <?php echo htmlspecialchars($item); ?> - ₹<?php echo number_format($price, 2); ?>
                        </div>
                        <form method="post">
                            <input type="hidden" name="item" value="<?php echo htmlspecialchars($item); ?>">
                            <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
                            <input type="range" name="quantity" min="1" max="10" value="1" onchange="updateQuantityValue(this, 'qty_<?php echo $id; ?>')">
                            <span class="quantity-display" id="qty_<?php echo $id; ?>">1</span>
                            <button type="submit">Add</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cart-section">
    <h2>🛒 Your Cart</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
        <?php 
            $total = 0;
            foreach ($_SESSION['cart'] as $cartItem): 
                $subtotal = $cartItem['price'] * $cartItem['quantity'];
                $total += $subtotal;
        ?>
            <div class="cart-item">
                <span><?php echo htmlspecialchars($cartItem['item']); ?> x <?php echo $cartItem['quantity']; ?></span>
                <span>₹<?php echo number_format($subtotal); ?></span>
            </div>
        <?php endforeach; ?>
        <div class="total">Total: ₹<?php echo number_format($total, 2); ?></div>

        <form method="post" style="text-align:center; margin-top:20px;">
            <button type="submit" name="clear">Clear Cart</button>
        </form>

        <!-- New Checkout Button -->
        <form action="checkout.php" method="post" style="text-align:center; margin-top:10px;">
            <button type="submit" name="checkout">Proceed to Checkout</button>
        </form>

    <?php else: ?>
        <p style="text-align:center;">Your cart is empty.</p>
    <?php endif; ?>
</div>


</body>
</html>
