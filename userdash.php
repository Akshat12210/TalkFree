<?php
session_start();
include 'connection.php';
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE Email='$email'";
$way1="Voice Call";
$way2="Video Call";
$way3="Chat";

$result = mysqli_query($conn, $sql) or die("Your query is not right");
$row = mysqli_fetch_array($result);
//numbber of meetings attended by counsellle
$sql2 = "SELECT * FROM appointment WHERE Counselle_Email='$email'";
$result2 = mysqli_query($conn, $sql2) or die("Your query is not right");
$count = mysqli_num_rows($result2);

$sql7 = "SELECT * FROM appointment WHERE Counselle_Email='$email'";
$result7 = mysqli_query($conn, $sql7) or die("Your query is not right");

//number of calls attended by counselle
$sql3 = "SELECT * FROM appointment WHERE (Way='Voice Call' or Way='Video Call') and Counselle_Email='$email'";
$result3 = mysqli_query($conn, $sql3) or die("Your query is not right");
$counts = mysqli_num_rows($result3);

//number of  chats
$sql4 = "SELECT * FROM appointment WHERE Way='Chat' and Counselle_Email='$email'";
$result4 = mysqli_query($conn, $sql4) or die("Your query is not right");
$count1 = mysqli_num_rows($result4);




//number of appointments
$sql2 = "SELECT * FROM appointment WHERE Counselle_Email='$email'";
$result5 = mysqli_query($conn, $sql2) or die("Your query is not right");
$row_A = mysqli_fetch_assoc($result5);
$num= mysqli_num_rows($result5)

?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="userstyle.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>TalkFree</title>
  </head>
  <body>
    <div class="sidebar">
      <div class="logo-details">
      <i class='bx bx-message-square-detail'></i>
        <span class="logo_name">TalkFree</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="userdash.php" class="active">
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
          <a href="profile_user.php">
            <i class="bx bx-user"></i>
            <span class="links_name">Update Profile</span>
          </a>
        </li>
        

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
          <span class="dashboard">Dashboard</span>
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
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total Meetings</div>
              <div class="number"><?php echo $count ?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class="bx bx-laptop cart" style="color: #6e6d6d"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total calls</div>
              <div class="number"><?php echo $counts ?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class="bx bxs-phone-call cart two" style="color: #6e6d6d"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total chats</div>
              <div class="number"><?php echo $count1 ?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class="bx bx-message-dots cart three" style="color: #6e6d6d"></i>
          </div>

          <div class="box">
            <div class="right-side">
              <button class="open-button" onclick="openForm()">
                Book a Slot
              </button>

              <div class="form-popup" id="myForm">
                <form action="action_page.php" class="form-container" method="post">
                  <h1>Sechdule a Meet</h1>

                  <!-- <label for="email"><b>Email</b></label> -->
                  <input
                    class="date"
                    type="date"
                    id="date"
                    name="date"
                    required
                  />
                  <br />
                  <input
                    class="time"
                    type="time"
                    id="time"
                    name="time"
                    required
                  />
                  <label class="check-head" for=""
                    >Choose the way you want to talk.</label
                  >
                  <div class="talk-component">
                    <input
                      type="radio"
                      checked="checked"
                      name="remember"
                      value="Video Call"
                    /><span class="text-lg">Video call</span>

                    <input type="radio" checked="checked" value="Voice Call" name="remember" />
                    <span class="text-lg">Voice call</span>

                    <input type="radio" checked="checked" value="Chat" name="remember" />
                    <span class="text-lg">Chat</span>
                  </div>
                  <br />
                  <label class="desc">Give Some Description</label>
                  <input
                    class="desc-text"
                    type="text"
                    id="desc"
                    name="desc"
                    required
                  />

                  <button type="submit" name="submit" class="btn">Confirm</button>
                  <button
                    type="button"
                    class="btn cancel"
                    onclick="closeForm()"
                  >
                    Close
                  </button>
                </form>
              </div>

              <script>
                function openForm() {
                  document.getElementById("myForm").style.display = "block";
                }

                function closeForm() {
                  document.getElementById("myForm").style.display = "none";
                }
              </script>
            </div>
          </div>
        </div>

        <div class="sales-boxes">
          <div class="recent-sales box">
            <div class="title">Recent Meetings</div>
            <div class="sales-details">

            <table class="content-table">
            <thead>
              <tr>
                <th class="topic">Date</th>
                <th class="topic">Counsellor</th>
                <th class="topic">Mode</th>
                <th class="topic">Problem</th>
               </tr>
            </thead>
            <tbody>
            <?php
while ($row = $result2->fetch_assoc()) {
    $current_datetime = date('Y-m-d H:i');
    $date = $row["Date"];
    $time = $row["Time"];
    $datetime = $date . " " . $time;
    $send_date = date("Y-m-d H:i", strtotime($datetime));
    if (strtotime($current_datetime) > strtotime($send_date)) {
        $cemail = $row["Counsellor_Email"];
        $sql8 = "SELECT * FROM users WHERE Email='$cemail'";
        $result8 = mysqli_query($conn, $sql8) or die("Your query is not right");
        $DE = mysqli_fetch_assoc($result8);
        echo "<tr>
                    <td>" . $row["Date"] . "</td>
                    <td>" . $DE["Name"] . "</td>
                    <td>" . $row["Way"] . "</td>
                    <td>" . $row["Description"] . "</td>
                </tr>";
    }
}
?>
        </tbody>
          </table>
          </div>
        </div>



        <div class="top-sales box">
          <div class="title">Upcoming Meetings</div><br>
          <?php
while ($row = $result7->fetch_assoc()) {
    $current_datetime = date('Y-m-d H:i');
    $date = $row["Date"];
    $time = $row["Time"];
    $datetime = $date . " " . $time;
    $send_date = date("Y-m-d H:i", strtotime($datetime));
    if (strtotime($current_datetime) <= strtotime($send_date)) {
        $cemail = $row["Counsellor_Email"];
        $sql3 = "SELECT * FROM users WHERE Email='$cemail'";
        $result6 = mysqli_query($conn, $sql3) or die("Your query is not right");
        $DE = mysqli_fetch_assoc($result6);
        echo "
                <div class='top-sales-details'>
                <i class='bx bxs-log-in-circle' style='color:#7d2ae8'  ></i>
                <span class='product'>" . $row["Way"] . " with " . $DE['Name'] . "</span><br>
                <span class='Time'>" . date('d F, Y', strtotime($row['Date'])) . "</span><br>
                <span class='Time'>" . date('h:i A', strtotime($row['Time'])) . "</span>
          </div><br>";
    }
}
?>
            
          </div>
        </div>
      </div>
    </section>

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
  </body>
</html>
