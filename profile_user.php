<?php 

session_start(); 
include 'connection.php';
 $email = $_SESSION['email'];
 $sql = "SELECT * FROM users WHERE Email='$email'";

     $result = mysqli_query($conn, $sql) or die("Your query is not right");

     $row = mysqli_fetch_array($result);

     $sql1 = "SELECT * from counselle WHERE Email='$email'";
     $result1 = mysqli_query($conn, $sql1);
     $row1=mysqli_fetch_array($result1);

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="profileuser.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="sidebar">
      <div class="logo-details">
      <i class='bx bx-message-square-detail'></i>
        <span class="logo_name">TalkFree</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="userdash.php" >
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <!-- <li>
          <a href="#">
            <i class='bx bx-box' ></i>
            <span class="links_name">Product</span>
          </a>
        </li> -->
        <li>
          <a href="notes.php">
            <i class='bx bx-note style='color:rgba(0,0,0,0)'></i>
            <span class="links_name">Self Notes</span>
          </a>
        </li>
        <li>
          <a href="posts.php">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Posts</span>
          </a>
        </li>
        <li>
          <a href="profile_user.php" class="active" >
            <i class="bx bx-user"></i>
            <span class="links_name">Update Profile</span>
          </a>
        </li>
        <!-- <li>
          <a href="#">
            <i class="bx bx-message"></i>
            <span class="links_name">Notification</span>
          </a>
        </li> -->

        <li class="log_out">
          <a href="logout.php">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
    </div>

    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Update Profile</span>
        </div>
        <!-- <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div> -->
        <div class="profile-details">
          <!--<img src="images/profile.jpg" alt="">-->
          <span class="admin_name"><?php echo $row['UserName']; ?></span>
          
        </div>
      </nav>


      
      <div class="home-content">
        <div class="personal">
          <h1 class="head">Personal Info</h1>
<div class="entries">
          <label class="fullname" for="full_name">Full Name:</label>
          <input
          class="fullname-text"
            type="text"
            id="fullname"
            name="fullname"
            value="<?php echo $row['Name']; ?>"
            readonly
          />

          <label class="email" for="Email">Email:</label>
          <input
          class="email-text"
            type="text"
            id="email"
            name="email"
            value="<?php echo $row['Email']; ?>"
            readonly
          />
<br><br>
          <label class="gender" for="gender">Gender:</label>
          <input class="gender-text" type="text" id="gender" name="gender" value="<?php echo $row['Gender']; ?>" readonly />
          
          <form action="updateDetails.php" method="POST">
            <div class="date">
          <label class="dob" for="dob">DOB:</label>
          <input
          class="dob-text"
            type="date"
            id="dob"
            name="dob"
            value="<?php echo $row1['DOB']; ?>"
            <?php 
              if($row1['DOB']!='0000-00-00') echo "readonly";
            ?>
          />
</div>
          <br><br>
          <label class="desc"for="">About:</label>
          <br>
          <textarea class="desc-text" id="about" name="about" rows="4" cols="50">
          <?php echo $row1['About']; ?>
</textarea>
<br>
<a href="changePassword.php"><button class="chn-pass" name="change" type="button">Change Passward</button></a>
<a href="deleteaccount.php"><button class="delete-acc" type="button">Delete Account</button></a>
          <a href="updateDetails.php"><button class="submit"type="submit">Update</button></a>
</form>
        </div>
        </div>
      </div>

      <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function () {
          sidebar.classList.toggle("active");
          if (sidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
          } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        };
      </script>
    </section>
  </body>
</html>
