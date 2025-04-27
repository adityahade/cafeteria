<?php
session_start();

// If no cart or cart is empty, redirect back
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: welcome.php");
    exit();
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $cartItem) {
    $total += $cartItem['price'] * $cartItem['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 20px;
        }
        .checkout-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .checkout-item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }
        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        .button-container a, .button-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .button-container a:hover, .button-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="checkout-container">
        <h1>Checkout</h1>

        <?php foreach ($_SESSION['cart'] as $cartItem): ?>
            <div class="checkout-item">
                <span><?php echo htmlspecialchars($cartItem['item']); ?> x <?php echo $cartItem['quantity']; ?></span>
                <span>$<?php echo number_format($cartItem['price'] * $cartItem['quantity'], 2); ?></span>
            </div>
        <?php endforeach; ?>

        <div class="total">
            Total: $<?php echo number_format($total, 2); ?>
        </div>

        <div class="button-container">
            <a href="welcome.php">Back to Menu</a>
            <form method="post" action="thankyou.php" style="display:inline;">
                <button type="submit" name="confirm">Confirm Order</button>
            </form>
        </div>
    </div>

</body>
</html>
