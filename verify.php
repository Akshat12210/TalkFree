<?php
session_start();
include('connection.php');
             
	if(isset($_GET['email']) && isset($_GET['activation_code']) ){
	$success_message="";
    $error_message1="";
    $error_message2="";	
    $email = mysqli_escape_string($conn,$_GET['email']); // Set email variable
    $activation_code = mysqli_escape_string($conn,$_GET['activation_code']); // Set hash variable
                 
    $search = mysqli_query($conn,"SELECT Email, Activation_Code, Active FROM users WHERE email='".$email."' AND Activation_Code='".$activation_code."' AND Active='0'") or die(mysql_error()); 
    $match  = mysqli_num_rows($search);
                 
    if($match > 0){
        // We have a match, activate the account
        mysqli_query($conn,"UPDATE users SET Active='1' WHERE email='".$email."' AND Activation_Code='".$activation_code."' AND Active='0'") or die(mysql_error());
        $success_message='Your account has been activated, you can now login.';
    }else{
        // No match -> invalid url or account has already been activated.
        $error_message1= 'The url is either invalid or you already have activated your account.';
    }
}                 
else{
    // Invalid approach
    $error_message2= 'Invalid approach, please use the link that has been send to your email.';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Verification Page</title>
<link rel="stylesheet" type="text/css" href="style2.css"/>
<body>
	<a href="index.php"><button class="loginbutton" type="submit">SignIn</button></a>
	<div class="verification"><?php if(isset($success_message))
	
	{echo $success_message;}
	
	if(isset($error_message1))
	{
		echo $error_message1;
	}
	if(isset($error_message2))
	{
		echo $error_message2;
	}
	?></div>
</body>
</head>
</html>