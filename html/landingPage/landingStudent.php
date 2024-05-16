<?php
session_start();
if (!isset($_SESSION['mail'])) {
  header("Location: ../LoginandRegister/studentLogin.php");
}
?>

<?php
require '../../dbconnect.php';

$limit = 15;

$query = "SELECT * FROM internships ORDER BY topic ASC LIMIT $limit";
$result1 = mysqli_query($conn, $query);

$query = "SELECT * FROM internships ORDER BY topic DESC LIMIT $limit";
$result2 = mysqli_query($conn, $query);

$query = "SELECT * FROM job ORDER BY topic ASC LIMIT $limit";
$result3 = mysqli_query($conn, $query);

$query = "SELECT * FROM job ORDER BY topic DESC LIMIT $limit";
$result4 = mysqli_query($conn, $query);
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Student</title>
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> -->
    <!-- SWIPER CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <script
      src="https://kit.fontawesome.com/0d6185a30c.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <body class="bg-img">
    <!-- welcome section -->
    <header>
      <nav id="navbar">
        <div class="container">
          <div class="logo">CareerConnect</div>
          <ul class="nav-links">
            <li>
              <a href="../Internship/internship.php" class="navItems"
                >Internship
                <span class="navItemshover" style="margin-left: -110px"
                  >Find best internships</span
                >
              </a>
            </li>
            <li>
              <a href="../Job/job.php" class="navItems"
                >Job
                <span class="navItemshover" style="margin-left: -75px"
                  >Find best jobs</span
                >
              </a>
            </li>

            <div class="dropdown">
              <li onclick="toggleDropdown()">
                <a class="navItems"
                  ><i class="fas fa-user" id="postOptions"></i>
                  <span class="navItemshover">Your profile</span>
                </a>
                <div id="myDropdown" class="dropdown-content">
                  <a href="../profiles/student/student.php">Create Profile</a>
                  <a href="../profiles/student/viewStudentDetails.php"
                    >View Profile</a
                  >
                  <a href="../profiles/student/updateStudentDetails.php"
                    >Update Profile</a
                  >
                  <a href="../profiles/student/resume.php">Resume/CV builder</a>
                  <a href="../Internship/appliedInternship.php"
                    >Applied Internship</a
                  >
                  <a href="../Job/appliedJob.php">Applied Job</a>
                  <a onclick="openLogOut()">Log Out</a>
                </div>
              </li>
            </div>
          </ul>
        </div>
      </nav>
    </header>

    <!-- content area -->
    <div class="content">
      <div class="helloText">
        <h1>Hi, There! &#128075;</h1>
        <p>Explore</p>
      </div>

      <!-- trending section -->
      <div class="trending">
        <h1 style="margin-bottom: 80px">Internships</h1>
        <a href="../Internship/internship.php" class="landingToall">View all ></a>
        <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <?php
    while ($row = mysqli_fetch_assoc($result1)) {
    ?>
      <div class="swiper-slide">
        <div class="detailodd">
          <div class="lol">
            <img src="../../assets/<?php echo $row['topic_image']; ?>" alt="image missing" />
            <div class="content">
              <h3><?php echo $row['topic']; ?></h3>
              <i class="uil uil-desktop"></i>
              <i class="uil uil-laptop"></i>
              <div style="margin-top: 20px">
                <p><i class="fa-solid fa-location-dot"></i> <?php echo $row['location_name']; ?></p>
                <p> &#8377; <?php echo $row['stipend']; ?>/month</p>
                <p><i class="fa-solid fa-clock"></i> <?php echo $row['duration']; ?> months</p>
              </div>
              <a href="../Internship/viewDetailsinternship.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>
</div>

      </div>

      <!-- Internship section -->
      <div class="Internship_section">
        <h1 style="margin-bottom: -80px">New Internships</h1>
        <a href="../Internship/internship.php" class="landingToall" style="margin-top: 165px;">View all ></a>
        <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <?php
    while ($row = mysqli_fetch_assoc($result2)) {
    ?>
      <div class="swiper-slide">
        <div class="detailodd">
          <div class="lol">
            <img src="../../assets/<?php echo $row['topic_image']; ?>" alt="image missing" />
            <div class="content">
              <h3><?php echo $row['topic']; ?></h3>
              <i class="uil uil-desktop"></i>
              <i class="uil uil-laptop"></i>
              <div style="margin-top: 20px">
                <p><i class="fa-solid fa-location-dot"></i> <?php echo $row['location_name']; ?></p>
                <p>&#8377; <?php echo $row['stipend']; ?>/month</p>
                <p><i class="fa-solid fa-clock"></i> <?php echo $row['duration']; ?> months</p>
              </div>
              <a href="../Internship/viewDetailsinternship.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>
</div>
      </div>

      <!-- Jobs section -->
      <div class="Job">
        <h1 style="margin-bottom: -80px">Jobs</h1>
        <a href="../Job/job.php" class="landingToall" style="margin-top: 170px;">View all ></a>
        <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <?php
    while ($row = mysqli_fetch_assoc($result3)) {
    ?>
      <div class="swiper-slide">
        <div class="detailodd">
          <div class="lol">
            <img src="../../assets/<?php echo $row['topic_image']; ?>" alt="image missing" />
            <div class="content">
              <h3><?php echo $row['topic']; ?></h3>
              <i class="uil uil-desktop"></i>
              <i class="uil uil-laptop"></i>
              <div style="margin-top: 20px">
                <p><i class="fa-solid fa-location-dot"></i> <?php echo $row['location_name']; ?></p>
                <p>&#8377; <?php echo $row['CTC']; ?>/month</p>
              </div>
              <a href="../Job/viewDetailsjob.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>
</div>
      </div>

      <!-- preferences section -->
      <div class="preferences">
        <h1 style="margin-bottom: -80px">New Jobs</h1>
        <a href="../Job/job.php" class="landingToall" style="margin-top: 175px;">View all ></a>
        <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <?php
    while ($row = mysqli_fetch_assoc($result4)) {
    ?>
      <div class="swiper-slide">
        <div class="detailodd">
          <div class="lol">
            <img src="../../assets/<?php echo $row['topic_image']; ?>" alt="image missing" />
            <div class="content">
              <h3><?php echo $row['topic']; ?></h3>
              <i class="uil uil-desktop"></i>
              <i class="uil uil-laptop"></i>
              <div style="margin-top: 20px">
                <p><i class="fa-solid fa-location-dot"></i> <?php echo $row['location_name']; ?></p>
                <p>&#8377;</i> <?php echo $row['CTC']; ?>/month</p>
              </div>
              <a href="../Job/viewDetailsjob.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>
</div>
      </div>
    </div>
    <section class="home-section">
      <div
        id="blurBackground"
        class="blur-background"
        style="display: none"
      ></div>
      <div id="logOutPop">
        <div class="log-out-content">
          <div class="log-out-text">Are you sure you want to log out?</div>
          <div class="log-out-buttons">
            <div class="choice yes" onclick="logOut()">Yes</div>
            <div class="choice no" onclick="closeLogOut()">No</div>
          </div>
        </div>
        <!-- <div id="closeLogout" onclick="closeLogOut()"><i class='bx bx-x'></i></div> -->
      </div>
    </section>

    <!-- footer -->
    <footer class="stufooter">
      <div class="footerMainlanding">
        <div class="footerContainer">
          <a class="footertopicname" href="#">
            <div class="footerLogo">CareerConnect</div>
          </a>
          <div class="footerLinks">
            <ul>
              <li><a href="../Internship/internship.php">Internships</a></li>
              <li><a href="../Job/job.php">Jobs</a></li>
              <li><a href="../profiles/student/resume.php">CV Builder</a></li>
              <li>
                <a href="mailto:careerconnect383@gmail.com">Contact Us</a>
              </li>
            </ul>
          </div>
          <div class="footerSocial">
            <ul>
              <li>
                <a class="facebook" href="https://www.facebook.com/"
                  ><i class="fab fa-facebook-f"></i
                ></a>
              </li>
              <li>
                <a class="twitter" href="https://twitter.com/?lang=en"
                  ><i class="fa-brands fa-x-twitter"></i
                ></a>
              </li>
              <li>
                <a class="youtube" href="https://www.youtube.com/"
                  ><i class="fab fa-youtube"></i
                ></a>
              </li>
              <li>
                <a class="linkedin" href="https://www.linkedin.com/"
                  ><i class="fab fa-linkedin"></i
                ></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="footerBottom">
          <p>
            &copy; 2024 CareerConnect. Made with ❤️ by Gopinath, Arnab and
            Priyadarsi.
          </p>
        </div>
      </div>
    </footer>

    <!-- script -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="../../javaScripts/slider.js"></script>
    <script src="../../javaScripts/showDropdown.js"></script>
    <script src="../../javaScripts/buttonPop.js"></script>
    <script src="../../javaScripts/landingInternshipJobLogout.js"></script>
  </body>
</html>
