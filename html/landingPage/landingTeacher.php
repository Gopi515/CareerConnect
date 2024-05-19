<?php
session_start();
if (!isset($_SESSION['mail'])) {
  header("Location: ../LoginandRegister/teacherLogin.php");
}
?>

<?php
require '../../dbconnect.php';

$limit = 6;
$query = "SELECT * FROM internships ORDER BY topic ASC";
$result1 = mysqli_query($conn, $query);

$query = "SELECT * FROM internships ORDER BY topic DESC";
$result2 = mysqli_query($conn, $query);

$query = "SELECT * FROM job ORDER BY topic ASC";
$result3 = mysqli_query($conn, $query);

$query = "SELECT * FROM job ORDER BY topic DESC";
$result4 = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Teacher</title>
  <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<?php
  require '../../dbconnect.php';
  if (isset($_POST["question_mass_data"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
      $filename = $_FILES["file"]["tmp_name"];
      $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

      // Check if the file extension is CSV
      if ($file_extension === 'csv') {
          if ($_FILES["file"]["size"] > 0) {
              $file = fopen($filename, "r");

              while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {

                  $questionName = $getData[0];
                  $option1 = $getData[1];
                  $option2 = $getData[2];
                  $option3 = $getData[3];
                  $option4 = $getData[4];
                  $correctOption = $getData[5];
                  $skillsString = $getData[6];

                  $sql = "INSERT INTO `question_bank`(`email`, `Questions`, `Option1`, `Option2`, `Option3`, `Option4`, `right_option`, `skills`) 
                      values ('{$_SESSION['mail']}', '$questionName', '$option1', '$option2', '$option3', '$option4', '$correctOption', '$skillsString')";
                  $result = mysqli_query($conn, $sql);

                  if (!isset($result)) {
                      echo "<script type=\"text/javascript\">
                          alert(\"Invalid File:Please Upload CSV File.\");
                          window.location = \"landingTeacher.php\"
                          </script>";
                  } else {
                      echo "<script type=\"text/javascript\">
                          alert(\"CSV File has been successfully Imported.\");
                          window.location = \"landingTeacher.php\"
                          </script>";
                  }
              }

              fclose($file);
          }
      } else {
          // Display error message for invalid file type
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File Type: Please Upload CSV File.\");
              window.location = \"landingTeacher.php\"
              </script>";
      }
  }
?>

<body class="bg-img">
  <!-- welcome section -->
  <header>
    <nav id="navbar">
      <div class="container">
        <a href="landingTeacher.php" style="text-decoration: none;"><div class="logo">CareerConnect</div></a>
        <ul class="nav-links">
          <li>
            <a href="../Internship/internshipTeacher.php">Internships</a>
          </li>
          <li><a href="../Job/jobTeacher.php">Jobs</a></li>
          <li>
            <a href="../profiles/teacher/Examination/questionUpload.php">Upload Questions</a>
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

  <form action="#" method="post" name="question_excel" enctype="multipart/form-data">
    <div id="uploadModalC" class="modalXD">
        <div class=" modal-content-machine">
            <div id="closemodal" onclick="closexlsxC()"><i class='bx bx-x'></i></div>
            <h2>Upload the CSV to mass Enter Question</h2>
            <div id="dropArea">
                <p>Click choose file button to browse</p>
                <input type="file" name="file" id="file" class="input-large" required accept=".csv" />
            </div>
            <div id="uploadResult"></div>
            <button type="submit" id="submit" name="question_mass_data">Upload</button>
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
        <h1 style="margin-bottom: 80px">Internships</h1>
        <a href="../Internship/internshipTeacher.php" class="landingToall">View all ></a>
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
                <p><i class="fa-solid fa-money-bill"></i> <?php echo $row['stipend']; ?>/month</p>
                <p><i class="fa-solid fa-clock"></i> <?php echo $row['duration']; ?> months</p>
              </div>
              <a href="../Internship/viewdetailsinternshipTeacher.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
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
        <a href="../Internship/internshipTeacher.php" class="landingToall" style="margin-top: 165px;">View all ></a>
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
                <p><i class="fa-solid fa-money-bill"></i> <?php echo $row['stipend']; ?>/month</p>
                <p><i class="fa-solid fa-clock"></i> <?php echo $row['duration']; ?> months</p>
              </div>
              <a href="../Internship/viewdetailsinternshipTeacher.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
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
        <a href="../Job/jobTeacher.php" class="landingToall" style="margin-top: 170px;">View all ></a>
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
                <p><i class="fa-solid fa-money-bill"></i> <?php echo $row['CTC']; ?>/month</p>
              </div>
              <a href="../Job/viewdetailsjobTeacher.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
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
        <a href="../Job/jobTeacher.php" class="landingToall" style="margin-top: 175px;">View all ></a>
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
                <p><i class="fa-solid fa-money-bill"></i> <?php echo $row['CTC']; ?>/month</p>
              </div>
              <a href="../Job/viewdetailsjobTeacher.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
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
  <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
  <script src="../../javaScripts/slider.js"></script>
  <script src="../../javaScripts/showDropdown.js"></script>
  <script src="../../javaScripts/buttonPop.js"></script>
  <script src="../../javaScripts/landingInternshipJobLogout.js"></script>
  <script src="../../javaScripts/uploadFile.js"></script>
</body>

</html>