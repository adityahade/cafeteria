<?php
session_start();

// Clear cart after checkout
$_SESSION['cart'] = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You!</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="message">
        <h1>Thank You for Your Order! 🎉</h1>
        <p>We are preparing your food!</p>
        <a href="welcome.php">Order Again</a>
    </div>

</body>
</html>
