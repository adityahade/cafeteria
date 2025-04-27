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
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            text-align: center;
            padding-top: 100px;
        }
        .message {
            background: #ffffff;
            padding: 40px;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .message h1 {
            color: #4CAF50;
        }
        .message a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .message a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="message">
        <h1>Thank You for Your Order! 🎉</h1>
        <p>We are preparing your food!</p>
        <a href="welcome.php">Order Again</a>
    </div>

</body>
</html>
