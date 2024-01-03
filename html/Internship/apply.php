<!-- php -->
<?php
    session_start();
    require '../../dbconnect.php';

    if (isset($_POST["submit"])){
        $cover_letter = $_POST['cover_letter'];
        $availability = $_POST['availability'];
        $availability_spec = ($availability === 'No') ? $_POST['availability_spec'] : null;
        $assessment = $_POST['assessment'];

        $query = "INSERT INTO application_details (cover_letter, availability, availability_spec, assessment) VALUES ('$cover_letter', '$availability', '$availability_spec', '$assessment')";
        mysqli_query($conn, $query);

        if (isset($_SESSION['int_topic']) && ($_SESSION['int_loc']) && ($_SESSION['int_dur']) && ($_SESSION['mail'])){
            $internship_topic = $_SESSION['int_topic'];
            $internship_location = $_SESSION['int_loc'];
            $internship_duration = $_SESSION['int_dur'];
            $email = $_SESSION['mail'];

            $sql = "INSERT INTO `applied` (`profile`, `location`, `duration`, `stu_email`) VALUES ('$internship_topic', '$internship_location', '$internship_duration', '$email')";
            mysqli_query($conn, $sql);

            unset($_SESSION['int_topic']);
            unset($_SESSION['int_loc']);
            unset($_SESSION['int_dur']);
        } else {
            echo "<script>alert('Error: Session is not working.')</script>";
        }

        echo
        "<script> alert('Application submitted successfully'); </script>";

        header("Location:../Internship/internship.php");
    
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
    <title>Apply</title>
</head>


<!-- body -->
<body>
    <a href="../Internship/internship.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 2.2%;"></i></a>
    <div class="applyHeading"><h1>Applying for Internship</h1></div>

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