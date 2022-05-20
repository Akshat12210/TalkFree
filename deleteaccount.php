<?php

session_start();
if (count($_SESSION) == 0) {
	header('Location:error.html');
}
include('connection.php');

$email=$_SESSION['email'];


$sql="DELETE FROM users WHERE Email='$email'";

$result=mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Delete Account</title>
<link rel="stylesheet" type="text/css" href="style2.css"/>
<body>
	<div class="verification">
		<?php if($result){
			
			echo "Your account has been deleted successfully";
			
		}  ?>
	</div>
</body>
</head>
</html>