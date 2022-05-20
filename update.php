<?php
session_start();
include 'connection.php';

$email=$_SESSION['email'];
    if (empty($_POST['desc']) && empty($_POST['dob'])) {
        echo '<script>alert("Please enter all the details first")</script>';
    }

    if (isset($_POST['about'])) {
       $about = mysqli_escape_string($conn, filter_var(strip_tags($_POST['about']), FILTER_SANITIZE_STRIPPED));
    
    }
    
    if (isset($_POST['dob'])) {
        $date = date('Y-m-d', strtotime(mysqli_escape_string($conn, filter_var(strip_tags($_POST['dob']), FILTER_SANITIZE_STRIPPED))));
        
    }

    $sql = "UPDATE counsellor SET DOB='$date', About='$about' WHERE Email='$email'";
$result = mysqli_query($conn, $sql);

header('Location:profile_counsellor.php');

?>