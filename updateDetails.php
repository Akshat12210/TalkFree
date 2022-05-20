<?php
session_start();
if (count($_SESSION) == 0) {
    header('Location:error.html');
  }
include 'connection.php';

$about = "";
$email=$_SESSION['email'];
if (isset($_POST['about'])) {
    $about = mysqli_escape_string($conn, filter_var(strip_tags($_POST['about']), FILTER_SANITIZE_STRIPPED));
}

if (isset($_POST['dob'])) {
    $date = date('Y-m-d', strtotime(mysqli_escape_string($conn, filter_var(strip_tags($_POST['dob']), FILTER_SANITIZE_STRIPPED))));
}



$sql = "UPDATE counselle SET DOB='$date', About='$about' WHERE Email='$email'";
$result = mysqli_query($conn, $sql);

header('Location:profile_user.php');

?>
