<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../LoginandRegister/adminLogin.php");
    exit();
}

require '../../../dbconnect.php';

$username = $_SESSION['user_name'];

$query = "SELECT * FROM admin";
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

// Get total number of students
$query = "SELECT COUNT(*) AS total_students FROM student";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalStudents = $row['total_students'];

// Get total number of teachers
$query = "SELECT COUNT(*) AS total_teachers FROM teacher";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalTeachers = $row['total_teachers'];

// Get total number of companies
$query = "SELECT COUNT(*) AS total_companies FROM company";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalCompanies = $row['total_companies'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <a href="admin.php">
                <div>CC</div>
            </a>
            <span class="logo_name">CareerConnect</span>
        </div>
        <ul class="nav-links">
            <li style="background-color:#0362ff;">
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
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Email Update</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="listing/studentmainlisting.php">Student's email Update</a></li>
                    <li><a href="listing/teachermainlisting.html">Teacher's email Update</a></li>
                    <li><a href="listing/companymainlisting.html">Company's email Update</a></li>
                </ul>
            </li>

            <li>
                <a href="rPage.php">
                    <i class='bx bxs-registered'></i>
                    <span class="link_name">Register IDs</span>
                </a>
            </li>
            <li>
                <a href="settings.php">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Setting</span>
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
                            <?php echo $username; ?>
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
        <!-- <div class="home-content">
            <span class="text">Admin Main Page</span>
        </div> -->

        <!-- Dashboard overview content here -->
        <div class="dashboard-overview">
            <div class="dashboard-overview">
                <h2>Admin Dashboard</h2>
                <div class="overview-card">
                    <div class="card-header">
                        <h3>Total Users</h3>
                    </div>
                    <div class="card-body">
                        <p>Total number of students: <strong><?php echo $totalStudents; ?></strong></p>
                        <p>Total number of teachers: <strong><?php echo $totalTeachers; ?></strong></p>
                        <p>Total number of companies: <strong><?php echo $totalCompanies; ?></strong></p>
                    </div>
                </div>
                <div class="overview-card">
                    <div class="card-header">
                        <h3>Recent Activities</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>User John Doe updated their profile</li>
                            <li>User Jane Smith registered for an event</li>
                            <li>New job listing added</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="recent-activities">
            <!-- Recent activities content here -->
        </div>
        <div class="notification-center">
            <!-- Notification center content here -->
        </div>
        <div class="task-management">
            <!-- Task management content here -->
        </div>
        <div class="settings-panel">
            <!-- Settings panel content here -->
        </div>
    </section>

    <!-- script link -->
    <script src="../../../javaScripts/sideBar.js"></script>
    <script src="../../../javaScripts/buttonPop.js"></script>
    <script src="../../../javaScripts/adminLogOut.js"></script>
</body>

</html>