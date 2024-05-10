<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../LoginandRegister/companyLogin.php");
}
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
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- welcome section -->
    <header>
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
    </section>

    <!-- <script src="../../javaScripts/dropdown.js"></script> -->
    <script src="../../javaScripts/showDropdown.js"></script>
    <script src="../../javaScripts/buttonPop.js"></script>
    <script src="../../javaScripts/landingInternshipJobLogout.js"></script>
</body>

</html>