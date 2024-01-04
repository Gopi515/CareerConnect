<!-- php -->
<?php
    session_start();
    require '../../dbconnect.php';

    if (isset($_POST["submit"])){
        $cover_letter = $_POST['cover_letter'];
        $availability = $_POST['availability'];
        $availability_spec = ($availability === 'No') ? $_POST['availability_spec'] : null;
        $assessment = $_POST['assessment'];

        $query = "INSERT INTO `job_application_details` (cover_letter, availability, availability_spec, assessment) VALUES ('$cover_letter', '$availability', '$availability_spec', '$assessment')";
        mysqli_query($conn, $query);

        if (isset($_SESSION['Job_topic']) && ($_SESSION['Job_loc']) && ($_SESSION['mail'])){
            $job_topic = $_SESSION['Job_topic'];
            $job_location = $_SESSION['Job_loc'];
            $email = $_SESSION['mail'];

            $sql = "INSERT INTO `job_applied` (`profile`, `location`, `stu_email`) VALUES ('$job_topic', '$job_location', '$email')";
            mysqli_query($conn, $sql);

            unset($_SESSION['Job_topic']);
            unset($_SESSION['Job_loc']);
        } else {
            echo "<script>alert('Error: Session is not working.')</script>";
        }

        echo
        "<script> alert('Application submitted successfully'); </script>";

        header("Location:../Job/job.php");
    
    }

?>


<!-- head -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
    <title>Apply Job</title>
</head>


<!-- body -->
<body>
    <a href="../Job/job.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 2.2%;"></i></a>
    <div class="applyHeading"><h1>Applying for Job</h1></div>

    <form action="" method="POST">
    <div class="coverLetter">
        <h2>Cover Letter</h2>
        <h3>Why should you be hired for this role?</h3>
        <p><i class="fa-solid fa-window-restore" style="color: #0083fa;"></i>  Copy from your last application and edit </p>
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


        <button class="internshipApplybtn" type="submit" name="submit">Submit</button>
        </form>

</body>
</html>