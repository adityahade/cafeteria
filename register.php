<?php
include ("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id ="form">
        <h1>Registeration Form</h1>
        <form name="form" action="create.php" method="POST">
            <label>Username:</label>
            <input type ="text" id="user" name="user"><br></br>
            <label>Password:</label>
            <input type ="password" id="pass" name="pass"><br></br>
            <input type="submit" id="btn" value="Create Account" name="submit"/>

    </form>
</div>
    <a href="index.php" class="button-class">
    Sign In</a>
</body>
</html>