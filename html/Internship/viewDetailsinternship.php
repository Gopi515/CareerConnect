<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../LoginandRegister/studentLogin.php");
    }
?>

<!-- html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
    <title>Internship details</title>
</head>

<!-- php -->
<?php
    include_once("../../dbconnect.php");

    $id = "";
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
    }

    $sql_query = "SELECT i.*, c.name, COUNT(a.id) AS id_count 
    FROM internships i
    LEFT JOIN internship_applied a   ON i.id = a.internship_id
    LEFT JOIN com_personal_details c ON i.com_id = c.id
    WHERE i.id = $id
    GROUP BY a.internship_id";
    $result=$conn->query($sql_query);

    $query = "SELECT * FROM internships WHERE id = '$id'";
    $find = $conn->query($query);
    if (mysqli_num_rows($find) > 0) {
        while ($row = mysqli_fetch_array($find)) {
            $internship_topic = $row["topic"];
            $internship_location = $row["location_name"];
            $internship_duration = $row["duration"];
            $internship_com_id = $row["com_id"];
            $internship_com_email = $row["com_email"];
            $internship_int_id = $row["id"];
        }
    }

    $_SESSION['int_topic'] = $internship_topic;
    $_SESSION['int_loc'] = $internship_location;
    $_SESSION['int_dur'] = $internship_duration;
    $_SESSION['int_com_id'] = $internship_com_id;
    $_SESSION['int_com_email'] = $internship_com_email;
    $_SESSION['int_id'] = $internship_int_id;
?>

<body style="height: 230vh;">
    
    <a href="../Internship/internship.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 48px; margin-top: 5.6%; margin-left: 8%;"></i></a>
    
    
    <!-- php -->

    <?php
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <h1 class="detailsHeading"><?php echo $row["topic"];?></h1>

                <div class="mainDetailscontainer">
                    <h3 class="detailsContainerheading"><?php echo $row["topic"]; ?></h3>
                    <p class="company_name"><?php echo $row["name"]; ?></p>
                    <div class="detailsloaction">
                    <h4><i class="fa-solid fa-location-dot"></i><?php echo $row["location_name"];?></h4>
                </div>
                    <div class="otherDetails">
                    <div class="detailsDuration">
                    <h4 class="detailsType"><i class="fa-solid fa-calendar-days"></i> Duration</h4>
                    <h4 class="detailsData"><?php echo $row["duration"];?></h4>
                </div>
                <div class="detailsStipend">
                    <h4 class="detailsType"><i class="fa-solid fa-sack-dollar"></i> Stipend</h4>
                    <h4 class="detailsData">₹ <?php echo $row["stipend"];?>/month</h4>
                </div>
                <div class="detailsApplyby">
                    <h4 class="detailsType"><i class="fa-solid fa-hourglass-start"></i> Apply By</h4>
                    <h4 class="detailsData"><?php echo $row["apply_by"];?></h4>
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
                <h3>About the internship</h3>
                <p>Key responsibilities:
                <br>
                <br>
                <?php echo $row["about_internship"];?>
                </p>
                </div>

                <div class="internshipSkillsrequire">                                 
                <h3>Skill(s) required</h3>
                <p><?php echo $row["required_skills"];?></p>
                </div>

                <div class="internshipOpenings">
                <h3>Number of openings</h3>
                <p><?php echo $row["openings"];?></p>
                </div>


                <a href="../Exam/takeExam.php" class="detailsApplybutton">Apply</a>
    <?php
            }
        }
    ?>
    
    
</body>
</html>