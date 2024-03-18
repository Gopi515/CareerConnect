<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../../LoginandRegister/companyLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company profile</title>
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
    $sql = "SELECT * FROM `com_personal_details` WHERE `email` = '$email'";
    $company_details = $conn->query($sql);

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
            while($row = mysqli_fetch_assoc($company_details)){
        ?>

        <a href="../../landingPage/landingCompany.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 7.5%;"></i></a>

        <!-- main container -->
        <form action="#" method="POST"  class="com-container">

            <!-- header -->
            <div class="com-header">

            </div>

            <!-- entry boxes -->
            <div class="com-hero-section">

                <!-- company name  -->
                <div class="com-entry-boxes1">

                    <div class="com-name">
                        <p class="com-para-style1">Company name</p>
                        <div class="com-box-design1 view-details"><?php echo $row["name"];?></div>
                    </div>


                </div>

                <!-- email  -->
                <div class="com-entry-boxes1">

                    <div class="com-email">
                        <p class="com-para-style1">Email</p>
                        <div class="com-email-box">
                        <?php echo $row["email"];?>
                        </div>

                    </div>

                </div>

                <!-- contact no  -->
                <div class="com-entry-boxes2">

                    <p class="com-para-style1">Contact number</p>
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

                <!-- date of arrival  -->
                <div class="com-entry-boxes2">

                    <div class="com-arrival">
                        <p class="com-para-style1">Date of Arrival</p>
                        <div class="com-arr-date">
                        <?php echo $row["DOA"];?><i class="fa-regular fa-calendar"></i>
                        </div>
                    </div>

                </div>

                <!-- address  -->

                <div class="com-address">
                    <p class="com-para-style1">Address</p>
                    <p class="com-para">To connect you with opportunities closer to you</p>
                </div>

                <div class="com-entry-boxes1">

                    <div class="com-address1">
                        <p class="com-para-style2">Address1</p>
                        <div class="com-box-design1 view-details">
                        <?php echo $row["addr1"];?>
                        </div>
                    </div>

                    <div class="com-address2">
                        <p class="com-para-style2">Address2</p>
                        <div class="com-box-design1 view-details">
                        <?php echo $row["addr2"]; ?>
                        </div>
                    </div>

                </div>

                <div class="com-entry-boxes3">

                    <div class="pin-state">

                        <div class="com-pin">
                            <p class="com-para-style2">Pin</p>
                            <div class="com-box-design2 view-details"><?php echo $row["pin"];?></div>
                        </div>

                        <div class="com-state">
                            <p class="com-para-style2">State</p>
                            <div class="com-box-design2 view-details"><?php echo $row["state"]; ?></div>
                        </div>

                    </div>

                    <div class="city-country">

                        <div class="com-city">
                            <p class="com-para-style2">City</p>
                            <div class="com-box-design2 view-details"><?php echo $row["city"]; ?></div>
                        </div>

                        <div class="com-country">
                            <p class="com-para-style2">Country</p>
                            <div class="com-box-design2 view-details"><?php echo $row["country"]; ?></div>
                        </div>

                    </div>
                </div>


                <!-- compani link -->

                <div class="com-link">
                    <p class="com-para-style1">Company website</p>
                    <div>
                        <div class="com-box-design1 view-details"> <?php echo $row["c_website"]; ?></div>
                    </div>
                </div>


                <!-- about section -->

                <div class="com-about">


                    <p class="com-para-style1">About</p>
                    <div>
                        <div class="com-box-design1 view-details"><?php echo $row["c_about"]; ?></div>
                    </div>
                   
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