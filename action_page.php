<?php 
    session_start();
    include 'connection.php';

    $sql1="SELECT Email FROM counsellor
    ORDER BY RAND()
    LIMIT 1";
    $result1=mysqli_query($conn,$sql1);
   // print_r($result1);
    $row = mysqli_fetch_assoc($result1);
     
    $e= $row['Email'];
    $email=$_SESSION['email'];
    // $userName=$_SESSION['username'];
    //$Name=$_SESSION['name'];
    // $gender=$_SESSION['gender'];
    // $val=$_SESSION['val'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $value = $_POST['remember'];
    $desc = $_POST['desc'];


    //$sql2="SELECT "
    $sql = "INSERT INTO counselling.appointment (Counselle_Email,Counsellor_Email,Date,Time,Way,Description) VALUES('$email','$e','$date','$time','$value','$desc')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo '<script>alert("Appointment Booked \nPlease check your email for more details.")</script>';
        echo '<script>window.location.href = "userdash.php"</script>';
    }

include('meeting.php');
$body = [
    'Messages' => [
        [
        'From' => [
            'Email' => "talkfreecounselling@sidharthv.me",
            'Name' => "Talk Free"
        ],
        'To' => [
            [
                'Email' => $email,
                'Name' => $Name
            ],
            [
                'Email' => $e,
                'Name' => "Counsellor"
            ]
        ],
        'Subject' => "Meeting Details.",
        'HTMLPart' => "<h3>Dear User, Your meeting is scheduled!</h3><br />these are the details!
            $link.   $pass <br><br>
            Thank You Have a nice day 🙂<br>
            <b><i><u>TalkFree</u></i></b> "
        ]
    ]
];
  
$ch = curl_init();
  
curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json')
);
curl_setopt($ch, CURLOPT_USERPWD, "ec5baa54f93f4112d9aa04605c365677:507ea0235609140a2ae8eae31ccdde34");
$server_output = curl_exec($ch);
curl_close ($ch);
  
$response = json_decode($server_output);
// if ($response->Messages[0]->Status == 'success') {
//     //echo "Email sent successfully.";
//     echo '<script>alert("Email sent successfully.")</script>';
//         echo '<script>window.location.href = "userdash.php"</script>';
// }
    // echo $email;
    // echo "<br>";
    // echo $userName;
    // echo "<br>";
    // echo $Name;
    // echo "<br>";
    // echo $gender;
    // echo "<br>";
    // echo $val;
    // echo "<br>";
    // echo $birthday;
    // echo "<br>";
    // echo $appt;
    // echo "<br>";
    // echo $value;
    // echo "<br>";
    // echo $desc;
    // echo "<br>";
    
 
?>