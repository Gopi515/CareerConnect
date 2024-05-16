<?php
session_start();
if (!isset($_SESSION['mail'])) {
  header("Location: ../LoginandRegister/teacherLogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Teacher</title>
  <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<body class="bg-img">
  <!-- welcome section -->
  <header>
    <nav id="navbar">
      <div class="container">
        <div class="logo">CareerConnect</div>
        <ul class="nav-links">
          <li>
            <a href="../Internship/internshipTeacher.php">Internship</a>
          </li>
          <li><a href="../Job/jobTeacher.php">Job</a></li>
          <li>
            <a href="../CEE/adminpanel/"><i class="fa-solid fa-note-sticky"></i></a>
          </li>
          <div class="dropdown">
            <li onclick="toggleDropdown()">
              <a><i class="fas fa-user" id="postOptions"></i></a>
              <div id="myDropdown" class="dropdown-content">
                <a href="../profiles/teacher/teacher.php">Create Profile</a>
                <a href="../profiles/teacher/viewTeacherDetails.php">View Profile</a>
                <a href="../profiles/teacher/updateTeacherDetails.php">Update Profile</a>
                <a href="../profiles/teacher/Examination/questionUpload.php">Upload Questions</a>
                <a id="uploadLink" class="boxes CR" href="#"><div onclick="openxlsxC()">CSV Question Upload</div></a>
                <a href="../profiles/teacher/Examination/viewQuestions.php">View Questions</a>
                <a onclick="openLogOut()">Log Out</a>
              </div>
            </li>
          </div>
        </ul>
      </div>
    </nav>
  </header>

  <form action="#" method="post" name="company_excel" enctype="multipart/form-data">
    <div id="uploadModalC" class="modalXD">
        <div class=" modal-content-machine">
            <div id="closemodal" onclick="closexlsxC()"><i class='bx bx-x'></i></div>
            <h2>Upload the CSV to mass Enter Question</h2>
            <div id="dropArea">
                <p>Click choose file button to browse</p>
                <input type="file" name="file" id="file" class="input-large" required accept=".csv" />
            </div>
            <div id="uploadResult"></div>
            <button type="submit" id="submit" name="company_mass_data">Upload</button>
            <span id="fileName"></span>
        </div>
    </div>
  </form>

  <!-- content area -->
  <div class="content">
    <div class="helloText">
      <h1>Hi, There! &#128075;</h1>
      <p>Explore</p>
    </div>

    <!-- trending section -->
    <div class="trending">
      <h1>Trending on CareerConnect &#128293;</h1>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="card1 cards"></div>
            <div class="card2 cards"></div>
            <div class="card3 cards"></div>
          </div>
          <div class="swiper-slide">
            <div class="card4 cards"></div>
            <div class="card5 cards"></div>
            <div class="card6 cards"></div>
          </div>
          <div class="swiper-slide">
            <div class="card7 cards"></div>
            <div class="card8 cards"></div>
            <div class="card9 cards"></div>
          </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <!-- Internship section -->
    <div class="Internship_section">
      <h1>Internships</h1>
      <div class="swiper mySwiper swiper-Int">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="card10 cards">
              <!-- <div class="infos">
                        <h2>Android Teaching Assistance (Virtual)</h2>
                        <div class="locationP">
                        <i class="fa-solid fa-location-dot"></i> 

                        <p>work from home</p>

                      </div>
                      </div> -->
            </div>
            <div class="card11 cards"></div>
            <div class="card12 cards"></div>
          </div>
          <div class="swiper-slide">
            <div class="card13 cards"></div>
            <div class="card14 cards"></div>
            <div class="card15 cards"></div>
          </div>
          <div class="swiper-slide">
            <div class="card16 cards"></div>
            <div class="card17 cards"></div>
            <div class="card18 cards"></div>
          </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <!-- Internship with job offer section -->
    <div class="Internship-job-off">
      <h1>Internships with job offer</h1>
      <div class="swiper mySwiper swiper-intJbOff">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="card19 cards"></div>
            <div class="card20 cards"></div>
            <div class="card21 cards"></div>
          </div>
          <div class="swiper-slide">
            <div class="card22 cards"></div>
            <div class="card23 cards"></div>
            <div class="card24 cards"></div>
          </div>
          <div class="swiper-slide">
            <div class="card25 cards"></div>
            <div class="card26 cards"></div>
            <div class="card27 cards"></div>
          </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <!-- Jobs section -->
    <div class="Job">
      <h1>Jobs</h1>
      <div class="swiper mySwiper swiper-jobs">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="card28 cards"></div>
            <div class="card29 cards"></div>
            <div class="card30 cards"></div>
          </div>
          <div class="swiper-slide">
            <div class="card31 cards"></div>
            <div class="card32 cards"></div>
            <div class="card33 cards"></div>
          </div>
          <div class="swiper-slide">
            <div class="card34 cards"></div>
            <div class="card35 cards"></div>
            <div class="card36 cards"></div>
          </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <!-- preferences section -->
    <div class="preferences">
      <h1>Internships and Jobs based on your preferences</h1>
      <div class="swiper mySwiper swiper-preferences">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="card28 cards"></div>
            <div class="card29 cards"></div>
            <div class="card30 cards"></div>
          </div>
          <div class="swiper-slide">
            <div class="card31 cards"></div>
            <div class="card32 cards"></div>
            <div class="card33 cards"></div>
          </div>
          <div class="swiper-slide">
            <div class="card34 cards"></div>
            <div class="card35 cards"></div>
            <div class="card36 cards"></div>
          </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>

  <section class="home-section">
    <div id="blurBackground" class="blur-background" style="display: none"></div>
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
  <footer class="teacherfooter">
    <div class="footerMainlanding">
      <div class="footerContainer">
        <a class="footertopicname" href="#">
          <div class="footerLogo">
            CareerConnect
          </div>
        </a>
        <div class="footerLinks">
          <ul>
            <li><a href="../Internship/internshipTeacher.php">View Internships</a></li>
            <li><a href="../Job/jobTeacher.php">View Jobs</a></li>
            <li><a href="../CEE/adminpanel/">Take Exam</a></li>
            <li><a href="mailto:careerconnect383@gmail.com">Contact Us</a></li>

          </ul>
        </div>
        <div class="footerSocial">
          <ul>
            <li><a class="facebook" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
            <li><a class="twitter" href="https://twitter.com/?lang=en"><i class="fa-brands fa-x-twitter"></i></a></li>
            <li><a class="youtube" href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
            <li><a class="linkedin" href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="footerBottom">
        <p>&copy; 2024 CareerConnect. Made with ❤️ by Gopinath, Arnab and Priyadarsi.</p>
      </div>
    </div>
  </footer>

  <!-- script -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="../../javaScripts/slider.js"></script>
  <script src="../../javaScripts/showDropdown.js"></script>
  <script src="../../javaScripts/buttonPop.js"></script>
  <script src="../../javaScripts/landingInternshipJobLogout.js"></script>
  <script src="../../javaScripts/uploadFile.js"></script>
</body>

</html>