<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$account_mail=$_ENV['mail'];
$account_pass=$_ENV['pass'];

if(!isset($_SESSION)) 
{ 
  session_start(); 
}
require ('PHPMailer/Exception.php');
require ('PHPMailer/PHPMailer.php');
require ('PHPMailer/SMTP.php');



$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $account_mail;                 // SMTP username
$mail->Password = $account_pass;                           // SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$to=$_SESSION['email'];
$mail->setFrom($account_mail, 'TalkFree');
$mail->addAddress($to);     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Account Confirmation Message';
$mail->Body = "
 
<h2>Thanks for signing up!</h2>
<h3>Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.</h3>
 
------------------------<br><br><br><br>
<b>Username:" .$_SESSION['username']."</b><br>
<b>Password:" .$_SESSION['password']."</b><br><br><br><br>
------------------------
 
<b><i>Please click this link to activate your account:</i></b>----------------------<br><br><br><br>
http://localhost/talkfree/verify.php?email=".$_SESSION['email']."&activation_code=".$_SESSION['activation_code']."  "; // Our message above including the link



// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
}
 
?>



