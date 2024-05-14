<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../LoginandRegister/teacherLogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job</title>
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<!-- php -->

<?php
require_once '../../dbconnect.php';

if (isset($_POST["applyJob"])) {
    $job_topic = $_POST["hidden_topic"];
    $job_location = $_POST["hidden_location"];
    $job_com_id = $_POST["hidden_com_id"];
    $job_com_email = $_POST["hidden_com_email"];
    $job_id = $_POST["hidden_job_id"];

    $_SESSION['Job_topic'] = $job_topic;
    $_SESSION['Job_loc'] = $job_location;
    $_SESSION['job_com_id'] = $job_com_id;
    $_SESSION['job_com_email'] = $job_com_email;
    $_SESSION['job_id'] = $job_id;

    header("Location:../Job/applyJob.php");
}



$internshipsPerPage = 5;

// Determine the current page
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = (int) $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the offset for the SQL query
$offset = ($currentPage - 1) * $internshipsPerPage;

// Retrieve the total number of internships
$queryTotal = "SELECT COUNT(*) AS total FROM `job`";
$resultTotal = mysqli_query($conn, $queryTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$totalInternships = $rowTotal['total'];

// Calculate the total number of pages
$totalPages = ceil($totalInternships / $internshipsPerPage);

$currentDate = date("Y-m-d"); // Current date

// Modify the SQL query to retrieve internships for the current page
$query = "SELECT * FROM `job` WHERE apply_by >= '$currentDate' ORDER BY id ASC LIMIT $offset, $internshipsPerPage";
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
                    <li id="button1" class="interJobbutton"><a href="../Internship/internshipTeacher.php">Internship</a></li>
                    <li id="button2" class="interJobbutton"><a href="#">Job</a></li>
                    <li><a href="#"><i class="fas fa-bookmark"></i></a></li>
                    <li><a href="#"><i class="fas fa-message"></i></a></li>
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


    <!-- job page -->
    <div class="jobPage" id="card2">
    <div class="internshipSection">
    <a href="../landingPage/landingTeacher.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 7.5%;"></i></a>

    <!-- filter section -->
    <div class="filterContainer">
      <div class="filter">
        <i class="fas fa-filter">
            <h1>Filters</h1>
        </i>
      </div>
       
      <div class="filterOptions">

        <!-- checkbox -->
        <label class="container">As per my preferences
            <input type="checkbox"  id="myCheckboxjob" onchange="toggleInputjob()">
            <span class="checkmark"></span>
        </label>
        <label class="container containerWfrmH">Work from home
            <input type="checkbox" id="option5Inputjob" onchange="toggleInputjob()">
            <span class="checkmark"></span>
        </label>
        <label class="container containerPartTime">Part-time
            <input type="checkbox" id="option6Inputjob">
            <span class="checkmark"></span>
        </label>

        <!-- inputbox -->
        <label class="inputBox">
            <p>Profile</p>
            <input type="text" placeholder="e.g. Web Development" id="option1Inputjob">
            <div id="dropdownFilterprofile"></div>
            <div id="tag-container"></div>
        </label>
        <label class="inputBox inputBoxlocation">
            <p>Location</p>
            <input type="text" placeholder="e.g. Delhi" id="option2Inputjob">
        </label>
        <label class="inputBox inputBoxDate">
            <p>Starting from (or after)</p>
            <input type="date" placeholder="Choose Date" id="option3Inputjob">
        </label>
        <label class="inputBox inputBoxDuration">
            <p>Years of experience</p>
            <div class="dropdown">
                <input type="text" id="option4Inputjob" onclick="showDropdown()" placeholder="Select years of experience">
                <div class="dropdown-content" id="dropdownoptionsJob">
                  <a href="#" onclick="selectOption('freser')">Fresher</a>
                  <a href="#" onclick="selectOption('1 year')">1 year</a>
                  <a href="#" onclick="selectOption('2 years')">2 years</a>
                  <a href="#" onclick="selectOption('3 years')">3 years</a>
                  <a href="#" onclick="selectOption('4 years')">4 years</a>
                  <a href="#" onclick="selectOption('5 years')">5 years</a>
                  <a href="#" onclick="selectOption('5+ years')">5+ years</a>
                </div>
              </div>
        </label>

      </div>
    </div>

    <!-- job listings -->
    <div class="internshipContainer">

        <?php
        if ($count > 0) {
            ?>
        
                <h2><?php echo $totalInternships . ' Total Jobs'; ?></h2> <!-- Display total jobs -->

                <div class="internshipOrder">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <div class="internshipCard internshipCard1">

                            <form action="Job.php?action=add&id=<?php echo $row["id"] ?>" method="POST">
                                <h1>  <?php echo $row["topic"]; ?>  </h1>
                                <div class="locationP">
                                <i class="fa-solid fa-location-dot"></i> 

                                <?php echo $row["work_location"]; ?> 
                                <?php echo $row["location_name"]; ?>

                                </div>
                                <div class="mainDetails">
                                    <div class="lastDateapply">
                                        <p><i class="fa-solid fa-calendar-days"></i>  Last date to apply</p>
                                        <p> <?php echo $row["apply_by"]; ?> </p>
                                    </div>
                                    <div class="durationInternship">
                                        <p><i class="fa-solid fa-clock"></i>  Experience</p>
                                        <p> <?php echo $row["experience"]; ?> </p>
                                    </div>
                                    <div class="stipendInternship">
                                        <p><i class="fa-solid fa-sack-dollar"></i>  CTC(Annual)</p>
                                        <p>&#8377; <?php echo $row["CTC"]; ?> </p>
                                    </div>
                                </div>

                                <input type="hidden" name="hidden_topic" value="<?php echo $row["topic"]; ?>" style="display: none;">
                                <input type="hidden" name="hidden_location" value="<?php echo $row["work_location"] . ' ' . $row["location_name"]; ?>" style="display: none;">
                                <input type="hidden" name="hidden_com_id" value="<?php echo $row["com_id"]; ?>" style="display: none;">
                                <input type="hidden" name="hidden_com_email" value="<?php echo $row["com_email"]; ?>" style="display: none;">
                                <input type="hidden" name="hidden_job_id" value="<?php echo $row["id"]; ?>" style="display: none;">
                

                                <div class="buttonNextstep">
                                    <a href="viewdetailsjobTeacher.php?id=<?php echo $row["id"]; ?>" class="details">View Details</a>
                                </div>
                                </form>
                            </div>
                            <?php
                    }
                    ?>
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
                <?php
                if ($count > 0) {
                } else {
                    echo "<p>No jobs found.</p>";
                }
                ?>
                <?php
        }
        ?>
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


   <!-- script -->
    <script src="../../javaScripts/dropdown.js"></script>
    <script src="../../javaScripts/inputDisable.js"></script>
    <script src="../../javaScripts/showDropdown.js"></script>
    <script src="../../javaScripts/buttonPop.js"></script>
    <script src="../../javaScripts/landingInternshipJobLogout.js"></script> 
    <script src="../../javaScripts/profileFilterdropdown.js"></script>  
</body>
</html>
