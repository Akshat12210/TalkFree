<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
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
$mail->Username = 'modaniakshat@gmail.com';                 // SMTP username
$mail->Password = 'data@2002';                           // SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$to=$_SESSION['email'];
$mail->setFrom('modaniakshat@gmail.com', 'Mailer');
$mail->addAddress($to);     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Account Confirmation Message';
$mail->Body = "
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------<br><br><br><br>
Username:" .$_SESSION['username']."<br>
Password:" .$_SESSION['password']."<br><br><br><br>
------------------------
 
Please click this link to activate your account:----------------------<br><br><br><br>
http://localhost/talkfree/verify.php?email=".$_SESSION['email']."&activation_code=".$_SESSION['activation_code']."  "; // Our message above including the link

$mail->send();

// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
}
 
?>



