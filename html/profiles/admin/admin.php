<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<?php
session_start();
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
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Category</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Category</a></li>
                    <li><a href="something.php">1st one</a></li>
                    <li><a href="something.php">2nd one</a></li>
                    <li><a href="something.php">3rd one</a></li>
                </ul>
            </li>

            <li>
                <a href="register.php">
                    <i class='bx bxs-registered'></i>
                    <span class="link_name">Register IDs</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Setting</span>
                </a>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="/assets/image.png" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">
                        <?php
                        if (isset($_SESSION['user_name'])) {
                            $username = $_SESSION['user_name'];
                        } else {
                            echo "<script>alert('Error: Session is not working.')</script>";
                        }
                        echo $username;
                        ?>
                        </div>
                        <div class="job">College name</div>
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
            <span class="text">Admin Main Page</span>
        </div>
    </section>

    <!-- script link -->
    <script src="../../../javaScripts/sideBar.js"></script>
    <script src="../../../javaScripts/buttonPop.js"></script>
    <script src="../../../javaScripts/adminLogOut.js"></script>

</body>

</html>