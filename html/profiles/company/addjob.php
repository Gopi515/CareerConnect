<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titles -->
    <title>Add Job offer</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../../style.css?v=<?php echo time(); ?>">

</head>

<!-- php here -->
<?php
session_start();
require '../../../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check for empty values
    $topic = !empty($_POST["topic"]) ? $_POST["topic"] : "";
    $workLocation = !empty($_POST["worklocation"]) ? $_POST["worklocation"] : "";
    $locationName = ($workLocation == "" && !empty($_POST["locationName"])) ? $_POST["locationName"] : "Remote";
    $experience = !empty($_POST["experience"]) ? $_POST["experience"] : "";
    $CTC = !empty($_POST["CTC"]) ? $_POST["CTC"] : "";
    $applyBy = !empty($_POST["applyby"]) ? $_POST["applyby"] : "";
    $requiredSkills = isset($_POST["languages"]) ? implode(", ", $_POST["languages"]) : "No skills required";
    $aboutJob = !empty($_POST["about_job"]) ? $_POST["about_job"] : "";
    $additionalInfo = !empty($_POST["additionalinfo"]) ? $_POST["additionalinfo"] : "";
    $openings = !empty($_POST["openings"]) ? $_POST["openings"] : 0;
    if (isset($_SESSION['mail'])) {
        $email = $_SESSION['mail'];
    } else {
        echo "<script>alert('Error: Session is not working.')</script>";
    }

    $query = "SELECT id AS com_id FROM company WHERE email = '$email'";
    $find = $conn->query($query);
    if (mysqli_num_rows($find) > 0) {
        while ($row = mysqli_fetch_array($find)) {
            $com_id = $row["com_id"];
        }
    }

    try {
        $sql = "INSERT INTO job (com_id, topic, work_location, location_name, experience, CTC, apply_by, required_skills, about_job, additional_info, openings, com_email)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "isssssssssis", $com_id, $topic, $workLocation, $locationName, $experience, $CTC, $applyBy, $requiredSkills, $aboutJob, $additionalInfo, $openings, $email);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        header('Location: ../../landingPage/landingCompany.php');
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>



<!-- body starts -->
<body>
    
    <!-- Page title -->
    <div>
        <h1 class="title tinterna">
            Add Job
        </h1>
    </div>
    <div class="Internship">
        <form action="addjob.php" method="POST">
            <!-- Topic of the Job -->
            <div class="topic">
                <p class="Internship-topic">Topic of the Job</p>
                <input type="text" name="topic" class="txt-box" placeholder="Example: Full Stack Web Developer, Application Developer" required>
            </div>
            <div class="category">
                <legend>Select the job type*</legend>
    
                <!-- Radio button for Work From Home -->
                <label for="WFH">
                    <input type="radio" id="WFH" name="worklocation" value="" checked onclick="disableInput()"> Remote Job.
                </label>
                <br>
                <!-- Radio button for Office Location -->
                <label for="NWFH">
                    <input type="radio" id="NWFH" name="worklocation" value="" onclick="enableInput()"> Office Location.
                    <input type="text" name="locationName" class="NWFH-loc" placeholder="Enter the city name" disabled>
                </label>
            </div>

            <!-- Duration selection -->
            <div class="duraptionpart">
                <p>Experience*</p>
                <select name="experience" id="duration" required>
                    <option value="fresher">Fresher</option>
                    <option value="lessthan1">0-1 year</option>
                    <option value="1to2">1-2 years</option>
                    <option value="2to3">2-3 years</option>
                    <option value="3to4">3-4 years</option>
                    <option value="morethan4">4+ years</option>
                </select>
            </div>
            
            <!-- CTC input -->
            <div class="Stripendpart">
                <p class="stripend">CTC (annual)*</p>
                <input type="number" name="CTC" class="txt-box" placeholder="Please enter in INR and it should be in annual.">
            </div>
            
            <!-- Last date to apply input -->
            <div class="lastdate">
                <p class="applyby">Last date to apply*</p>
                <input type="date" name="applyby" class="date" required>
            </div>
            
            <!-- Add Required Skills -->
            <div class="addDomainelement">
                <p>Add Required Skills*</p>
                <div id="addskillButton" onclick="openskillPopup()" class="addquestionSkillbutton">Add</div>

                <!-- popup container -->
                <div id="popupskillContainer" class="hidePopup">
                    <div class="interQuestion"><input type="text" id="searchBar" placeholder="Search..." oninput="filterElements()"/></div>

                    <div class="closeContainerbutton">
                    <span id="closeButton" onclick="closePopup()">×</span>
                    </div>

                    <div class="testCase1"><div id="elementsskillContainer" class="elementsContainer"></div></div>
                </div>

                <div id="addedElements" name="internshipSkills">
                
                <input type="hidden" id="addedSkillsInput" name="addedSkills" required/>
                </div>
      
            </div>

            <!-- Information about the Job -->
            <div class="internabout">
                <p class="aboutintern">Please add some Job details*</p>
                <textarea name="about_job" class="txt-box abouttxt" placeholder="You can write about the Job requirements, what they should expect from the job" style="resize: none;" required></textarea>
            </div>

            <!-- Additional Information area -->
            <div class="information">
                <p class="additionalinfo">Additional informations</p>
                <textarea name="additionalinfo" class="txt-box abouttxt" placeholder="Add the work time, work days in a week etc.,." style="resize: none;"></textarea>
            </div>

            <!-- Number of Openings input -->
            <div class="Total-vacancy">
                <p class="opening">Number of Openings*</p>
                <input type="number" name="openings" class="txt-box" placeholder="Number only" id="vacancyInput" required>
                <p class="error-message" style="color: red;"></p>
            </div>

            <!-- Submit button -->
            <div class="subaddintern">
                <button class="btn submit" id="submitButton" type="submit">Upload</button>
            </div>
        </form>
    </div>

    <!-- JavaScript inclusion -->
    <script src="../../../javaScripts/tillzero.js"></script>
    <script src="../../../javaScripts/date.js"></script>
    <script src="../../../javaScripts/label.js"></script>
    <script src="../../../javaScripts/internshipQuestion.js"></script>
</body>
</html>