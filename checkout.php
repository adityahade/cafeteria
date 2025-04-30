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
    <link rel="stylesheet" type="text/css" href="style.css">
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
