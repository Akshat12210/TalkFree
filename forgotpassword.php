<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$account_mail=$_ENV['mail'];
$account_pass=$_ENV['pass'];

$success = "";
$error = "";
if (isset($_POST['submit'])) {
    if (isset($_POST['email'])) {
        include 'connection.php';
        $email = mysqli_escape_string($conn, filter_var(strip_tags($_POST['email']), FILTER_VALIDATE_EMAIL));
        $sql = "SELECT Email FROM users WHERE Email='$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            $error = "This email address doesn't exists";
        } else {
            $code = rand(999, 999999);
            $password_code = $email . $code;
            $hash_password = hash('sha256', $password_code);

            require 'PHPMailer/Exception.php';
            require 'PHPMailer/PHPMailer.php';
            require 'PHPMailer/SMTP.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = $account_mail; // SMTP username
            $mail->Password = $account_pass; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to
            $to = $_POST['email'];
            $mail->setFrom($account_mail, 'TalkFree');
            $mail->addAddress($to); // Add a recipient

            $mail->isHTML(true); // Set email format to HTML

            $mail->Subject = 'New Password for Your Account';
            $mail->Body = "

		<br>
		This is the New temporary Password for you, Log in with that and change it any time.<br><br><br><br>
		<b>$password_code</b><br><br><br><br>

		Please click this link to Login into your Account ------------------<br>

		<a href='http://localhost/talkfree/index.php'>Click here to Log in to your Account</a> <br><br>
        Thank You Have a nice day 🙂<br>
        <b><i><u>TalkFree</u></i></b>";

            if ($mail->send()) {
                $sql = "UPDATE users SET Password='$hash_password' WHERE Email='$email'";
                $result = mysqli_query($conn, $sql);
                $success = "We have sent password to your email";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="style2.css"/>
<title>Login System</title>
</head>
<body>
	<a href="index.php"><button class="loginbutton" type="submit"><b>SignIn</b></button></a>
	<div id="section">
		<form action="" method="post">
		<div class="title">Forgot Password</div>
		<form method="post" action="forgotpassword.php">
		<input type="email" required name="email" placeholder="Enter your email"/>
		<button type="submit" class="textbtn" name="submit"><b>Submit</b></button><br><br><br><br>
		<span><?php if (isset($success)) {echo $success;}?></span>
		<span><?php if (isset($error)) {echo $error;}?></span>
		</form>
	</div>
</body>
</html>