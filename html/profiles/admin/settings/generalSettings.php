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
    <title>Admin - General Settings</title>
    <link rel="stylesheet" href="../../../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<?php
require '../../../../dbconnect.php';

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    if (isset($_SESSION['mail'])) {
        $email = $_SESSION['mail'];
    } else {
        echo "<script>alert('Error: Session is not working.')</script>";
    }
    $countrycode = $_POST['countrycode'];
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
    ) {
        // && !empty($lang)

        $checkmobile = "SELECT * FROM `stu_personal_details` WHERE `phone_no` = '$mobilenumber'";
        $result = mysqli_query($conn, $checkmobile);
        $count = mysqli_num_rows($result);

        if ($count != 0) {
            header("location: ./admin.php");
            exit;
        }

        $query = "SELECT id AS admin_id FROM administration WHERE email = '$email'";
        $find = $conn->query($query);
        if (mysqli_num_rows($find) > 0) {
            while ($row = mysqli_fetch_array($find)) {
                $admin_id = $row["admin_id"];
            }
        }

        $insertdata = "INSERT INTO `stu_personal_details`(`admin_id`, `F_name`, `L_name`, `email`, `phone_code`,
                    `phone_no`, `addr1`, `addr2`, `pin`, `city`, `state`, `country`, `gender`) 
                    VALUES ('$admin_id','$firstname','$lastname','$email','$countrycode','$mobilenumber','$address1','$address2',
                    '$pincode','$city','$state','$country','$gender')";

        $smt = mysqli_query($conn, $insertdata);

        if ($smt) {
            header("location: ../admin.php");
            exit;
        } else {
            echo "<script>alert('Error: Data input failed. Please try again later.');</script>";
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
        <a href="../admin.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 7.5%;"></i></a>


        <!-- main container -->
        <form action="#" method="POST" class="stu-container">

            <!-- header -->
            <div class="stu-header">
                <p class="header-item1">Hi there admin!</p>
                <p class="header-item2">Please provide some basic details</p>
            </div>

            <!-- entry boxes -->
            <div class="stu-hero-section">

                <div class="stu-entry-boxes1">

                    <div class="stu-first-name">
                        <p class="stu-para-style1">Your First name*</p>
                        <input name="firstname" type="text" placeholder="Enter first name" class="stu-box-design1" required>
                    </div>

                    <div class="stu-last-name">
                        <p class="stu-para-style1">Your Last name*</p>
                        <input name="lastname" type="text" placeholder="Enter last name" class="stu-box-design1" required>
                    </div>

                </div>

                <div class="stu-entry-boxes2">

                    <div class="stu-email">
                        <p class="stu-para-style1">Email*</p>
                        <div class="stu-email-box">
                            <?php
                            if (isset($_SESSION['mail'])) {
                                $email = $_SESSION['mail'];
                            } else {
                                echo "<script>alert('Error: Session is not working.')</script>";
                            }
                            echo $email;
                            ?>
                        </div>

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
                    <input name="mobilenumber" type="tel" placeholder="0000000000" class="mob-box" pattern="\d{10}" maxlength="10" required> 

                </div>

                <div class="stu-address">
                    <p class="stu-para-style1">College Address</p>
                    <p class="stu-para">To know if the college is legitimate</p>
                </div>

                <div class="stu-entry-boxes2">

                    <div class="stu-address1">
                        <p class="stu-para-style2">Address1*</p>
                        <input name="address1" type="text" placeholder="Ex.-House no, Building, Street, Area" class="stu-box-design2" required>
                    </div>

                    <div class="stu-address2">
                        <p class="stu-para-style2">Address2*</p>
                        <input name="adderss2" type="text" placeholder="Ex.-Locality/Town, City/District" class="stu-box-design2" required>
                    </div>

                </div>

                <div class="stu-entry-boxes4">

                    <div class="pin-state">

                        <div class="stu-pin">
                            <p class="stu-para-style2">Pin*</p>
                            <input name="pincode" type="number" placeholder="Enter pin" class="stu-box-design3" required>
                        </div>

                        <div class="stu-state">
                            <p class="stu-para-style2">State*</p>
                            <input name="state" type="text" placeholder="Enter state" class="stu-box-design3" required>
                        </div>

                    </div>

                    <div class="city-country">

                        <div class="stu-city">
                            <p class="stu-para-style2">City*</p>
                            <input name="city" type="text" placeholder="Enter city" class="stu-box-design3" required>
                        </div>

                        <div class="stu-country">
                            <p class="stu-para-style2">Country*</p>
                            <input name="country" type="text" placeholder="Enter country" class="stu-box-design3" required>
                        </div>

                    </div>
                </div>
          
            <!-- end next button  -->
            <button value="submit" name="submit" class="btn nexti-btn">Next</button>

        </form>


    </div>

    <script src="../../../javaScripts/selectLanguage.js"></script>
</body>
</html>