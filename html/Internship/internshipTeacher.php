<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../LoginandRegister/teacherLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship</title>
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<!-- php -->

<?php
    require '../../dbconnect.php';

    $internshipsPerPage = 5;

    // Determine the current page
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentPage = (int) $_GET['page'];
    } else {
        $currentPage = 1;
    }

    // Calculate the offset for the SQL query
    $offset = ($currentPage - 1) * $internshipsPerPage;

    $currentDate = date("Y-m-d");

    // Initialize filter conditions
    $filterConditions = "WHERE i.apply_by >= '$currentDate'";

    // Check if filters are set
    if (isset($_POST['filter'])) {
        if (!empty($_POST['workFromHome'])) {
            $filterConditions .= " AND i.location_name = 'Remote'";
        }
        if (!empty($_POST['profile'])) {
            $profile = mysqli_real_escape_string($conn, $_POST['profile']);
            $filterConditions .= " AND i.topic LIKE '%$profile%'";
        }
        if (!empty($_POST['location'])) {
            $location = mysqli_real_escape_string($conn, $_POST['location']);
            $filterConditions .= " AND (i.work_location LIKE '%$location%' OR i.location_name LIKE '%$location%')";
        }
        if (!empty($_POST['removefilter'])) {
            $filterConditions = "WHERE i.apply_by >= '$currentDate'";
        }

    }

    // Retrieve the total number of internships
    $queryTotal = "SELECT COUNT(*) AS total FROM `internships` AS i $filterConditions";
    $resultTotal = mysqli_query($conn, $queryTotal);
    $rowTotal = mysqli_fetch_assoc($resultTotal);
    $totalInternships = $rowTotal['total'];

    // Calculate the total number of pages
    $totalPages = ceil($totalInternships / $internshipsPerPage);

    // Modify the SQL query to retrieve internships for the current page with filters
    $query = "SELECT i.*, cpd.name AS name 
            FROM `internships` AS i 
            INNER JOIN `com_personal_details` AS cpd 
            ON i.com_id = cpd.com_id 
            $filterConditions 
            ORDER BY i.id ASC 
            LIMIT $offset, $internshipsPerPage";

    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
?>


<body>
    
    <!-- navbar -->
    <header>
        <nav id="navbar">
            <div class="container">
                <div class="logo">CareerConnect</div>
                <ul class="nav-links">
                    <li id="button1" class="interJobbutton"><a href="#">Internship</a></li>
                    <li id="button2" class="interJobbutton"><a href="../Job/jobTeacher.php">Job</a></li>
                    <div class="dropdown">
                        <li onclick="toggleDropdown()"><a><i class="fas fa-user" id="postOptions"></i></a>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="../profiles/teacher/teacher.php">Create Profile</a>
                                <a href="../profiles/teacher/viewTeacherDetails.php">View Profile</a>
                                <a href="../profiles/teacher/updateTeacherDetails.php">Update Profile</a>
                                <a onclick="openLogOut()">Log Out</a>
                            </div>
                        </li>
                    </div>
                </ul>
            </div>
        </nav>
    </header>

    <!-- internship page -->
    <div class="internshipPage" id="card1">
    <div class="internshipSection">
    <a href="../landingPage/landingTeacher.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 7.5%;"></i></a>

    <!-- filter section -->
    <div class="filterContainer">
      <div class="filter">
        <i class="fas fa-filter">
            <h1>Filters</h1>
        </i>
      </div>
       
      <form method="POST" action="internshipTeacher.php">
            <div class="filterOptions">
                <!-- checkbox -->
                <label class="container containerWfrmH">Work from home
                    <input type="checkbox" id="workFromHome" name="workFromHome">
                    <span class="checkmark"></span>
                </label>

                <label class="container containerPartTime">Remove filters
                    <input type="checkbox" id="workFromHome" name="removefilter">
                    <span class="checkmark"></span>
                </label>

                <!-- profile -->
                <label class="inputBox">
                    <p>Profile</p>
                    <input type="text" id="profile" name="profile" placeholder="e.g. Web Development">
                </label>

                <!-- location -->
                <label class="inputBox inputBoxlocation">
                    <p>Location</p>
                    <input type="text" id="location" name="location" placeholder="e.g. Delhi">
                </label>

                <!-- filter button -->
                <button class="applyFilter" type="submit" name="filter">Apply Filters</button>
            </div>

        </form>
    </div>

    <!-- Internship listings -->
   <div class="internshipContainer">
    <?php if ($count > 0): ?>
        <h2><?php echo $totalInternships . ' Total internships'; ?></h2> <!-- Display total internships -->
        <div class="internshipOrder">
            <?php while ($row = mysqli_fetch_array($result)): ?>
                <div class="internshipCard internshipCard1">
                    <form action="internshipTeacher.php?action=add&id=<?php echo $row["id"]; ?>" method="POST">
                        <h1><?php echo $row["topic"]; ?></h1>
                        <p class="company_namef"><?php echo $row["name"]; ?></p>
                        <div class="locationP">
                            <i class="fa-solid fa-location-dot"></i>
                            <?php echo $row["work_location"]; ?>
                            <?php echo $row["location_name"]; ?>
                        </div>
                        <div class="mainDetails">
                            <div class="lastDateapply">
                                <p><i class="fa-solid fa-calendar-days"></i> Last date to apply</p>
                                <p><?php echo $row["apply_by"]; ?></p>
                            </div>
                            <div class="durationInternship">
                                <p><i class="fa-solid fa-clock"></i> Duration</p>
                                <p><?php echo $row["duration"]; ?></p>
                            </div>
                            <div class="stipendInternship">
                                <p><i class="fa-solid fa-sack-dollar"></i> Stipend</p>
                                <p>&#8377; <?php echo $row["stipend"]; ?> /month</p>
                            </div>
                        </div>


                        <div class="buttonNextstep">
                            <a href="viewDetailsinternshipTeacher.php?id=<?php echo $row["id"]; ?>" class="details">View Details</a>
                        </div>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>

        <h2 class="pageNumbers"><?php echo "Page $currentPage of $totalPages"; ?></h2> <!-- Display current page -->

        <!-- Pagination navigation -->
        <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?php echo $currentPage - 1; ?>">&lt;</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a <?php echo ($i === $currentPage) ? 'class="active"' : ''; ?> href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?php echo $currentPage + 1; ?>">&gt;</a>
            <?php endif; ?>
        </div>
        <?php else: ?>
            <p>No internships found.</p>
        <?php endif; ?>
    </div>



 </div>
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
    </section>


    <footer>

    </footer>


     <script>
        window.history.forward(); 
        function noBack() { 
            window.history.forward(); 
        } 
    </script>
    <script src="../../javaScripts/dropdown.js"></script>
    <script src="../../javaScripts/inputDisable.js"></script>
    <script src="../../javaScripts/buttonSwitch.js"></script>
    <script src="../../javaScripts/showDropdown.js"></script>
    <script src="../../javaScripts/buttonPop.js"></script>
    <script src="../../javaScripts/landingInternshipJobLogout.js"></script>
    <script src="../../javaScripts/profileFilterdropdown.js"></script>
</body>
</html>
