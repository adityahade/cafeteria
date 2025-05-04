<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $sql = "select * from users where username='$username'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if ($count==1){
            echo'<script>
            window.location.href = "index.php";
            alert("Login failed .  username already exists")
        </script>';
        }
        else{
            $stmt = $conn->prepare("insert into users (username, password) VALUES ('$username','$password')");
            if ($stmt->execute()) {
                echo "New record inserted successfully!";
                header("Location:index.php");
            } else {
                echo "Error: " . $stmt->error;
            }

        }
    }
?>