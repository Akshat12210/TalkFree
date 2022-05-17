<?php 

session_start(); 
include 'connection.php';
$link="";
$email = $_SESSION['email'];
 $sql = "SELECT * FROM users WHERE Email='$email'";

     $result = mysqli_query($conn, $sql) or die("Your query is not right");

     $row = mysqli_fetch_array($result);

     
     if($row['Category']==0)
     { 
       $link="profile_counsellor.php";
       $link2="counsellordash.php";
     }
     else {
       $link="profile_user.php";
       $link2="userdash.php";
     }

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="pages.css">
    <!-- Boxicons CDN Link -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <Title>Notes</Title>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
    <i class='bx bx-message-square-detail'></i>
      <span class="logo_name">TalkFree</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="<?php echo $link2 ?>">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        
        
        <li>
          <a href="notes.php" class="active">
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
          <a href="<?php echo $link ?>">
            <i class='bx bx-user' ></i>
            <span class="links_name">Update Profile</span>
          </a>
        </li>
        <!-- <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Notification</span>
          </a>
        </li> -->


        

        <li class="log_out">
          <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>




  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Notes</span>
      </div>
      <!-- <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div> -->
      <div class="profile-details">
        <!--<img src="images/profile.jpg" alt="">-->
        <span class="admin_name"><?php echo $row['UserName'] ?></span>
      </div>
    </nav>


     <div class="home-content">
<div class="popup-box">
      <div class="popup">
        <div class="content">
          <header>
            <p></p>
            <i class="uil uil-times"></i>
          </header>
          <form action="#">
            <div class="row title">
              <label>Title</label>
              <input type="text" spellcheck="false">
            </div>
            <div class="row description">
              <label>Description</label>
              <textarea spellcheck="false"></textarea>
            </div>
            <button></button>
          </form>
        </div>
      </div>
    </div>
    <div class="wrapper">
      <li class="add-box">
        <div class="icon"><i class="uil uil-plus"></i></div>
        <p>Add new note</p>
      </li>
    </div>

    <script src="notes.js"></script>
    
</div>






<script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>





</body>
</html>
