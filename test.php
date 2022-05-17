<?php 
   session_start(); 
   include 'connection.php';
   $email = $_SESSION['email'];
    $sql = "SELECT * FROM users WHERE Email='$email'";

        $result = mysqli_query($conn, $sql) or die("Your query is not right");

        $row = mysqli_fetch_array($result);

        echo $row['Name'];

        echo "<br>";
        echo $row['Email'];
        echo "<br>";
        echo $row['UserName'];
        echo "<br>";
        echo $row['Category'];
        echo "<br>";
        echo $row['Gender'];
        
       
 ?>