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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topic = $_POST['topic'];
    $workLocation = $_POST['worklocation'];
    $locationName = ($workLocation === 'officelocation') ? $_POST['locationName'] : null;
    $experience = $_POST['experience'];
    $CTC = $_POST['CTC'];
    $applyBy = $_POST['applyby'];
    $aboutJob = $_POST['about_job'];
    $additionalinfo = $_POST['additionalinfo'];
    $openings = $_POST['openings'];

    // Basic data validation
    $errors = [];

    if (empty($topic)) {
        $errors[] = "Topic is required.";
    }

    if (empty($experience)) {
        $errors[] = "Experience field is required.";
    }

    if (!is_numeric($CTC)) {
        $errors[] = "CTC must be a numeric value.";
    }

    if (empty($applyBy)) {
        $errors[] = "Last date to apply is required.";
    }

    if (empty($aboutJob)) {
        $errors[] = "Please provide some information about the Job.";
    }

    if (!is_numeric($openings) || $openings <= 0) {
        $errors[] = "Number of openings must be a positive number.";
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        $query = "INSERT INTO job (topic, work_location, location_name, experience, CTC, apply_by, about_Job, additionalinfo, openings) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssdsssi", $topic, $workLocation, $locationName, $experience, $CTC, $applyBy, $aboutJob, $additionalinfo, $openings);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: ../../landingPage/landingPage.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($db);
        }

        mysqli_stmt_close($stmt);
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
                <legend>Select the job type:</legend>
                
                <!-- Radio button for Work From Home -->
                <label for="WFH">
                    <input type="radio" id="WFH" name="worklocation" value="workfromhome" checked> Remote Job.
                </label>
                <br>
                <!-- Radio button for Office Location -->
                <label for="NWFH">
                    <input type="radio" id="NWFH" name="worklocation" value="officelocation"> Office Location:
                    <input type="text" name="locationName" class="NWFH-loc" placeholder="Enter the city name">
                </label>
            </div>

            <!-- Duration selection -->
            <div class="duraptionpart">
                <p>Experience:</p>
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
                <p class="stripend">CTC (annual)</p>
                <input type="number" name="CTC" class="txt-box" placeholder="Please enter in INR and it should be in annual.">
            </div>
            
            <!-- Last date to apply input -->
            <div class="lastdate">
                <p class="applyby">Last date to apply:</p>
                <input type="date" name="applyby" class="date" required>
            </div>
            
            <!-- Information about the Job -->
            <div class="internabout">
                <p class="aboutintern">Please add some Job details:</p>
                <textarea name="about_job" class="txt-box abouttxt" placeholder="You can write about the Job requirements, what they should expect from the job" style="resize: none;" required></textarea>
            </div>

            <!-- Additional Information area -->
            <div class="information">
                <p class="additionalinfo">Additional informations:</p>
                <textarea name="additionalinfo" class="txt-box abouttxt" placeholder="Add the work time, work days in a week etc.,." style="resize: none;" required></textarea>
            </div>

            <!-- Number of Openings input -->
            <div class="Total-vacancy">
                <p class="opening">Number of Openings:</p>
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
</body>
</html>