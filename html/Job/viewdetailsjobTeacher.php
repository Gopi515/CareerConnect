<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../LoginandRegister/teacherLogin.php");
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

    $sql_query = "SELECT * FROM job WHERE id = $id";
    $result=$conn->query($sql_query);
?>

<body style="height: 290vh;">
    
    <a href="../Job/jobTeacher.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 48px; margin-top: 5.6%; margin-left: 8%;"></i></a>
    
    <!-- php -->

    <?php
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <h1 class="detailsHeading"><?php echo $row["Topic"]; ?></h1>

                <div class="mainDetailscontainer">
                    <h3 class="detailsContainerheading"><?php echo $row["Topic"]; ?></h3>
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
                555 Applications
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

                <?php
            }
        }
    ?>
</body>
</html>