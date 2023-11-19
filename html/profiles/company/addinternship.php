<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titles -->
    <title>Add Internship offer</title>

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
    $duration = $_POST['duration'];
    $stipend = $_POST['stipend'];
    $applyBy = $_POST['applyby'];
    $aboutInternship = $_POST['aboutintern'];
    $certificate = isset($_POST['certificate']) ? 1 : 0;
    $openings = $_POST['openings'];

    // Basic data validation
    $errors = [];

    if (empty($topic)) {
        $errors[] = "Topic is required.";
    }

    if (empty($duration)) {
        $errors[] = "Duration is required.";
    }

    if (!is_numeric($stipend)) {
        $errors[] = "Stipend must be a numeric value.";
    }

    if (empty($applyBy)) {
        $errors[] = "Last date to apply is required.";
    }

    if (empty($aboutInternship)) {
        $errors[] = "Please provide information about the internship.";
    }

    if (!is_numeric($openings) || $openings <= 0) {
        $errors[] = "Number of openings must be a positive number.";
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        $query = "INSERT INTO internships (topic, work_location, location_name, duration, stipend, apply_by, about_internship, certificate, openings) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssdsssi", $topic, $workLocation, $locationName, $duration, $stipend, $applyBy, $aboutInternship, $certificate, $openings);

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
            Add Internship
        </h1>
    </div>
    <div class="Internship">
        <form action="addinternship.php" method="POST">
            <!-- Topic of the Internship -->
            <div class="topic">
                <p class="Internship-topic">Topic of the Internship</p>
                <input type="text" name="topic" class="txt-box" placeholder="Example: Full Stack Developer, Front End Developer" required>
            </div>
            <div class="category">
                <legend>Select the internship type:</legend>
                
                <!-- Radio button for Work From Home -->
                <label for="WFH">
                    <input type="radio" id="WFH" name="worklocation" value="workfromhome" checked> Work From Home
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
                <p>Duration:</p>
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
                <p class="stripend">Stipend</p>
                <input type="number" name="stipend" class="txt-box" placeholder="Please enter in INR">
            </div>
            
            <!-- Last date to apply input -->
            <div class="lastdate">
                <p class="applyby">Last date to apply:</p>
                <input type="date" name="applyby" class="date" required>
            </div>
            
            <!-- Information about the internship -->
            <div class="internabout">
                <p class="aboutintern">Please write something about the internship</p>
                <textarea name="aboutintern" class="txt-box abouttxt" placeholder="You can write about the internship requirements." style="resize: none;" required></textarea>
            </div>

            <!-- Checkbox for Certificate -->
            <div class="iscertificate">
                <input type="checkbox" id="certificate" name="certificate" value="1">
                <label for="certificate">Certificate after completion.</label>
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