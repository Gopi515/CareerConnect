<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../LoginandRegister/adminLogin.php");
    exit();
}

require '../../../dbconnect.php';

$username = $_SESSION['user_name'];
$email = $_SESSION['mail'];

$query = "SELECT * FROM admin where email = '$email'";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$admin = mysqli_fetch_assoc($result);

// Extract initials from username
$initials = '';
$words = explode(' ', $username);
foreach ($words as $word) {
    $initials .= $word[0];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<?php
require '../../../dbconnect.php';
?>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <a href="admin.php">
                <div>CC</div>
            </a>
            <span class="logo_name">CareerConnect</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="admin.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="link_name">Dashboard</span>
                </a>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Lists</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="list/studentlist.php">Student's List</a></li>
                    <li><a href="list/teacherlist.php">Teacher's List</a></li>
                    <li><a href="list/companylist.php">Company's List</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class='bx bx-notepad'></i>
                        <span class="link_name">Profile changes</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="pvalidation/stuValidation.php">Student Updates</a></li>
                    <li><a href="pvalidation/techValidation.php">Teacher Updates</a></li>
                    <li><a href="pvalidation/compValidation.php">Company Updates</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class='bx bxs-checkbox-checked'></i>
                        <span class="link_name">Internship and jobs verification</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="internjobverification/internverify.php">Internship updates</a></li>
                    <li><a href="internjobverification/jobverify.php">Job Updates</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class='bx bxl-venmo'></i>
                        <span class="link_name">Applied verification</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="applications/internApp.php">Internship application</a></li>
                    <li><a href="applications/jobApp.php">Job applications</a></li>
                </ul>
            </li>
            <li>
                <a href="rPage.php">
                    <i class='bx bxs-registered'></i>
                    <span class="link_name">Register IDs</span>
                </a>
            </li>
            <li style="background-color:#0362ff;">
                <a href="settings.php">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Settings</span>
                </a>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <div class="logo">
                            <?php echo strtoupper($initials); ?>
                        </div>
                    </div>
                    <div class="name-job">
                        <div class="profile_name">
                            <?php echo $admin['user_name']; ?>
                        </div>
                        <div class="job">
                            <?php echo $admin['college_name']; ?>
                        </div>
                    </div>
                    <i onclick="openLogOut()" class='bx bx-log-out'></i>
                </div>
            </li>
        </ul>
    </div>
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
        <div class="home-content">
            <span class="text">Settings</span>
        </div>
        <div class="admin-Settings">
            <a class="boxes GS" href="settings/generalSettings.php">
                <div>General Settings</div>
                <p>Edit Profile, Logo customisation, personal details,...</p>
            </a>
            <a class="boxes TP" href="something.php">
                <div>Terms and Policy</div>
                <p>Manage terms of service, privacy policy, and other legal documents.</p>
            </a>
            
            <a class="boxes HD">
                <div onclick="openPOP()">Help Desk</div>
                <p>Contact with technical team, FAQs,...</p>
            </a>

            <div id="blurBackground" class="blur-background" style="display: none;"></div>
            <div id="choicePOP">
                <div class="log-out-content">
                    <div class="log-out-text">How can we help you:</div>
                    <div class="log-out-buttons">
                        <a class="notd" href="something.php"><div class="choice yes">FAQs</div></a>
                        <a class="notd" href="HelpDesk/contactUS.php"><div class="choice no">Email Us</div></a>
                    </div>
                </div>
                <div id="closeLogout" onclick="closePOP()"><i class='bx bx-x'></i></div>
            </div>
        </div>
    </section>

    <!-- script link -->
    <script src="../../../javaScripts/sideBar.js"></script>
    <script src="../../../javaScripts/buttonPop.js"></script>
    <script src="../../../javaScripts/adminLogOut.js"></script>

</body>

</html>