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
    <title>Add Job offer</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../../style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../profiles/student/resume.css?v=<?php echo time(); ?>">

</head>

<!-- php here -->
<?php
require '../../../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check for empty values
    $topic = !empty($_POST["topic"]) ? $_POST["topic"] : "";
    $workLocation = !empty($_POST["worklocation"]) ? $_POST["worklocation"] : "";
    $locationName = ($workLocation == "" && !empty($_POST["locationName"])) ? $_POST["locationName"] : "Remote";
    $experience = !empty($_POST["experience"]) ? $_POST["experience"] : "";
    $CTC = !empty($_POST["CTC"]) ? $_POST["CTC"] : "";
    $applyBy = !empty($_POST["applyby"]) ? $_POST["applyby"] : "";

    // Retrieving and decode the added skills array
    $addedSkillsArray = isset($_POST['addedSkills']) ? json_decode($_POST['addedSkills'], true) : [];

    if ($addedSkillsArray === null) {
        echo "Error decoding addedSkills JSON: " . json_last_error_msg();
        exit;
    }

    // Combining skills into a comma-separated string
    $skillsString = isset($addedSkillsArray) ? implode(', ', $addedSkillsArray) : "No skills required";

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
        $sql = "INSERT INTO temp_job (com_id, topic, work_location, location_name, experience, CTC, apply_by, required_skills, about_job, additional_info, openings, com_email)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "isssssssssis", $com_id, $topic, $workLocation, $locationName, $experience, $CTC, $applyBy, $skillsString, $aboutJob, $additionalInfo, $openings, $email);

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
    <script src="../../../javaScripts/resume/skills.js"></script>
</body>
</html>