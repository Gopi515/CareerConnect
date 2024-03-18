<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../../LoginandRegister/studentLogin.php");
    }
?>

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
    require '../../../dbconnect.php';

    if (isset($_SESSION['mail'])){
        $email = $_SESSION['mail'];
    } else {
        echo "<script>alert('Error: Session is not working.')</script>";
    }
    $sql = "SELECT * FROM `stu_personal_details` WHERE `email` = '$email'";
    $student_details = $conn->query($sql);

?>

<body>

    <!-- wrapper -->
    <div id="wrapper">

        <!-- navbar -->
        <nav id="navbar">

            <div class="container">

                <div class="logo">CareerConnect</div>

                <ul class="nav-links">

                </ul>

            </div>

        </nav>

        <?php
            while($row = mysqli_fetch_assoc($student_details)){
        ?>

        <a href="../../landingPage/landingStudent.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 7.5%;"></i></a>

        <!-- main container -->
        <form action="#" method="POST"  class="stu-container">
            
            <!-- header -->
            <div class="stu-header">
                

            </div>

            <!-- entry boxes -->
            <div class="stu-hero-section">

                <div class="stu-entry-boxes1">

                    <div class="stu-first-name">
                        <p class="stu-para-style1">First name</p>
                        <div class="stu-box-design1 view-details">
                            <?php echo $row["F_name"];?>
                        </div>
                    </div>

                    <div class="stu-last-name">
                        <p class= "stu-para-style1">Last name</p>
                        <div class="stu-box-design1 view-details">
                            <?php echo $row["L_name"];?>
                        </div>
                    </div>

                </div>

                <div class="stu-entry-boxes2">

                    <div class="stu-email">
                        <p class="stu-para-style1">Email</p>
                        <div class="stu-email-box">
                            <?php echo $row["email"];?>
                        </div>

                    </div>

                </div>

                <div class="stu-entry-boxes3">

                    <p class="stu-para-style1">Contact number</p>
                    <!-- country code dropdown --> 
                    <div class="mob-code">
                        <div id="country-code" class="view-details">
                            +<?php echo $row["phone_code"];?>
                        </div>
                        <div class="mob-box view-details"> 
                            <?php echo $row["phone_no"];?>
                        </div>
                    </div>

                </div>

                <div class="stu-address">
                    <p class="stu-para-style1">Address</p>
                    <p class="stu-para">To connect you with opportunities closer to you</p>
                </div>

                <div class="stu-entry-boxes2">

                    <div class="stu-address1">
                        <p class="stu-para-style2">Address1</p>
                        <div class="stu-box-design2 view-details">
                            <?php echo $row["addr1"];?>
                        </div>
                    </div>

                    <div class="stu-address2">
                        <p class="stu-para-style2">Address2</p>
                        <div class="stu-box-design2 view-details">
                            <?php echo $row["addr2"];?>
                        </div>
                    </div>

                </div>

                <div class="stu-entry-boxes4">

                    <div class="pin-state">

                        <div class="stu-pin">
                            <p class="stu-para-style2">Pin</p>
                            <div class="stu-box-design3 view-details"><?php echo $row["pin"];?></div>
                        </div>

                        <div class="stu-state">
                            <p class="stu-para-style2">State</p>
                            <div class="stu-box-design3 view-details"><?php echo $row["state"];?></div>
                        </div>

                    </div>

                    <div class="city-country">

                        <div class="stu-city">
                            <p class="stu-para-style2">City</p>
                            <div class="stu-box-design3 view-details"><?php echo $row["city"];?></div>
                        </div>

                        <div class="stu-country">
                            <p class="stu-para-style2">Country</p>
                            <div class="stu-box-design3 view-details">
                                <?php echo $row["country"];?>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- gender button -->

                
                


                <!-- select languages -->

                <div class="stu-language">
                   
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