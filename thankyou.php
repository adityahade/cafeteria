<?php
include('connection.php');
session_start();

foreach ($_SESSION['cart'] as $cartItem):
    $stmt = $conn->prepare("INSERT INTO cart_items (item, price, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $cartItem['item'], $cartItem['price'], $cartItem['quantity']);

    if ($stmt->execute()) {
    } else {
        echo "Error: " . $stmt->error;
    }
endforeach;


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
        <h1>Thank You for Your Order!🎉</h1> 
        <p>We are preparing your food!</p>
        <a href="welcome.php">Order Again</a>
    </div>

</body>
</html>
