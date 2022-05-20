<?php
session_start();
include 'connection.php';
$id = $_GET['id'];
$sql3 = "UPDATE `appointment` SET Completed=1 WHERE ID='$id'";
$result3 = mysqli_query($conn, $sql3) or die("Your query is not right");
header("location:counsellordash.php");
?>