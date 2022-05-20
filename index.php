<?php
session_start();
$error = "";
$val = 0;
if (isset($_POST['submit'])) {
   include 'connection.php';
    if (empty($_POST['name']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['gender']) || empty($_POST['category'])) {
        $error = "Please enter all the details first";
    }

    $name = mysqli_escape_string($conn, filter_var(strip_tags($_POST['name']), FILTER_SANITIZE_STRIPPED));
    $username = mysqli_escape_string($conn, filter_var(strip_tags($_POST['username']), FILTER_SANITIZE_STRIPPED));
    $password = mysqli_escape_string($conn, filter_var(strip_tags($_POST['password']), FILTER_SANITIZE_STRIPPED));
    $email = mysqli_escape_string($conn, filter_var(strip_tags($_POST['email']), FILTER_VALIDATE_EMAIL));
    $gender = mysqli_escape_string($conn, filter_var(strip_tags($_POST['gender']), FILTER_SANITIZE_STRIPPED));
    $category = mysqli_escape_string($conn, filter_var(strip_tags($_POST['category']), FILTER_SANITIZE_STRIPPED));

    if ($category === "Counselor") {
      $val = 0;
      $sql2="INSERT INTO counsellor (Name,UserName,Email,Gender) VALUES('$name','$username','$email','$gender')";
      
    } else {
      $val  = 1;
      $sql2="INSERT INTO counselle (Name,UserName,Email,Gender) VALUES('$name','$username','$email','$gender')";
      
    }

    $hash_password = hash('sha256', $password);

    $activation_code = hash('sha256', rand(0, 1000));

    $sql = "SELECT UserName FROM counselling.users WHERE UserName='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $error = "UserName already Exists";
    }
    $sql = "SELECT Email FROM counselling.users WHERE Email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $error .= "And Email already exists";
    }
    
    if (empty($error)) {
        $sql = "INSERT INTO counselling.users (Name,UserName,Email,Activation_Code,Password,Gender,Category) VALUES('$name','$username','$email','$activation_code','$hash_password','$gender','$val')";
        $result = mysqli_query($conn, $sql);
        $result1 = mysqli_query($conn, $sql2);
        if ($result) {
            $_SESSION['name']=$name;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['hash_password'] = $hash_password;
            $_SESSION['activation_code'] = $activation_code;
            $_SESSION['gender'] = $gender;
            $_SESSION['val'] = $val;

            include 'activateemail.php';
            echo '<script>alert("Please check your email to activate your account")</script>';
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>TalkFree</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script type="text/javascript">
        window.history.forward();
    </script> -->
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
          <form action="login.php" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" value="<?php if (isset($_COOKIE['email'])) {echo $_COOKIE['email'];}?>"placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" value="<?php if (isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>" placeholder="Enter your password" required>
              </div>
              <div class="text"><a href="forgotpassword.php">Forgot password?</a></div>

              <div class="remember">

        <input class="remember_me" type="checkbox"  checked name="rememberme"> Remember me

      </div>
              <div class="button input-box">
                <input type="submit" name="submit" value="Login">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Sigup now</label></div>
              
            </div>
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Signup</div>
        <form action="index.php" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Enter your name" required>
              </div>
              <div class="input-box">
                  <i class="fas fa-envelope"></i>
                  <input type="text" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                  <i class="fas fa-user"></i>
                  <input type="text" name="username" placeholder="Enter a username" required>
                </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Enter a password" required>
              </div>
              <div class="check">
                <label class="Gender" for="head">Gender : </label>
          <input class="male-radio" type="radio" id="age1" name="gender" value="male">
          <label class="male" for="age1">Male</label>

          <input class="female-radio" type="radio" id="age1" name="gender" value="female">
          <label class="female" for="age1">Female</label>

          <input class="other-radio" type="radio" id="age1" name="gender" value="other">
          <label class="other" for="age1">Other</label>
          </div>

          <div class="select-user">
            <label class="User-select" for="User">Who are you? :</label>
  <select name="category" id="select-user">

    <option value="Select">-Select-</option>
    <option value="Counselor" >Counselor</option>
    <option value="Counselee" >Counselee</option>

  </select>
          </div>
              <div class="button input-box">
                <input type="submit" name="submit" value="SignUp">
              </div>

              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
    <!-- <span class="text"><?php if (isset($message)) {echo $message;}?></span>
	<span class="text"><?php if (isset($error)) {echo $error;}?></span> -->
  </div>
</body>
</html>



