<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titles -->
    <title>Add Internship offer</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../../style.css?v=<?php echo time(); ?>">

</head>


<!-- php here -->
<?php
session_start();
require '../../../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topic = !empty($_POST["topic"]) ? $_POST["topic"] : "";
    $workLocation = !empty($_POST["worklocation"]) ? $_POST["worklocation"] : "";
    $locationName = ($workLocation == "" && !empty($_POST["locationName"])) ? $_POST["locationName"] : "Remote";
    $duration = !empty($_POST["duration"]) ? $_POST["duration"] : "";
    $stipend = !empty($_POST["stipend"]) ? $_POST["stipend"] : "";
    $applyBy = !empty($_POST["applyby"]) ? $_POST["applyby"] : "";
    $requiredSkills = isset($_POST["languages"]) ? implode(", ", $_POST["languages"]) : "No skills required";
    $aboutInternship = !empty($_POST["aboutintern"]) ? $_POST["aboutintern"] : "";
    $certificate = isset($_POST['certificate']) ? 1 : 0;
    $openings = !empty($_POST["openings"]) ? $_POST["openings"] : 0;
    if (isset($_SESSION['mail'])) {
        $email = $_SESSION['mail'];
    } else {
        echo "<script>alert('Error: Session is not working.')</script>";
    }

    $query = "SELECT id AS com_id FROM company WHERE email = '$email'";
    $find = $conn->query($query);
    if(mysqli_num_rows($find)>0){
        while($row = mysqli_fetch_array($find)){
            $com_id = $row["com_id"];
        }
    }

    try {
        $sql = "INSERT INTO internships (com_id, topic, work_location, location_name, duration, stipend, apply_by, required_skills, about_internship, certificate, openings, com_email)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "isssssssssis", $com_id, $topic, $workLocation, $locationName, $duration, $stipend, $applyBy, $requiredSkills, $aboutInternship, $certificate, $openings, $email);

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
            Add Internship
        </h1>
    </div>
    <div class="Internship">
        <form action="addinternship.php" method="POST">
            <!-- Topic of the Internship -->
            <div class="topic">
                <p class="Internship-topic">Topic of the Internship*</p>
                <input type="text" name="topic" class="txt-box" placeholder="Example: Full Stack Developer, Front End Developer" required>
            </div>

            <!-- Select the job type -->
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
                <p>Duration*</p>
                <select name="duration" id="duration" required>
                    <option value="15 days">15 days</option>
                    <option value="1 month">1 month</option>
                    <option value="2 months">2 months</option>
                    <option value="3 months">3 months</option>
                    <option value="4 months">4 months</option>
                    <option value="5 months">5 months</option>
                    <option value="6 months">6 months</option>
                </select>
            </div>
            
            <!-- Stipend input -->
            <div class="Stripendpart">
                <p class="stripend">Stipend (INR):</p>
                <input type="number" name="stipend" class="txt-box" placeholder="Please enter in INR">
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

            <!-- Information about the internship -->
            <div class="internabout">
                <p class="aboutintern">Please write something about the internship*</p>
                <textarea name="aboutintern" class="txt-box abouttxt" placeholder="You can write about the internship requirements." style="resize: none;" required></textarea>
            </div>

            <!-- Checkbox for Certificate -->
            <div class="iscertificate">
                <input type="checkbox" id="certificate" name="certificate" value="1">
                <label for="certificate">Certificate on completion.</label>
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