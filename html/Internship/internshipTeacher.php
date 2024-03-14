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
session_start();
require '../../dbconnect.php';

if (isset($_POST["applyInternship"])) {
    $internship_topic = $_POST["hidden_topic"];
    $internship_location = $_POST["hidden_location"];
    $internship_duration = $_POST["hidden_duration"];
    $internship_com_id = $_POST["hidden_com_id"];
    $internship_com_email = $_POST["hidden_com_email"];
    $internship_int_id = $_POST["hidden_int_id"];

    $_SESSION['int_topic'] = $internship_topic;
    $_SESSION['int_loc'] = $internship_location;
    $_SESSION['int_dur'] = $internship_duration;
    $_SESSION['int_com_id'] = $internship_com_id;
    $_SESSION['int_com_email'] = $internship_com_email;
    $_SESSION['int_id'] = $internship_int_id;

    header("Location:../Internship/applyInternship.php");
}


$internshipsPerPage = 5;

// Determine the current page
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = (int)$_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the offset for the SQL query
$offset = ($currentPage - 1) * $internshipsPerPage;

// Retrieve the total number of internships
$queryTotal = "SELECT COUNT(*) AS total FROM `internships`";
$resultTotal = mysqli_query($conn, $queryTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$totalInternships = $rowTotal['total'];

// Calculate the total number of pages
$totalPages = ceil($totalInternships / $internshipsPerPage);

// Modify the SQL query to retrieve internships for the current page
$query = "SELECT * FROM `internships` ORDER BY id ASC LIMIT $offset, $internshipsPerPage";
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
                    <li><a href="#"><i class="fas fa-bookmark"></i></a></li>
                    <li><a href="#"><i class="fas fa-message"></i></a></li>
                    <div class="dropdown">
                        <li onclick="toggleDropdown()"><a><i class="fas fa-user" id="postOptions"></i></a>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="../profiles/student/viewStudentDetails.php">View Profile</a>
                                <a href="#">Edit Profile</a>
                                <a href="../Internship/appliedInternship.php">Applied Internship</a>
                                <a href="../Job/appliedJob.php">Applied Job</a>
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
            <input type="checkbox"  id="myCheckbox" onchange="toggleInput()">
            <span class="checkmark"></span>
        </label>
        <label class="container containerWfrmH">Work from home
            <input type="checkbox" id="option5Input" onchange="toggleInput()">
            <span class="checkmark"></span>
        </label>
        <label class="container containerPartTime">Part-time
            <input type="checkbox" id="option6Input">
            <span class="checkmark"></span>
        </label>
        <label class="container containerjobOff">Internships with job offer
            <input type="checkbox" id="option7Input">
            <span class="checkmark"></span>
        </label>

        <!-- inputbox -->
        <label class="inputBox">
            <p>Profile</p>
            <input type="text" placeholder="e.g. Web Development" id="option1Input">
        </label>
        <label class="inputBox inputBoxlocation">
            <p>Location</p>
            <input type="text" placeholder="e.g. Delhi" id="option2Input">
        </label>
        <label class="inputBox inputBoxDate">
            <p>Starting from (or after)</p>
            <input type="date" placeholder="Choose Date" id="option3Input">
        </label>
        <label class="inputBox inputBoxDuration">
            <p>Max.duration(months)</p>
            <div class="dropdown">
                <input type="text" id="option4Input" onclick="showDropdown()" placeholder="Choose Duration">
                <div class="dropdown-content" id="dropdownOptions">
                  <a href="#" onclick="selectOption('1 month')">1 month</a>
                  <a href="#" onclick="selectOption('2 months')">2 months</a>
                  <a href="#" onclick="selectOption('3 months')">3 months</a>
                  <a href="#" onclick="selectOption('4 months')">4 months</a>
                  <a href="#" onclick="selectOption('5 months')">5 months</a>
                  <a href="#" onclick="selectOption('6 months')">6 months</a>
                </div>
              </div>
        </label>

      </div>
    </div>

    <!-- Internship listings -->
   <div class="internshipContainer">


    
    <?php
    if($count > 0) {
    ?>


       <h2><?php echo $totalInternships . ' Total internships'; ?></h2> <!-- Display total internships -->

        <div class="internshipOrder">
            <?php
            while($row = mysqli_fetch_array($result)) {
                ?>
                <div class="internshipCard internshipCard1">
                    <form action="Internship.php?action=add&id=<?php echo $row["id"]?>" method="POST">
                        <h1><?php echo $row["topic"]; ?></h1>
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

                        <!-- for storing the data of applied internship temporary -->
                        <input type="hidden" name="hidden_topic" value="<?php echo $row["topic"]; ?>" style="display: none;">
                        <input type="hidden" name="hidden_location" value="<?php echo $row["work_location"] . ' ' . $row["location_name"]; ?>" style="display: none;">
                        <input type="hidden" name="hidden_duration" value="<?php echo $row["duration"]; ?>" style="display: none;">
                        <input type="hidden" name="hidden_com_id" value="<?php echo $row["com_id"]; ?>" style="display: none;">
                        <input type="hidden" name="hidden_com_email" value="<?php echo $row["com_email"]; ?>" style="display: none;">
                        <input type="hidden" name="hidden_int_id" value="<?php echo $row["id"]; ?>" style="display: none;">

                        <div class="buttonNextstep">
                            <a href="viewdetailsinternshipTeacher.php?id=<?php echo $row["id"]; ?>" class="details">View Details</a>
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
            <?php if ($currentPage > 1) : ?>
                <a href="?page=<?php echo $currentPage - 1; ?>">&lt;</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a <?php echo ($i === $currentPage) ? 'class="active"' : ''; ?> href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($currentPage < $totalPages) : ?>
                <a href="?page=<?php echo $currentPage + 1; ?>">&gt;</a>
            <?php endif; ?>
        </div>
        <?php
         if($count > 0) {
    } else {
        echo "<p>No internships found.</p>";
    }
    ?>
        <?php
    }
    ?>
</div>



 </div>
  </div>




    <footer>

    </footer>



    <script src="../../javaScripts/dropdown.js"></script>
    <script src="../../javaScripts/inputDisable.js"></script>
    <script src="../../javaScripts/buttonSwitch.js"></script>
    <script src="../../javaScripts/showDropdown.js"></script>
</body>
</html>