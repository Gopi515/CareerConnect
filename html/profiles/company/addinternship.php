<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../LoginandRegister/companyLogin.php");
    exit();
}
?>

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
    <link rel="stylesheet" href="../../profiles/student/resume.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../Internship/newstyle.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<?php
require '../../../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topic = !empty($_POST["topic"]) ? $_POST["topic"] : "";
    $workLocation = !empty($_POST["worklocation"]) ? $_POST["worklocation"] : "";
    $locationName = ($workLocation == "" && !empty($_POST["locationName"])) ? $_POST["locationName"] : "Remote";
    $duration = !empty($_POST["duration"]) ? $_POST["duration"] : "";
    $stipend = !empty($_POST["stipend"]) ? $_POST["stipend"] : "";
    $applyBy = !empty($_POST["applyby"]) ? $_POST["applyby"] : "";

    // Retrieving and decode the added skills array
    // Decode the skills JSON string
    $skills = isset($_POST['skills']) ? json_decode($_POST['skills']) : [];

    // Check if decoding was successful and $skills is an array
    if ($skills !== null && is_array($skills)) {
    // Combine skills into a comma-separated string
    $skillsString = implode(', ', $skills);
    } else {
    // Handle the case where decoding fails or $skills is not an array
    $skillsString = "No skills required";
    }



    $aboutInternship = !empty($_POST["aboutintern"]) ? $_POST["aboutintern"] : "";
    $certificate = isset($_POST['certificate']) ? 1 : 0;
    $openings = !empty($_POST["openings"]) ? $_POST["openings"] : 0;
    if (isset($_SESSION['mail'])) {
        $email = $_SESSION['mail'];
    } else {
        echo "<script>alert('Error: Session is not working.')</script>";
        exit();
    }

    // Handling file upload
    if (isset($_FILES['intImage']) && $_FILES['intImage']['error'] == UPLOAD_ERR_OK) {
        $resume_name = $_FILES['intImage']['name'];
        $resume_size = $_FILES['intImage']['size'];
        $resume_tmp = $_FILES['intImage']['tmp_name'];
        $resume_destination = '../../../images/internshipImages/' . $resume_name;
        move_uploaded_file($resume_tmp, $resume_destination);
    } else {
        echo "Error: " . $_FILES['intImage']['error'];
        exit();
    }

    $query = "SELECT id AS com_id FROM company WHERE email = '$email'";
    $find = $conn->query($query);
    if (mysqli_num_rows($find) > 0) {
        while ($row = mysqli_fetch_array($find)) {
            $com_id = $row["com_id"];
        }
    }

    try {
        $sql = "INSERT INTO temp_internship (com_id, topic, topic_image, image_size, work_location, location_name, duration, stipend, apply_by, required_skills, about_internship, certificate, openings, com_email)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "isssssssssssis", $com_id, $topic, $resume_name, $resume_size, $workLocation, $locationName, $duration, $stipend, $applyBy, $skillsString, $aboutInternship, $certificate, $openings, $email);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        header('Location: ../../landingPage/landingCompany.php');
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- body starts -->
<body>
    <!-- Page title -->
    <a href="../../landingPage/landingCompany.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 2.2%;"></i></a>
    <div>
        <h1 class="title tinterna">Add Internship</h1>
    </div>
    <div class="Internship">
        <form action="addinternship.php" method="POST" enctype="multipart/form-data">
            <!-- Topic of the Internship -->
            <div class="topic">
                <p class="Internship-topic">Topic of the Internship*</p>
                <input type="text" name="topic" class="txt-box" placeholder="Example: Full Stack Developer, Front End Developer" required>
            </div>

            <!-- Select the job type -->
            <div class="category">
                <legend>Select the internship type*</legend>
                <!-- Radio button for Work From Home -->
                <label for="WFH">
                    <input type="radio" id="WFH" name="worklocation" value="" checked onclick="disableInput()"> Remote.
                </label>
                <br>
                <!-- Radio button for Office Location -->
                <label for="NWFH">
                    <input type="radio" id="NWFH" name="worklocation" value="" onclick="enableInput()"> Office Location.
                    <input type="text" name="locationName" class="NWFH-loc" placeholder="Enter the city name" disabled>
                </label>
            </div>

            <div class="apply-side">
                <!-- Upload internship related image pdf -->
                <div class="uploadResumeij">
                    <h2>Upload Topic Banner</h2>
                    <input type="file" id="intImage" name="intImage" accept="image/*" required onchange="displayintImageName()">
                    <label for="intImage" class="file-label">Choose Topic Image</label>
                    <p id="file-intImage"></p>
                </div>
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
            <label class="inputBox inputBoxrequiredskill">
            <p class="skillAddheading">Add Required Skills*</p>
            <input type="text" id="option1Input" placeholder="Search to add required skills for this Internship e.g. HTML">
            <div id="dropdownFilterprofile" style="width: 100%;"></div>
            <!-- Use a hidden input field to store the selected skills -->
            <input type="hidden" id="skillsInput" name="skills">
            <!-- Use a div to display the selected skills -->
            <div id="tag-container" class="hiddenDiv" style="border: none; width: 100%;"></div>
            </label>

            <!-- Information about the internship -->
            <div class="internabout">
                <p class="aboutintern">Please write something about the internship*</p>
                <textarea name="aboutintern" class="txt-box abouttxt" placeholder="You can write about the internship requirements..." style="resize: none;"required>
                </textarea>
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
    <script src="../../../javaScripts/resume/skills.js"></script>
    <script src="../../../javaScripts/resumeNOC.js"></script>
</body>

</html>