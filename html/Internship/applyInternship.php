<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../LoginandRegister/studentLogin.php");
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
    <title>Apply Internship</title>
</head>

<!-- php -->
<?php
    require '../../dbconnect.php';

    if (isset($_POST["submit"])){
        $cover_letter = $_POST['cover_letter'];
        $availability = $_POST['availability'];
        $availability_spec = ($availability === 'No') ? $_POST['availability_spec'] : null;
        $assessment = $_POST['assessment'];

        if (isset($_SESSION['int_topic']) && ($_SESSION['int_loc']) && ($_SESSION['int_dur']) && ($_SESSION['mail']) && ($_SESSION['int_com_id']) && ($_SESSION['int_com_email']) && ($_SESSION['int_id'])){
            $internship_topic = $_SESSION['int_topic'];
            $internship_location = $_SESSION['int_loc'];
            $internship_duration = $_SESSION['int_dur'];
            $email = $_SESSION['mail'];
            $internship_com_id = $_SESSION['int_com_id'];
            $internship_com_email = $_SESSION['int_com_email'];
            $internship_int_id = $_SESSION['int_id'];
            $applydate = date('Y-m-d');
            $status	= "Applied & Forwarded to Admin";

            $search = "SELECT id AS stu_id FROM student WHERE email = '$email'";
            $find = $conn->query($search);
            if(mysqli_num_rows($find)>0){
                while($row = mysqli_fetch_array($find)){
                    $stu_id = $row["stu_id"];
                }
            }

            $query = "INSERT INTO `internship_application_details` (cover_letter, availability, availability_spec, assessment, apply_date, com_email, com_id, internship_id, stu_email, stu_id) VALUES ('$cover_letter', '$availability', '$availability_spec', '$assessment', '$applydate', '$internship_com_email', '$internship_com_id', '$internship_int_id', '$email', '$stu_id')";
            mysqli_query($conn, $query);

            $sql = "INSERT INTO `internship_applied` (`internship_id`, `profile`, `location`, `duration`, `status`, `stu_id`, `stu_email`, `com_id`, `com_email`) VALUES ('$internship_int_id', '$internship_topic', '$internship_location', '$internship_duration', '$status', '$stu_id', '$email', '$internship_com_id', '$internship_com_email')";
            mysqli_query($conn, $sql);

            unset($_SESSION['int_topic']);
            unset($_SESSION['int_loc']);
            unset($_SESSION['int_dur']);
            unset($_SESSION['int_com_id']);
            unset($_SESSION['int_com_email']);
            unset($_SESSION['int_id']);
        } else {
            echo "<script>alert('Error: Session is not working.')</script>";
        }

        echo
        "<script> alert('Application submitted successfully'); </script>";

        header("Location:../Internship/internship.php");
    
    }

?>

<!-- body -->
<body>
    <a href="../Internship/internship.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 2.2%;"></i></a>
    <div class="applyHeading"><h1>Applying for Internship</h1></div>

    <form action="#" method="POST" class="applicationForm">
        
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

        <div class="assesment takeTest">
            <h2>Take Test</h2>
            <p>In the next step you'll be facing 10 multiple choice questions based on the internship/job you are applying for. If you able to score 70% marks (7 correct out of 10 questions), then your application will be sucessfully submitted otherwise you can take the test again.
            <br>
            <br>
            Good luck
            </p>
        </div>


        <button class="internshipApplybtn" type="submit" name="submit" onclick="redirectToAnotherPage()">Submit</button>
        <!-- onclick="redirectToAnotherPage()" -->

        </form>


        <!-- <script>
            function redirectToAnotherPage() {
            window.location.href = "testInternship.php";
            }
        </script> -->
</body>
</html>
