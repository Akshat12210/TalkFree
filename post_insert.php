<?php
session_start();
include 'connection.php';

$email = $_SESSION['email'];
$sql1 = "SELECT * FROM users WHERE Email='$email'";

$result1 = mysqli_query($conn, $sql1) or die("Your query is not right");

$row1 = mysqli_fetch_array($result1);
$username = $row1['UserName'];

if (empty($_POST['title']) || empty($_POST['description'])) {
    echo '<script>alert("Please enter all the details first")</script>';
} 
else {
    if (isset($_POST['description'])) {
        $desc = mysqli_escape_string($conn, filter_var(strip_tags($_POST['description']), FILTER_SANITIZE_STRIPPED));

    }

    if (isset($_POST['title'])) {
        $title = mysqli_escape_string($conn, filter_var(strip_tags($_POST['title']), FILTER_SANITIZE_STRIPPED));

    }

    $sql = "INSERT INTO counselling.posts (Email,UserName,Title,Description) VALUES  ('$email','$username','$title','$desc')";
   
      
    $result = mysqli_query($conn, $sql);

    header('Location:counsellordash.php');
}
?>
