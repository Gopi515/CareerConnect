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
    <title>Update Teacher Details</title>
    <link rel="stylesheet" href="../../../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<?php 
    require '../../../../dbconnect.php';

    if(isset($_GET['id'])) {
    $tech_id = $_GET['id'];
    } else {
        echo "Teacher ID not found in the URL.";
    }

    $sql = "SELECT * FROM `tech_personal_details` WHERE `tech_id` = '$tech_id'";
    $teacher_details = $conn->query($sql);

    if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars($_POST['email']);
        $countrycode = htmlspecialchars($_POST['countrycode']);
        $mobilenumber = htmlspecialchars($_POST['mobilenumber']);
        $address1 = htmlspecialchars($_POST['address1']);
        $address2 = htmlspecialchars($_POST['adderss2']);
        $pincode = htmlspecialchars($_POST['pincode']);
        $city = htmlspecialchars($_POST['city']);
        $state = htmlspecialchars($_POST['state']);
        $country = htmlspecialchars($_POST['country']);
        $gender = $_POST['gender'];
        // $language = $_POST['language'];
        // to convert array to string in php we use implode
        // $lang = implode(",",$language);

        if (
            !empty($firstname) && !empty($lastname) && !empty($email) && !empty($countrycode) &&
            !empty($mobilenumber) && !empty($address1) && !empty($address2) && !empty($pincode) &&
            !empty($state) && !empty($city) && !empty($country) && !empty($gender) 
            // && !empty($lang)
        ) {

            // $checkmobile = "SELECT * FROM `tech_personal_details` WHERE `phone_no` = '$mobilenumber'";
            // $result = mysqli_query($conn, $checkmobile);
            // $count = mysqli_num_rows($result);

            // if ($count > 1) {
            //     header("location: ./teacher.php");
            //     exit;
            // }


            // $query = "SELECT id AS tech_id FROM teacher WHERE email = '$email'";
            // $find = $conn->query($query);
            // if (mysqli_num_rows($find) > 0) {
            //     while ($row = mysqli_fetch_array($find)) {
            //         $tech_id = $row["tech_id"];
            //     }
            // }


            $updatedata = "UPDATE `tech_personal_details` SET `F_name` = '$firstname', `L_name` = '$lastname', `phone_code`='$countrycode', `phone_no` = '$mobilenumber', 
                    `addr1` = '$address1', `addr2` = '$address2', `pin` = '$pincode', `state` = '$state', `city` = '$city', 
                    `country` = '$country', `gender` = '$gender' WHERE `tech_id` = '$tech_id'";
                    // , `languages` = '$lang' WHERE `email` = '$email'";

            $smt = mysqli_query($conn, $updatedata);


            if ($smt) {
                header("location: ../list/teacherlist.php");
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
            while($row = mysqli_fetch_assoc($teacher_details)){
        ?>

        <a href="../list/teacherlist.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 7.5%;"></i></a>

        <!-- main container -->
        <form action="#" method="POST"  class="tech-container">
            
            <!-- header -->
            <div class="tech-header">
                

            </div>

            <!-- entry boxes -->
            <div class="tech-hero-section">

                <div class="tech-entry-boxes1">

                    <div class="tech-first-name">
                        <p class="tech-para-style1">First name*</p>
                        <input name="firstname" type="text" placeholder="Enter first name" value="<?php echo $row["F_name"];?>" class="tech-box-design1" required>
                    </div>

                    <div class="tech-last-name">
                        <p class= "tech-para-style1">Last name*</p>
                        <input name="lastname" type="text" placeholder="Enter last name" value="<?php echo $row["L_name"];?>" class="tech-box-design1" required>
                    </div>

                </div>

                <div class="tech-entry-boxes2">

                    <div class="tech-email">
                        <p class="tech-para-style1">Email*</p>
                        <div class="tech-email-box"><?php echo $row["email"];?></div>
                        <input type="hidden" name="email" value="<?php echo $row["email"];?>" style="display: none;">
                        
                    </div>

                </div>

                <div class="tech-entry-boxes3">

                    <p class="tech-para-style1">Contact number*</p>
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

                <div class="tech-address">
                    <p class="tech-para-style1">Address</p>
                    <p class="tech-para">To connect you with opportunities closer to you</p>
                </div>

                <div class="tech-entry-boxes2">

                    <div class="tech-address1">
                        <p class="tech-para-style2">Address1*</p>
                        <input name="address1" type="text" placeholder="Ex.-House no, Building, Street, Area" value="<?php echo $row["addr1"];?>" class="tech-box-design2" required>
                    </div>

                    <div class="tech-address2">
                        <p class="tech-para-style2">Address2*</p>
                        <input name="adderss2" type="text" placeholder="Ex.-Locality/Town, City/District" value="<?php echo $row["addr2"];?>" class="tech-box-design2" required>
                    </div>

                </div>

                <div class="tech-entry-boxes4">

                    <div class="pin-state">

                        <div class="tech-pin">
                            <p class="tech-para-style2">Pin*</p>
                            <input name="pincode" type="number" placeholder="Enter pin" value="<?php echo $row["pin"];?>" class="tech-box-design3" required>
                        </div>

                        <div class="tech-state">
                            <p class="tech-para-style2">State*</p>
                            <input name="state" type="text" placeholder="Enter state" value="<?php echo $row["state"];?>" class="tech-box-design3" required>
                        </div>

                    </div>

                    <div class="city-country">

                        <div class="tech-city">
                            <p class="tech-para-style2">City*</p>
                            <input name="city" type="text" placeholder="Enter city" value="<?php echo $row["city"];?>" class="tech-box-design3" required>
                        </div>

                        <div class="tech-country">
                            <p class="tech-para-style2">Country*</p>
                            <input name="country" type="text" placeholder="Enter country" value="<?php echo $row["country"];?>" class="tech-box-design3" required>
                        </div>

                    </div>
                </div>


                <!-- gender button -->

                
                <div class="tech-gender">
                    <p class="tech-para-style1">Gender*</p>
                    <div class="gender-selection">
                        <div class="male">
                            <input type="radio" id="male" name="gender" value="male" class="radio" checked>
                            <label for="male" class="gen-label label-1">Male</label>
                        </div>
                        <div class="female">
                            <input type="radio" id="female" name="gender" value="female" class="radio">
                            <label for="female" class="gen-label label-2">Female</label>
                        </div>
                        <div class="others">
                            <input type="radio" id="others" name="gender" value="others" class="radio">
                            <label for="others" class="gen-label label-3">Others</label>
                        </div>
                    </div> 
                </div> 


                <!-- select languages -->

                <div class="tech-language">
                   
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