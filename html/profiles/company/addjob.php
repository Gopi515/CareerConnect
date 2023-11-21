<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titles -->
    <title>Add Job offer</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../../style.css">

</head>

<!-- php here -->
<?php
require '../../../dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check for empty values
    $topic = !empty($_POST["topic"]) ? $_POST["topic"] : "";
    $workLocation = !empty($_POST["worklocation"]) ? $_POST["worklocation"] : "";
    $locationName = ($workLocation == "officelocation" && !empty($_POST["locationName"])) ? $_POST["locationName"] : "Remote";
    $experience = !empty($_POST["experience"]) ? $_POST["experience"] : "";
    $CTC = !empty($_POST["CTC"]) ? $_POST["CTC"] : "";
    $applyBy = !empty($_POST["applyby"]) ? $_POST["applyby"] : "";
    $requiredSkills = isset($_POST["languages"]) ? implode(", ", $_POST["languages"]) : "No skills required";
    $aboutJob = !empty($_POST["about_job"]) ? $_POST["about_job"] : "";
    $additionalInfo = !empty($_POST["additionalinfo"]) ? $_POST["additionalinfo"] : "";
    $openings = !empty($_POST["openings"]) ? $_POST["openings"] : 0;

    try {
        $sql = "INSERT INTO job (topic, work_location, location_name, experience, CTC, apply_by, required_skills, about_job, additional_info, openings)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "sssssssssi", $topic, $workLocation, $locationName, $experience, $CTC, $applyBy, $requiredSkills, $aboutJob, $additionalInfo, $openings);

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
                    <input type="radio" id="WFH" name="worklocation" value="workfromhome" checked onclick="disableInput()"> Remote Job.
                </label>
                <br>
                <!-- Radio button for Office Location -->
                <label for="NWFH">
                    <input type="radio" id="NWFH" name="worklocation" value="officelocation" onclick="enableInput()"> Office Location.
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
            
            <!-- language -->
            <div class="reqskills">


                <p class="reqskills-para">Required Skills*</p>


                <div id="selected-items">
                    <div id="selected-items-list"></div>
                </div>

                <div class="addsk">
                    <div id="select-items-button" class="select-add-skill" onclick="showMenu()">Add</div>
                    <div id="languages" class="languages">
                        <div class="checkbox-div">
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="html" id="HTML">
                                <label for="html">HTML</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="css" id="CSS">
                                <label for="css">CSS</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="javascript" id="JavaScript">
                                <label for="javascript">JavaScript</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="php" id="PHP">
                                <label for="php">PHP</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="mysql" id="MySQL">
                                <label for="mysql">MySQL</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="react" id="React">
                                <label for="react">React</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="blender" id="Blender">
                                <label for="blender">Blender</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="maya" id="Maya">
                                <label for="maya">Maya</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="photoshop" id="photoshop">
                                <label for="photoshop">Adobe Photoshop</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="aftereffect" id="AfterEffect">
                                <label for="aftereffect">Adobe AfterEffect</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="nodejs" id="nodeJS">
                                <label for="nodejs">node.js</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="nextjs" id="nextJS">
                                <label for="nextjs">next.js</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" name="languages[]" value="oracle" id="Oracle">
                                <label for="oracle">Oracle Database</label>
                            </div>
                        </div>
                        <div onclick="addToSelected()" class="add-btn">Add</div>
                    </div>
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
    <script src="../../../javaScripts/selectLanguage.js"></script>
</body>
</html>