<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../LoginandRegister/companyLogin.php");
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

</head>


<!-- php here -->
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
    $addedSkillsArray = isset($_POST['addedSkills']) ? json_decode($_POST['addedSkills'], true) : [];

    if ($addedSkillsArray === null) {
        echo "Error decoding addedSkills JSON: " . json_last_error_msg();
        exit;
    }

    // Combining skills into a comma-separated string
    $skillsString = isset($addedSkillsArray) ? implode(', ', $addedSkillsArray) : "No skills required";

    $aboutInternship = !empty($_POST["aboutintern"]) ? $_POST["aboutintern"] : "";
    $certificate = isset($_POST['certificate']) ? 1 : 0;
    $openings = !empty($_POST["openings"]) ? $_POST["openings"] : 0;
    if (isset($_SESSION['mail'])) {
        $email = $_SESSION['mail'];
    } else {
        echo "<script>alert('Error: Session is not working.')</script>";
    }

    // Handling file upload
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $resume_name = $_FILES['resume']['name'];
        $resume_size = $_FILES['resume']['size'];
        $resume_tmp = $_FILES['resume']['tmp_name'];
        $resume_destination = '../../../images/internshipImages/' . $resume_name;
        move_uploaded_file($resume_tmp, $resume_destination);
    } else {
        echo "Error uploading file.";
        exit;
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
                <input type="text" name="topic" class="txt-box"
                    placeholder="Example: Full Stack Developer, Front End Developer" required>
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
            <!-- Upload resume pdf -->
                <div class="uploadResumeij">
                    <h2>Upload Topic Related Image</h2>
                    <input type="file" id="resume" name="resume" accept="image/*" required onchange="displayResumeName()">
                    <label for="resume" class="file-label">Choose Topic Image</label>
                    <p id="file-resume"></p>
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
            <label for="" class="form-label">Skill</label>
            <div class="input-options">
                <div class="option-dropdown">
                    <select name="skill" class="form-control skill" id="skill_select" onchange="generateCV()">
                        <option value="">Select Skill</option>
                        <option value="HTML">HTML</option>
                        <option value="CSS">CSS</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="PHP">PHP</option>
                        <option value="Python">Python</option>
                        <option value="Java">Java</option>
                        <option value="C++">C++</option>
                        <option value="C#">C#</option>
                        <option value="Ruby">Ruby</option>
                        <option value="Swift">Swift</option>
                        <option value="Kotlin">Kotlin</option>
                        <option value="Dart">Dart</option>
                        <option value="Flutter">Flutter</option>
                        <option value="React">React</option>
                        <option value="Angular">Angular</option>
                        <option value="Vue">Vue</option>
                        <option value="Node">Node</option>
                        <option value="Express">Express</option>
                        <option value="Laravel">Laravel</option>
                        <option value="CodeIgniter">CodeIgniter</option>
                        <option value="Django">Django</option>
                        <option value="Flask">Flask</option>
                        <option value="Spring">Spring</option>
                        <option value="Hibernate">Hibernate</option>
                        <option value="JPA">JPA</option>
                        <option value="JSP">JSP</option>
                        <option value="Servlet">Servlet</option>
                        <option value="Thymeleaf">Thymeleaf</option>
                        <option value="JDBC">JDBC</option>
                        <option value="MySQL">MySQL</option>
                        <option value="PostgreSQL">PostgreSQL</option>
                        <option value="MongoDB">MongoDB</option>
                        <option value="SQLite">SQLite</option>
                        <option value="Oracle">Oracle</option>
                        <option value="SQL Server">SQL Server</option>
                        <option value="MariaDB">MariaDB</option>
                        <option value="Firebase">Firebase</option>
                        <option value="AWS">AWS</option>
                        <option value="Azure">Azure</option>
                        <option value="Google Cloud">Google Cloud</option>
                        <option value="Heroku">Heroku</option>
                        <option value="Netlify">Netlify</option>
                        <option value="Vercel">Vercel</option>
                        <option value="Digital Ocean">Digital Ocean</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
            </div>
            <span class="form-text"></span>

            <!-- Information about the internship -->
            <div class="internabout">
                <p class="aboutintern">Please write something about the internship*</p>
                <textarea name="aboutintern" class="txt-box abouttxt"
                    placeholder="You can write about the internship requirements." style="resize: none;"
                    required></textarea>
            </div>

            <!-- Checkbox for Certificate -->
            <div class="iscertificate">
                <input type="checkbox" id="certificate" name="certificate" value="1">
                <label for="certificate">Certificate on completion.</label>
            </div>

            <!-- Number of Openings input -->
            <div class="Total-vacancy">
                <p class="opening">Number of Openings*</p>
                <input type="number" name="openings" class="txt-box" placeholder="Number only" id="vacancyInput"
                    required>
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