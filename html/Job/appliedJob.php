<!-- php -->

<?php 

    require_once '../../dbconnect.php';

    $sql = "SELECT * FROM applied";
    $applied_internships = $conn->query($sql);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
    <title>Applied Job</title>
</head>
<body>
    <div class="appliedInternship">
    
    <div class="appliedHeading">
    <a href="../Job/job.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 2.2%;"></i></a>
        <h1>My Applications</h1>
    </div>


    <div class="applliedInternshiplist">
      <div class="appliedInternshipheading">
        <h2 class="appliedProfile">PROFILE</h2>
        <h2 class="appliedLocation">LOCATION</h2>
        <h2 class="appliedDuration">DURATION</h2>
        <h2>NUMBER OF APPLICANTS</h2>
        <h2>APPLICATION STATUS</h2>
      </div>

    <?php
         while($row = mysqli_fetch_assoc($applied_internships)){
    ?>
      <div class="appliedInternshipitems">
        <h2 class="appliedProfile"><?php echo $row["profile"]; ?> </h2>
        <h2 class="appliedLocation"><?php echo $row["location"]; ?> </h2>
        <h2 class="appliedDuration"><?php echo $row["duration"]; ?> </h2>
        <h2>1</h2>
        <h2 class="appliedStatus">Applied</h2>
      </div>

    <?php

    }
    ?>

    </div>

    </div>
</body>
</html>