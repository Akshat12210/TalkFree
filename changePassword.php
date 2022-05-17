<?php
session_start();
$error="";
if(isset($_POST['submit']))
{
include('connection.php');

if($_POST['newpassword']==$_POST['confirmpassword'])
{

$email=$_SESSION['email'];

$confirmpassword=mysqli_escape_string($conn,filter_var(strip_tags($_POST['confirmpassword']),FILTER_SANITIZE_STRIPPED));


$hash_password = hash('sha256', $confirmpassword);

$sql="UPDATE users SET Password='$hash_password' WHERE Email='$email'";

$result=mysqli_query($conn,$sql);


}
else{
	$error = "The Passwords doesn't match each other";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="style2.css"/>
<title>Login System in Php and Mysql</title>
</head>
<body>
	<?php if(isset($result))
	{
		echo '<script>alert("Your Password has been changed successfully")</script>';
        echo '<script>window.location.href = "index.php"</script>';
        include 'logout.php';
	}
	?>
	<a href="logout.php"><button class="loginbutton" type="submit">Logout</button></a>
	<div id="section">
		<form method="post" action="">
		<h1>Edit Password</h1>
		<input type="password" name="newpassword" placeholder="newpassword"/>
		<input type="password" name="confirmpassword" placeholder="confirmpassword"/>
		<a href="resetpassword.php"><button type="submit" name="submit">Change Password</button></a><br><br><br><br>
		<span style="color:white;"><?php if(isset($error)){echo $error;}?></span>
		</form>
	</div>
</body>
</html>