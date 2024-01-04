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
session_start();
    require_once '../../dbconnect.php';

    if(isset($_POST["applyJob"])){
        $job_topic = $_POST["hidden_topic"];
        $job_location = $_POST["hidden_location"];

        $_SESSION['Job_topic'] = $job_topic;
        $_SESSION['Job_loc'] = $job_location;
    
        header("Location:../Job/applyJob.php");
    }

?>

<body>
    
    <!-- navbar -->
    <header>
        <nav id="navbar">
            <div class="container">
                <div class="logo">CareerConnect</div>
                <ul class="nav-links">
                    <li id="button1" class="interJobbutton"><a href="../Internship/internship.php">Internship</a></li>
                    <li id="button2" class="interJobbutton"><a href="#">Job</a></li>
                    <li><a href="../Job/appliedJob.php"><i class="fas fa-bookmark"></i></a></li>
                    <li><a href="#"><i class="fas fa-message"></i></a></li>
                    <li><a href="#"><i class="fas fa-user"></i></a></li>
                    </ul>
                </div>
        </nav>
  
    </header>


    <!-- job page -->
    <div class="jobPage" id="card2">
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
        <h2>
         643 Total  jobs
        </h2>

        <div class="internshipOrder">
        <?php

        $query = "SELECT * FROM `job` ORDER BY id ASC";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)>0){
         while($row = mysqli_fetch_array($result)){

        ?>

        <div class="internshipCard internshipCard1">

            <form action="" method="POST">
                <h1>  <?php echo $row["Topic"]; ?>  </h1>
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

                <input type="hidden" name="hidden_Topic" value="<?php echo $row["Topic"]; ?>">
                <input type="hidden" name="hidden_location" value="<?php echo $row["work_location"] . ' ' . $row["location_name"]; ?>">
                

                <div class="buttonNextstep">
                    <div class="details"><button>View Details</button></div>
                   <button class="applyButton" type="submit" name="applyJob">Apply</button>
                </div>
                </form>
            </div>

        <?php

        }
        }
        ?>
        </div>

        <!-- <h3>
            1/206
        </h3> -->
    </div>

    </div>
 </div>

    <!-- <footer>

    </footer> -->


   <!-- script -->
    <script src="../../javaScripts/dropdown.js"></script>
    <script src="../../javaScripts/inputDisable.js"></script>   


</body>
</html>
