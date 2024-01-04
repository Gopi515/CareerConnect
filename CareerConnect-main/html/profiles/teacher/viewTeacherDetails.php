<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Details</title>
    <link rel="stylesheet" href="../../../style.css?v=<?php echo time(); ?>">
    
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<?php 
    session_start();
    require '../../../dbconnect.php';

    if (isset($_SESSION['mail'])){
        $email = $_SESSION['mail'];
    } else {
        echo "<script>alert('Error: Session is not working.')</script>";
    }
    $sql = "SELECT * FROM `tech_personal_details` WHERE `email` = '$email'";
    $teacher_details = $conn->query($sql);

?>

<body>

    <!-- wrapper -->
    <div id="wrapper">

        <!-- navbar -->
        <nav id="navbar">

            <div class="container">

                <div class="logo">CareerConnect</div>

                <ul class="nav-links">
                    <li><a href="#"><i class="fas fa-bookmark"></i></a></li>
                    <li><a href="#"><i class="fas fa-message"></i></a></li>
                    <li><a href="#"><i class="fas fa-user"></i></a></li>
                </ul>

            </div>

        </nav>

        <?php
            while($row = mysqli_fetch_assoc($teacher_details)){
        ?>

        <!-- main container -->
        <form action="#" method="POST"  class="tech-container">
            
            <!-- header -->
            <div class="tech-header">
                

            </div>

            <!-- entry boxes -->
            <div class="tech-hero-section">

                <div class="tech-entry-boxes1">

                    <div class="tech-first-name">
                        <p class="tech-para-style1">First name</p>
                        <div class="tech-box-design1 view-details">
                            <?php echo $row["F_name"];?>
                        </div>
                    </div>

                    <div class="tech-last-name">
                        <p class= "tech-para-style1">Last name</p>
                        <div class="tech-box-design1 view-details">
                            <?php echo $row["L_name"];?>
                        </div>
                    </div>

                </div>

                <div class="tech-entry-boxes2">

                    <div class="tech-email">
                        <p class="tech-para-style1">Email</p>
                        <div class="tech-email-box">
                            <?php echo $row["email"];?>
                        </div>

                    </div>

                </div>

                <div class="tech-entry-boxes3">

                    <p class="tech-para-style1">Contact number</p>
                    <!-- country code dropdown --> 
                    <div class="mob-code">
                        <div id="country-code" class="view-details">
                            <?php echo $row["phone_code"];?>
                        </div>
                        <div class="mob-box view-details"> 
                            <?php echo $row["phone_no"];?>
                        </div>
                    </div>

                </div>

                <div class="tech-address">
                    <p class="tech-para-style1">Address</p>
                    <p class="tech-para">To connect you with opportunities closer to you</p>
                </div>

                <div class="tech-entry-boxes2">

                    <div class="tech-address1">
                        <p class="tech-para-style2">Address1</p>
                        <div class="tech-box-design2 view-details">
                            <?php echo $row["addr1"];?>
                        </div>
                    </div>

                    <div class="tech-address2">
                        <p class="tech-para-style2">Address2</p>
                        <div class="tech-box-design2 view-details"><?php echo $row["addr2"];?></div>
                    </div>

                </div>

                <div class="tech-entry-boxes4">

                    <div class="pin-state">

                        <div class="tech-pin">
                            <p class="tech-para-style2">Pin</p>
                            <div class="tech-box-design3 view-details"><?php echo $row["pin"];?></div>
                        </div>

                        <div class="tech-state">
                            <p class="tech-para-style2">State</p>
                            <div class="tech-box-design3 view-details"><?php echo $row["state"];?></div>
                        </div>

                    </div>

                    <div class="city-country">

                        <div class="tech-city">
                            <p class="tech-para-style2">City</p>
                            <div class="tech-box-design3 view-details"><?php echo $row["city"];?></div>
                        </div>

                        <div class="tech-country">
                            <p class="tech-para-style2">Country</p>
                            <div class="tech-box-design3 view-details">
                                <?php echo $row["country"];?>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- gender button -->

                
                


                <!-- select languages -->

                <div class="tech-language">
                   
                </div>



            </div>

          
            <!-- end next button  -->


        </form>

        <?php

        }
        ?>

    </div>


</body>
</html>