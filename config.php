<?php
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail=$_ENV['mail'];
define('API_KEY',$_ENV['api_zoom']);
define('API_SECRET',$_ENV['secret_zoom']);
define('EMAIL_ID',$mail);
?>