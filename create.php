<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $sql = "select * from login where username='$username'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if ($count==1){
            echo'<script>
            window.location.href = "register.php";
            alert("Username already exists")
            </script>';
        }
        else{
            $sql = "INSERT INTO users (username, password) VALUES ('$username','$password')";

            if (mysqli_query($conn, $sql)) {
                echo "New record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
  
        }
    }
?>