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
    <title>Update Your Details</title>
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

    if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

        $stu_id = htmlspecialchars($_POST['hidden_stu_id']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $dept = htmlspecialchars($_POST['dept']);
        $start_year = htmlspecialchars($_POST['start_year']);
        $end_year = htmlspecialchars($_POST['end_year']);
        $countrycode = htmlspecialchars($_POST['countrycode']);
        $mobilenumber = htmlspecialchars($_POST['mobilenumber']);
        $address1 = htmlspecialchars($_POST['address1']);
        $address2 = htmlspecialchars($_POST['adderss2']);
        $pincode = htmlspecialchars($_POST['pincode']);
        $city = htmlspecialchars($_POST['city']);
        $state = htmlspecialchars($_POST['state']);
        $country = htmlspecialchars($_POST['country']);
        $gender = htmlspecialchars($_POST['gender']);
        // $language = $_POST['language'];
        // to convert array to string in php we use implode
        // $lang = implode(",",$language);

        if (
            !empty($firstname) && !empty($lastname) && !empty($countrycode) && !empty($email) && !empty($dept) &&
            !empty($mobilenumber) && !empty($address1) && !empty($address2) && !empty($pincode) && !empty($start_year) && 
            !empty($end_year) && !empty($state) && !empty($city) && !empty($country) && !empty($gender) && !empty($stu_id)
        ) {
            // && !empty($lang)

            // $checkmobile = "SELECT * FROM `stu_personal_details` WHERE `phone_no` = '$mobilenumber'";
            // $result = mysqli_query($conn, $checkmobile);
            // $count = mysqli_num_rows($result);

            // if ($count <= 1) {
            //     header("location: ./updateStudentDetails.php");
            //     exit;
            // }

            $updatedata = "INSERT INTO `temp_stu_personal_details`(`stu_id`, `F_name`, `L_name`, `dept`, `phone_code`, `phone_no`, `start_year`, 
                        `end_year`, `addr1`, `addr2`, `pin`, `city`, `state`, `country`, `gender`) VALUES ('$stu_id','$firstname','$lastname',
                        '$dept','$countrycode','$mobilenumber','$start_year','$end_year','$address1','$address2','$pincode','$city',
                        '$state','$country','$gender')";

            $smt = mysqli_query($conn, $updatedata);

            if ($smt) {
                echo"
                <script>
                    alert('Profile update under verification.');
                    document.location.href = '../../landingPage/landingStudent.php';
                </script>
                ";
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
                        <p class="stu-para-style1">First name*</p>
                        <input name="firstname" type="text" placeholder="Enter first name" value="<?php echo $row["F_name"];?>" class="stu-box-design1" required>
                    </div>

                    <div class="stu-last-name">
                        <p class="stu-para-style1">Last name*</p>
                        <input name="lastname" type="text" placeholder="Enter last name" value="<?php echo $row["L_name"];?>" class="stu-box-design1" required>
                    </div>

                </div>

                <div class="stu-entry-boxes2">

                    <div class="stu-email department">
                        <p class="stu-para-style1">Department*</p>
                        <input name="dept" type="text" placeholder="Eg: department name _ ID" value="<?php echo $row["dept"];?>" class="stu-email-box" required>
                    </div>

                    <div class="stu-email">
                        <p class="stu-para-style1">Email*</p>
                        <div class="stu-email-box"><?php echo $row["email"];?></div>
                    </div>

                </div>

                <div class="stu-addresses">
                    <p class="stu-para-style1">Batch</p>
                    <p class="stu-para">Only enter the starting year and ending year.</p>
                </div>
                <div class="stu-entry-boxes1">
                    <div class="stu-start-year">
                        <p class="stu-para-style2">Start Year*</p>
                        <input name="start_year" type="number" placeholder="Enter start year" value="<?php echo $row["start_year"];?>" class="stu-box-design3" min="1900" max="2200" step="1" required>
                    </div>
                    <div class="stu-end-year">
                        <p class="stu-para-style2">End Year*</p>
                        <input name="end_year" type="number" placeholder="Enter end year" value="<?php echo $row["end_year"];?>" class="stu-box-design3" min="1900" max="2200" step="1" required>
                    </div>
                </div>

                <div class="stu-entry-boxes3">

                    <p class="stu-para-style1">Contact number*</p>
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

                <div class="stu-address">
                    <p class="stu-para-style1">Address</p>
                    <p class="stu-para">To connect you with opportunities closer to you</p>
                </div>

                <div class="stu-entry-boxes2">

                    <div class="stu-address1">
                        <p class="stu-para-style2">Address1*</p>
                        <input name="address1" type="text" placeholder="Ex.-House no, Building, Street, Area" value="<?php echo $row["addr1"];?>" class="stu-box-design2" required>
                    </div>

                    <div class="stu-address2">
                        <p class="stu-para-style2">Address2*</p>
                        <input name="adderss2" type="text" placeholder="Ex.-Locality/Town, City/District" value="<?php echo $row["addr2"];?>" class="stu-box-design2" required>
                    </div>

                </div>

                <div class="stu-entry-boxes4">

                    <div class="pin-state">

                        <div class="stu-pin">
                            <p class="stu-para-style2">Pin*</p>
                            <input name="pincode" type="number" placeholder="Enter pin" value="<?php echo $row["pin"];?>" class="stu-box-design3" required>
                        </div>

                        <div class="stu-state">
                            <p class="stu-para-style2">State*</p>
                            <input name="state" type="text" placeholder="Enter state" value="<?php echo $row["state"];?>" class="stu-box-design3" required>
                        </div>

                    </div>

                    <div class="city-country">

                        <div class="stu-city">
                            <p class="stu-para-style2">City*</p>
                            <input name="city" type="text" placeholder="Enter city" value="<?php echo $row["city"];?>" class="stu-box-design3" required>
                        </div>

                        <div class="stu-country">
                            <p class="stu-para-style2">Country*</p>
                            <input name="country" type="text" placeholder="Enter country" value="<?php echo $row["country"];?>" class="stu-box-design3" required>
                        </div>

                    </div>
                </div>


                <!-- gender button -->


                <div class="stu-gender">
                    <p class="stu-para-style1">Gender*</p>
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

                <!-- hidden input field to store student id -->
                <input type="hidden" name="hidden_stu_id" value="<?php echo $row["stu_id"]; ?>" style="display: none;">

                <!-- select languages -->

                <div class="stu-language">
                    
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