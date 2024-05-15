<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../LoginandRegister/companyLogin.php");
}

require '../../dbconnect.php';

$email = $_SESSION['mail'];

$query = "SELECT * FROM com_personal_details where email = '$email'";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$company = mysqli_fetch_assoc($result);

// Get total number of students
$query = "SELECT COUNT(*) AS total_internship FROM internships where com_email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalinternship = $row['total_internship'];

// Get total number of teachers
$query = "SELECT COUNT(*) AS total_job FROM job where com_email = '$email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totaljob = $row['total_job'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title>Landing Company</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../style.css">
    <!-- <link rel="stylesheet" href="../profiles/admin/admin.css"> -->
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<body class="bg-img">
    <!-- welcome section -->
    <header class="hi-nav">
        <nav id="navbar">
            <div class="container">
                <div class="logo">CareerConnect</div>
                <ul class="nav-links">
                    <a class="navmains" href="../profiles/company/posted/internshipposted.php">Your Internships</a>
                    <a class="navmains" href="../profiles/company/posted/jobposted.php">Your Jobs</a>
                    <li><a href="#"><i class="fas fa-window-restore"></i></a></li>
                    <div class="dropdown">
                        <li onclick="toggleDropdown()"><a><i class="fas fa-user" id="postOptions"></i></a>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="../profiles/company/company.php">Create Profile</a>
                                <a href="../profiles/company/viewCompanyDetails.php">View Profile</a>
                                <a href="../profiles/company/updateCompanyDetails.php">Update Profile</a>
                                <a href="../profiles/company/addinternship.php">Post Internship</a>
                                <a href="../profiles/company/addjob.php">Post Job</a>
                                <a onclick="openLogOut()">Log Out</a>
                            </div>
                        </li>
                    </div>
                </ul>
            </div>
        </nav>
    </header>

    <section class="home-section">
        <div id="blurBackground" class="blur-background" style="display: none;"></div>
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

        <!-- Dashboard overview content here -->
        <div class="admin-overview">
            <h2>Company Dashboard</h2>
            <div class="dashboard-overview">
                <div class="overview-card">
                    <div class="card-header">
                        <h3>Total Posts</h3>
                    </div>
                    <div class="card-body">
                        <p>Total number of internships: <strong>
                                <?php echo $totalinternship; ?>
                            </strong></p>
                        <p>Total number of jobs: <strong>
                                <?php echo $totaljob; ?>
                            </strong></p>
                    </div>
                </div>
                <div class="overview-card">
                    <div class="card-header">
                        <h3>Your details</h3>
                    </div>
                    <div class="card-body">
                        <p>Your Company Name: <strong>
                                <?php echo $company['name']; ?>
                            </strong></p>
                        <p>Logged Email: <strong>
                                <?php echo $company['email']; ?>
                            </strong></p>
                    </div>
                </div>
            </div>

            <!-- posting -->
            <div class="list-overview">
                <div class="list-header">
                    <h3>Post Internship & Job</h3>
                </div>
                <div class="buttons">
                    <a class="button" href="../profiles/company/addinternship.php">Post Internship</a>
                    <a class="button" href="../profiles/company/addjob.php">Post Job</a>
                </div>
            </div>

            <!-- listings -->
            <div class="list-overview">
                <div class="list-header">
                    <h3>All Posts & Applications</h3>
                </div>
                <div class="buttons">
                    <a class="button" href="../profiles/company/posted/internshipposted.php">Internships & Applications</a>
                    <a class="button" href="../profiles/company/posted/jobposted.php">Jobs & Applications</a>
                </div>
            </div>
            
            <!-- verification -->
            <div class="list-overview">
                <div class="list-header">
                    <h3>All Posts & Shortlisted Applications</h3>
                </div>
                <div class="buttons">
                    <a class="button" href="../profiles/company/shortlistedApplications/postedInternship.php">Internships & Shortlisted Applications</a>
                    <a class="button" href="../profiles/company/shortlistedApplications/postedJob.php">Jobs & Shortlisted Applications</a>
                </div>
            </div>

            <!-- Internship and job verification -->
            <div class="list-overview">
                <div class="list-header">
                    <h3>All Posts & Selected Applications</h3>
                </div>
                <div class="buttons">
                    <a class="button" href="../profiles/company/selectedApplications/internship.php">Internships & Selected Applications</a>
                    <a class="button" href="../profiles/company/selectedApplications/job.php">Jobs & Selected Applications</a>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="footer-comlanding">
      <div class="footerMainlanding">
          <div class="footerContainer">
              <a class="footertopicname" href="#"><div class="footerLogo">
                  CareerConnect
              </div></a>
              <div class="footerLinks">
                  <ul>
                    <li><a href="../profiles/company/addinternship.php">Post Internships</a></li>
                    <li><a href="../profiles/company/addjob.php">Post Jobs</a></li>
                    <li><a href="../profiles/company/posted/internshipposted.php">Your Internships</a></li>
                    <li><a href="../profiles/company/posted/jobposted.php">Your Jobs</a></li>
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

    <!-- <script src="../../javaScripts/dropdown.js"></script> -->
    <script src="../../javaScripts/showDropdown.js"></script>
    <script src="../../javaScripts/buttonPop.js"></script>
    <script src="../../javaScripts/landingInternshipJobLogout.js"></script>
</body>

</html>