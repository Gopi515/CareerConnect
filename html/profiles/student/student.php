<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student profile</title>
    <link rel="stylesheet" href="../../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>


<!-- php  -->
<?php
    session_start();
    require '../../../dbconnect.php';

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
        
    if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($countrycode) && 
        !empty($mobilenumber) && !empty($address1) && !empty($address2) && !empty($pincode) && 
        !empty($state) && !empty($city) && !empty($country) && !empty($gender)) {
            // && !empty($lang)


                $checkmobile = "SELECT * FROM `stu_personal_details` WHERE `phone_no` = '$mobilenumber'";
                $result = mysqli_query($conn,$checkmobile);
                $count = mysqli_num_rows($result);

                if ($count != 0) {
                    header("location: ./student.php");
                    exit;
                }

                $query = "SELECT id AS stu_id FROM student WHERE email = '$email'";
                $find = $conn->query($query);
                if(mysqli_num_rows($find)>0){
                    while($row = mysqli_fetch_array($find)){
                        $stu_id = $row["stu_id"];
                    }
                }


                $insertdata = "INSERT INTO `stu_personal_details`(`stu_id`, `F_name`, `L_name`, `email`, `phone_code`,
                `phone_no`, `addr1`, `addr2`, `pin`, `city`, `state`, `country`, `gender`) 
                VALUES ('$stu_id','$firstname','$lastname','$email','$countrycode','$mobilenumber','$address1','$address2',
                '$pincode','$city','$state','$country','$gender')";

                $smt = mysqli_query($conn, $insertdata);


            if ($smt) {
                header("location: ../../landingPage/landingStudent.php");
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

        <!-- main container -->
        <form action="#" method="POST" class="stu-container">

            <!-- header -->
            <div class="stu-header">
                <p class="header-item1">Hi there!</p>
                <p class="header-item2">Let's get started</p>
            </div>

            <!-- entry boxes -->
            <div class="stu-hero-section">

                <div class="stu-entry-boxes1">

                    <div class="stu-first-name">
                        <p class="stu-para-style1">First name*</p>
                        <input name="firstname" type="text" placeholder="Enter first name" class="stu-box-design1" required>
                    </div>

                    <div class="stu-last-name">
                        <p class="stu-para-style1">Last name*</p>
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
                    <p class="stu-para-style1">Address</p>
                    <p class="stu-para">To connect you with opportunities closer to you</p>
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



                <!-- select languages -->

                <div class="stu-language">
                    <p class="stu-para-style1">Languages you know*</p>

                    <div id="selected-items">
                        <div id="selected-items-list"></div>
                    </div>

                    <div class="add-language">
                        <div id="select-items-button" onclick="showMenu()">+ Add Languages</div>
                        <div id="languages" style="display: none;">
                        <!-- Language dropdown button -->
                            <div class="langlabel">
                                <label class="dropdown-label1">Select Language:</label>
                                <select class="language-dropdown" id="language-dropdown">
                                    <option value="English">English</option>
                                    <option value="Bengali">Bengali</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="Spanish">Spanish</option>
                                    <option value="Mandarin">Mandarin</option>
                                    <!-- Add other languages here -->
                                </select>
                            </div>

                            <!-- Proficiency dropdowns -->
                            <div class="proficiency"><p class="proficiency-title">Proficiency Level</p>
                                <div class="dropboxesproficiency">
                                    <div class="prf-fst-half">
                                        <label class="dropdown-label">Writing:</label>
                                        <select class="writingDropdown">
                                            <option value="Basic">Basic</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Proficient">Proficient</option>
                                            <option value="Mother-Tongue">Mother Tongue</option>
                                        </select>

                                        <label class="dropdown-label">Reading:</label>
                                        <select class="readingDropdown">
                                            <option value="Basic">Basic</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Proficient">Proficient</option>
                                            <option value="Mother-Tongue">Mother Tongue</option>
                                        </select>
                                    </div>
                                    <div class="prf-snd-half">
                                        <label class="dropdown-label">Listening:</label>
                                        <select class="listeningDropdown">
                                            <option value="Basic">Basic</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Proficient">Proficient</option>
                                            <option value="Mother-Tongue">Mother Tongue</option>
                                        </select>

                                        <label class="dropdown-label">Speaking:</label>
                                        <select class="speakingDropdown">
                                            <option value="Basic">Basic</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Proficient">Proficient</option>
                                            <option value="Mother-Tongue">Mother Tongue</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        <div onclick="addToSelected()" class="ok-btn">OK</div>
                    </div>
                </div>
            </div>


            </div>

          
            <!-- end next button  -->
            <button value="submit" name="submit" class="btn next-btn">Next</button>

        </form>


    </div>

    <script src="../../../javaScripts/selectLanguage.js"></script>
</body>
</html>