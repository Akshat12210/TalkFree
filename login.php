<?php
if (isset($_POST['submit'])) {
    session_start();
    include 'connection.php';
    //  include 'function.php';

    $success = "";
    

    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo '<script>alert("Please enter all the details first")</script>';
        echo '<script>window.location.href = "index.php"</script>';
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $email = mysqli_escape_string($conn, filter_var(strip_tags($email), FILTER_SANITIZE_STRIPPED));
        $password = mysqli_escape_string($conn, filter_var(strip_tags($password), FILTER_SANITIZE_STRIPPED));

        $hash_password = hash('sha256', $password);

        $sql = "SELECT * FROM users WHERE Email='$email' AND Password='$hash_password'";

        $result = mysqli_query($conn, $sql) or die("Your query is not right");

        $row = mysqli_fetch_array($result);

        $count = mysqli_num_rows($result);
       
        if ($count == 1) {
            if ($row['Active'] == 0) {
                
                echo '<script>alert("Please activate your Account first")</script>';
                echo '<script>window.location.href = "index.php"</script>';
            } else {
                $_SESSION['email'] = $email;

                if (isset($_POST["rememberme"])) {
                    setcookie("email", $_POST["email"], time() + (10 * 365 * 24 * 60 * 60));
                    setcookie("password", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
                    //header('Location:test.php');
                    if($row['Category']==0) header('Location:counsellordash.php');
                    else header('Location:userdash.php');
                } else {
                   // header('Location:test.php');
                     if($row['Category']==0) header('Location:counsellordash.php');
                     else header('Location:userdash.php');
                    if (isset($_COOKIE["email"])) {
                        setcookie("email", "");}
                    if (isset($_COOKIE["password"])) {
                        setcookie("password", "");}
                    
                    // if($_SESSION['val']==0) header('Location:counsellordash.html');
                    // else header('Location:userdash.html');
                }
            }
        }
        if ($count == 0) {
            echo '<script>alert("You have entered wrong email or password")</script>';
            echo '<script src="sw.js"></script>';
            echo '<script> swal("Wrong Credentials", "You have entered wrong email or password", "error","Try Again");</script>';
            echo '<script>window.location.href = "index.php"</script>';
           
        //     echo " 
        //     <script src='sw.js'></script>;
        //      <script> swal({
        //                     title: 'Wrong Credentials',
        //                     text: 'You have entered wrong email or password',
        //                     icon: 'error',
        //                     button: 'Try Again',
        //                 });</script>
        //                 <script>
        //   window.location.href = 'signup.php';
        //          </script>";

        }
    }
}
?>

