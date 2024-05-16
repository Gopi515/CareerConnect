<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../LoginandRegister/studentLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
    <title>Job details</title>
</head>

<!-- php -->
<?php
    include_once("../../dbconnect.php");

    $id = "";
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
    }

    $sql_query = "SELECT j.*, c.name, COUNT(a.id) AS id_count 
    FROM job j
    LEFT JOIN job_applied a ON j.id = a.job_id
    LEFT JOIN com_personal_details c ON j.com_id = c.id
    WHERE j.id = $id
    GROUP BY a.job_id";
    $result=$conn->query($sql_query);

    $query = "SELECT * FROM job WHERE id = '$id'";
    $find = $conn->query($query);
    if (mysqli_num_rows($find) > 0) {
        while ($row = mysqli_fetch_array($find)) {
            $job_topic = $row["topic"];
            $job_location = $row["location_name"];
            $job_com_id = $row["com_id"];
            $job_com_email = $row["com_email"];
            $job_id = $row["id"];
        }
    }

    $_SESSION['Job_topic'] = $job_topic;
    $_SESSION['Job_loc'] = $job_location;
    $_SESSION['job_com_id'] = $job_com_id;
    $_SESSION['job_com_email'] = $job_com_email;
    $_SESSION['job_id'] = $job_id;

?>

<body style="height: 290vh;">
    
    <a href="../Job/job.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 48px; margin-top: 5.6%; margin-left: 8%;"></i></a>
    
    <!-- php -->

    <?php
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <h1 class="detailsHeading"><?php echo $row["topic"]; ?></h1>

                <div class="mainDetailscontainer">
                    <h3 class="detailsContainerheading"><?php echo $row["topic"]; ?></h3>
                    <p class="company_name"><?php echo $row["name"]; ?></p>
                    <div class="detailsloaction">
                    <h4><i class="fa-solid fa-location-dot"></i><?php echo $row["location_name"]; ?></h4>
                </div>
                    <div class="otherDetails">
                    <div class="detailsDuration">
                    <h4 class="detailsType"><i class="fa-solid fa-calendar-days"></i> Experience</h4>
                    <h4 class="detailsData"><?php echo $row["experience"]; ?></h4>
                </div>
                <div class="detailsStipend">
                    <h4 class="detailsType"><i class="fa-solid fa-sack-dollar"></i> CTC</h4>
                    <h4 class="detailsData">₹ <?php echo $row["CTC"]; ?>/annum</h4>
                </div>
                <div class="detailsApplyby">
                    <h4 class="detailsType"><i class="fa-solid fa-hourglass-start"></i> Apply By</h4>
                    <h4 class="detailsData"><?php echo $row["apply_by"]; ?></h4>
                </div>
                </div>
        
                <h4 class="noofApplicationdetails">
                <i class="fa-solid fa-user-group"></i>
                <?php echo $row["id_count"];?> Applications
                </h4>

                <div class="detailsContaineroptions">
                <i class="bookmark fa-solid fa-bookmark"></i>
                <i class="share fa-solid fa-share-nodes"></i>
                </div>
                </div>

                <div class="companyAbout">
                <h3>About company</h3>
                <p class="companyWebsite">Website <i class="fa-solid fa-arrow-up-right-from-square"></i></p>
                <p>Computer vision software and services for the education and healthcare industries. We are based in Atlanta, GA.</p>
                </div>

                <div class="internshipAbout">
                <h3>About the job</h3>
                <p>Key responsibilities:
                <br>
                <br>
                <?php echo $row["about_job"]; ?>
                </p>
                </div>

                <div class="internshipAbout2">
                <h3>Additional Information</h3>
                <p>
                <br>
                <br>
                <?php echo $row["additional_info"]; ?>
                </p>
                </div>

                <div class="jobSkillsrequire">                                 
                <h3>Skill(s) required</h3>
                <p><?php echo $row["required_skills"]; ?></p>
                </div>

                <div class="jobOpenings">
                <h3>Number of openings</h3>
                <p><?php echo $row["openings"]; ?></p>
                </div>


                <a href="../Job/applyJob.php" class="detailsApplybuttonJob">Apply</a>
                <?php
            }
        }
    ?>
</body>
</html>