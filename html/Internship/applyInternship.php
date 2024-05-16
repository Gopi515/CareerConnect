<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="newstyle.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
    <title>Apply Internship</title>
</head>

<!-- php -->
<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../LoginandRegister/studentLogin.php");
}

// Include database connection
require '../../dbconnect.php';

if (isset($_POST["submit"])) {
    // Retrieve form data
    $cover_letter = $_POST['cover_letter'];
    $availability = $_POST['availability'];
    $availability_spec = ($availability === 'No') ? $_POST['availability_spec'] : null;
    $assessment = $_POST['assessment'];

    // Check if required session variables are set
    if (isset($_SESSION['int_topic'], $_SESSION['int_loc'], $_SESSION['int_dur'], $_SESSION['mail'], $_SESSION['int_com_id'], $_SESSION['int_com_email'], $_SESSION['int_id'])) {
        $internship_topic = $_SESSION['int_topic'];
        $internship_location = $_SESSION['int_loc'];
        $internship_duration = $_SESSION['int_dur'];
        $email = $_SESSION['mail'];
        $internship_com_id = $_SESSION['int_com_id'];
        $internship_com_email = $_SESSION['int_com_email'];
        $internship_int_id = $_SESSION['int_id'];
        $applydate = date('Y-m-d');
        $status = "Applied & Forwarded to Admin";

        // Retrieve student ID from the database using the email
        $search = "SELECT id AS stu_id FROM student WHERE email = '$email'";
        $find = $conn->query($search);
        if (mysqli_num_rows($find) > 0) {
            $row = mysqli_fetch_assoc($find);
            $stu_id = $row["stu_id"];
        }

        // Handle Resume Upload
        $resume_name = $_FILES['resume']['name'];
        $resume_size = $_FILES['resume']['size'];
        $resume_tmp = $_FILES['resume']['tmp_name'];
        $resume_destination = '../../files/intern/' . $resume_name; // Adjust the destination directory as needed
        move_uploaded_file($resume_tmp, $resume_destination);

        // Handle NOC Upload
        $noc_name = $_FILES['noc']['name'];
        $noc_size = $_FILES['noc']['size'];
        $noc_tmp = $_FILES['noc']['tmp_name'];
        $noc_destination = '../../files/intern/' . $noc_name; // Adjust the destination directory as needed
        move_uploaded_file($noc_tmp, $noc_destination);

        // Insert data into internship_application_details table
        $query = "INSERT INTO `internship_application_details` (cover_letter, availability, availability_spec, assessment, resume_name, resume_size, noc_name, noc_size, apply_date, com_email, com_id, internship_id, stu_email, stu_id) VALUES ('$cover_letter', '$availability', '$availability_spec', '$assessment', '$resume_name', '$resume_size', '$noc_name', '$noc_size', '$applydate', '$internship_com_email', '$internship_com_id', '$internship_int_id', '$email', '$stu_id')";
        mysqli_query($conn, $query);

        // Insert data into internship_applied table
        $sql = "INSERT INTO `internship_applied` (`internship_id`, `profile`, `location`, `duration`, `status`, `stu_id`, `stu_email`, `com_id`, `com_email`) VALUES ('$internship_int_id', '$internship_topic', '$internship_location', '$internship_duration', '$status', '$stu_id', '$email', '$internship_com_id', '$internship_com_email')";
        mysqli_query($conn, $sql);

        // Unset session variables
        unset($_SESSION['int_topic'], $_SESSION['int_loc'], $_SESSION['int_dur'], $_SESSION['int_com_id'], $_SESSION['int_com_email'] , $_SESSION['int_id']);

        // Redirect after successful submission
        echo "<script>alert('Application submitted successfully');</script>";
        echo "<script>window.location.href='../Internship/internship.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: Session is not working.')</script>";
    }
}
?>


<!-- body -->
<body>
    <a href="../Internship/internship.php" class="goBack" id="goBackButton">
    <i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 2.2%;"></i>
</a>
    <div class="applyHeading"><h1>Applying for Internship</h1></div>

    <form action="#" method="POST" class="applicationForm" enctype="multipart/form-data">
        
    <div class="coverLetter">
        <h2>Cover Letter</h2>
        <h3>Why should you be hired for this role?</h3>
        <!-- <p><i class="fa-solid fa-window-restore" style="color: #0083fa;"></i>  Copy from your last application and edit </p> -->
        <input type="text" placeholder="Or describe in details why you would be a good fit..." required name="cover_letter">
    </div>

        <!-- Radio button -->
        <div class="radioButtons">
            <h2>Your availability</h2>
            <h3>Confirm your availability</h3>
        
        <div class="radionButtonOr">
        <label for="WFH">
            <input type="radio" id="WFH" name="availability" value="Yes, I am available" checked> Yes, I am available to join immediately
        </label>
            <br>

        <label for="NWFH">
            <input type="radio" id="NWFH" name="availability" value="No"> No <input type="text" placeholder="Please specify your availability..." class="availability" name="availability_spec">
        </label>
        </div>

        </div>

        <div class="assesment">
            <h2>Assessment</h2>
            <h3>Q1.  Do you have any experience in this role?</h3>
            <p>If you want to share any documents or files, please upload it on Google Drive or Dropbox and paste the public link in the answer. Or, you also can paste Github link.</p>
            <input type="text" placeholder="Enter text..." name="assessment">
        </div>

        <div class="apply-side-by-side">
            <!-- Upload resume pdf -->
            <div class="uploadResume">
                <h2>Upload Resume</h2>
                <input type="file" id="resume" name="resume" accept=".pdf" required onchange="displayResumeName()">
                <label for="resume" class="file-label">Choose Resume.pdf</label>
                <p id="file-resume"></p>
            </div>  

            <!-- upload NOC pdf -->
            <div class="uploadResume">
                <h2>Upload NOC</h2>
                <input type="file" id="noc" name="noc" accept=".pdf" required onchange="displayNocName()">
                <label for="noc" class="file-label">Choose NOC certificate</label>
                <p id="file-noc"></p>
            </div>

        </div>


        <button class="internshipApplybtn" type="submit" name="submit" onclick="redirectToAnotherPage()">Submit</button>
        <!-- onclick="redirectToAnotherPage()" -->

        </form>


        <!-- <script>
            function redirectToAnotherPage() {
            window.location.href = "testInternship.php";
            }
        </script> -->
        <script src="../../javaScripts/resumeNOC.js"></script>
</body>
</html>
