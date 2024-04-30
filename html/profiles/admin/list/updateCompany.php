<?php
    session_start();
    if (!isset($_SESSION['mail'])) {
        header("Location: ../../../LoginandRegister/adminLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Company Details</title>
    <link rel="stylesheet" href="../../../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<?php 
    require '../../../../dbconnect.php';

    if(isset($_GET['id'])) {
    $com_id = $_GET['id'];
    } else {
        echo "Company ID not found in the URL.";
    }

    $sql = "SELECT * FROM `com_personal_details` WHERE `com_id` = '$com_id'";
    $company_details = $conn->query($sql);

    if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $countrycode = htmlspecialchars($_POST['countrycode']);
        $mobilenumber = htmlspecialchars($_POST['mobilenumber']);
        $address1 = htmlspecialchars($_POST['address1']);
        $address2 = htmlspecialchars($_POST['adderss2']);
        $pincode = htmlspecialchars($_POST['pincode']);
        $city = htmlspecialchars($_POST['city']);
        $state = htmlspecialchars($_POST['state']);
        $country = htmlspecialchars($_POST['country']);
        $website = htmlspecialchars($_POST['website']);
        $about = htmlspecialchars($_POST['about']);

        if (
            !empty($name) && !empty($email) && !empty($countrycode) && !empty($mobilenumber) &&
            !empty($address1) && !empty($address2) && !empty($pincode) &&
            !empty($state) && !empty($city) && !empty($country) && !empty($website) && !empty($about)
        ) {


            // $checkmobile = "SELECT * FROM `com_personal_details` WHERE `phone_no` = '$mobilenumber'";
            // $result = mysqli_query($conn, $checkmobile);
            // $count = mysqli_num_rows($result);

            // if ($count != 0) {
            //     header("location: ./company.php");
            //     exit;
            // }

            // $query = "SELECT id AS com_id FROM company WHERE email = '$email'";
            // $find = $conn->query($query);
            // if (mysqli_num_rows($find) > 0) {
            //     while ($row = mysqli_fetch_array($find)) {
            //         $com_id = $row["com_id"];
            //     }
            // }

            $updatedata = "UPDATE `com_personal_details` SET `name` = '$name', `phone_code`='$countrycode', `phone_no` = '$mobilenumber', 
                    `addr1` = '$address1', `addr2` = '$address2', `pin` = '$pincode', `city` = '$city', `state` = '$state', 
                    `country` = '$country', `c_website` = '$website', `c_about` = '$about' WHERE `com_id` = '$com_id'";

            $smt = mysqli_query($conn, $updatedata);

            if ($smt) {
                header("location: ../list/companylist.php");
                exit;
            } else {
                echo "<script>alert('Error: Data update failed. Please try again later.');</script>";
                error_log("Database error: " . mysqli_error($conn));
            }

        } else {
            echo "<script>alert('Error: Please enter all the field.')</script>";
        }


    }

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

        <a href="../list/companylist.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 7.5%;"></i></a>

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
                        <p class="com-para-style1">Company name*</p>
                        <input name="name" type="text" placeholder="Enter the name" value="<?php echo $row["name"];?>" class="com-box-design1" required>
                    </div>
                </div>

                <!-- email  -->
                <div class="com-entry-boxes1">

                    <div class="com-email">
                        <p class="com-para-style1">Email*</p>
                        <div class="com-email-box"><?php echo $row["email"];?></div>
                        <input type="hidden" name="email" value="<?php echo $row["email"];?>" style="display: none;">
                    </div>

                </div>

                <!-- contact no  -->
                <div class="com-entry-boxes2">

                    <p class="com-para-style1">Contact number*</p>
                    <!-- country code dropdown -->
                    <select name="countrycode" id="country-code">
                        <option value="+91">+91</option>
                        <option value="+880">+880</option>
                        <option value="+977">+977</option>
                        <option value="+7">+7</option>
                        <option value="+1">+1</option>
                        <option value="+49">+49</option>
                        <option value="+33">+33</option>
                        <!-- Add more options for other countries -->
                    </select>
                    <input name="mobilenumber" type="tel" placeholder="0000000000" value="<?php echo $row["phone_no"];?>" class="mob-box" pattern="\d{10}" maxlength="10" required>

                </div>

                <!-- date of arrival  -->
                <div class="com-entry-boxes2">

                    <div class="com-arrival">
                        <p class="com-para-style1">Date of Arrival*</p>
                        <div class="com-arr-date">
                        <?php echo $row["DOA"];?>
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
                        <p class="com-para-style2">Address1*</p>
                        <input name="address1" type="text" placeholder="Ex.-House no, Building, Street, Area" value="<?php echo $row["addr1"];?>" class="com-box-design1" required>
                    </div>

                    <div class="com-address2">
                        <p class="com-para-style2">Address2*</p>
                        <input name="adderss2" type="text" placeholder="Ex.-Locality/Town, City/District" value="<?php echo $row["addr2"];?>" class="com-box-design1" required>
                    </div>

                </div>

                <div class="com-entry-boxes3">

                    <div class="pin-state">

                        <div class="com-pin">
                            <p class="com-para-style2">Pin*</p>
                            <input name="pincode" type="number" placeholder="Enter pin" value="<?php echo $row["pin"];?>" class="com-box-design2" required>
                        </div>

                        <div class="com-state">
                            <p class="com-para-style2">State*</p>
                            <input name="state" type="text" placeholder="Enter state" value="<?php echo $row["state"];?>" class="com-box-design2" required>
                        </div>

                    </div>

                    <div class="city-country">

                        <div class="com-city">
                            <p class="com-para-style2">City*</p>
                            <input name="city" type="text" placeholder="Enter city" value="<?php echo $row["city"];?>" class="com-box-design2" required>
                        </div>

                        <div class="com-country">
                            <p class="com-para-style2">Country*</p>
                            <input name="country" type="text" placeholder="Enter country" value="<?php echo $row["country"];?>" class="com-box-design2" required>
                        </div>

                    </div>
                </div>


                <!-- compani link -->

                <div class="com-link">
                    <p class="com-para-style1">Company website*</p>
                    <div>
                        <input  name="website" type="url" placeholder="Enter the link of your website" value="<?php echo $row["c_website"];?>" class="com-box-design1" required>
                    </div>
                </div>


                <!-- about section -->

                <div class="com-about">


                    <p class="com-para-style1">About*</p>
                    <div>
                        <input  name="about" type="text" placeholder="Write about your company" value="<?php echo $row["c_about"];?>" class="com-box-design1" required>
                    </div>
                   
                </div>

            </div>

          
            <!-- end next button  -->
            <button value="update" name="update" class="btn submit-btn">Submit</button>


        </form>

        <?php

            }
        ?>

    </div>

    
</body>
</html>