<!-- php -->
<?php
    include_once("../../dbconnect.php");

    $id = "";
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
    }

    $sql_query = "SELECT * FROM internships WHERE id = $id";
    $result=$conn->query($sql_query);
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
<body style="height: 230vh;">
    
    <a href="../Internship/internship.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 48px; margin-top: 5.6%; margin-left: 8%;"></i></a>
    
    
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
                <div class="detailsloaction">
                <h4><i class="fa-solid fa-location-dot"></i><?php echo $row["location_name"]; ?></h4>
            </div>
                <div class="otherDetails">
                <div class="detailsDuration">
                <h4 class="detailsType"><i class="fa-solid fa-calendar-days"></i> Duration</h4>
                <h4 class="detailsData"><?php echo $row["duration"]; ?></h4>
            </div>
            <div class="detailsStipend">
                <h4 class="detailsType"><i class="fa-solid fa-sack-dollar"></i> Stipend</h4>
                <h4 class="detailsData">₹ <?php echo $row["stipend"]; ?>/month</h4>
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
            <h3>About the internship</h3>
            <p>Key responsibilities:
            <br>
            <br>
            <?php echo $row["about_internship"]; ?>
            </p>
            </div>

            <div class="internshipSkillsrequire">                                 
            <h3>Skill(s) required</h3>
            <p><?php echo $row["required_skills"]; ?></p>
            </div>

            <div class="internshipOpenings">
            <h3>Numder of openings</h3>
            <p><?php echo $row["openings"]; ?></p>
            </div>


            <a href="../Internship/applyInternship.php" class="detailsApplybuttonJob">Apply</a>
            <?php
        }
    }
    ?>
    
    
</body>
</html>