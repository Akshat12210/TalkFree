<?php
session_start();

    require_once 'vendor/autoload.php';
    include 'connection.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    $api=$_ENV['api_mailjet'];
    $secret=$_ENV['secret_mailjet'];


    
    $var=$_POST['category'];
    $e="";
if($var==="random"){
    $sql1 = "SELECT Email FROM counsellor
    ORDER BY RAND()
    LIMIT 1";
$result1 = mysqli_query($conn, $sql1);
// print_r($result1);
$row = mysqli_fetch_assoc($result1);

$e = $row['Email'];
}
else{
    $e=$var;
}
$sql2 = "SELECT Name FROM users WHERE Email='$e'";
$result2 = mysqli_query($conn, $sql2);
// print_r($result1);
$row2 = mysqli_fetch_assoc($result2);
$name_counsellor = $row2['Name'];
$email = $_SESSION['email'];

$sql3 = "SELECT Name FROM users WHERE Email='$email'";
$result3 = mysqli_query($conn, $sql3);
// print_r($result1);
$row3 = mysqli_fetch_assoc($result3);
$Name = $row3['Name'];



$date = $_POST['date'];
$time = $_POST['time'];
$value = $_POST['remember'];
$desc = $_POST['desc'];

$current_datetime = date('Y-m-d H:i');
$datetime = $date . " " . $time;
$send_date = date("Y-m-d H:i", strtotime($datetime));

if (strtotime($current_datetime) > strtotime($send_date)) {
    echo '<script>alert("Please select correct time.")</script>';
    header('location:error.html');
}

$sql = "INSERT INTO counselling.appointment (Counselle_Email,Counsellor_Email,Date,Time,Way,Description) VALUES('$email','$e','$date','$time','$value','$desc')";
$result = mysqli_query($conn, $sql);
if ($result) {

    echo '<script>alert("Appointment Booked \nPlease check your email for more details.")</script>';
    echo '<script>window.location.href = "userdash.php"</script>';
}

include 'meeting.php';
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "talkfreecounselling@sidharthv.me",
                'Name' => "Talk Free",
            ],
            'To' => [
                [
                    'Email' => $email,
                    'Name' => $Name,
                ],
            ],
            'Subject' => "Meeting Details",
            'HTMLPart' => "<h3>Dear User, Your meeting is scheduled with $name_counsellor</h3><br />These are the details!<br><br>
            $link.<br>   $pass <br><br>
            Thank You Have a nice day 🙂<br>
            <b><i><u>TalkFree</u></i></b> ",
        ],
        [
            'From' => [
                'Email' => "talkfreecounselling@sidharthv.me",
                'Name' => "Talk Free",
            ],
            'To' => [
                [
                    'Email' => $e,
                    'Name' => "Counsellor",
                ],
            ],
            'Subject' => "Meeting Details",
            'HTMLPart' => "<h3>Dear User, Your meeting is scheduled with $Name</h3><br />These are the details!<br><br>
            $link.<br>   $pass <br><br>
            Thank You Have a nice day 🙂<br>
            <b><i><u>TalkFree</u></i></b> ",
        ],
    ],
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json')
);
curl_setopt($ch, CURLOPT_USERPWD, "$api:$secret");
$server_output = curl_exec($ch);
curl_close($ch);

$response = json_decode($server_output);
?>