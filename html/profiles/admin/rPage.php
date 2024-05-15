<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../LoginandRegister/adminLogin.php");
    exit();
}

require '../../../dbconnect.php';

$username = $_SESSION['user_name'];
$email = $_SESSION['mail'];

$query = "SELECT * FROM admin where email = '$email'";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$admin = mysqli_fetch_assoc($result);

// Extract initials from username
$initials = '';
$words = explode(' ', $username);
foreach ($words as $word) {
    $initials .= $word[0];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<?php
require '../../../dbconnect.php';
if (isset($_POST["student_mass_data"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $filename = $_FILES["file"]["tmp_name"];
    $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

    // Check if the file extension is CSV
    if ($file_extension === 'csv') {
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($filename, "r");

            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {

                $username = $getData[0];
                $password = $getData[1];
                $HASH = password_hash($password, PASSWORD_DEFAULT);
                $email = $getData[2];
                $token = bin2hex(random_bytes(14));

                $sql = "INSERT INTO `student`(`user_name`, `pass`, `email`, `token`) 
                    values ('$username','$HASH','$email','$token')";
                $result = mysqli_query($conn, $sql);

                if (!isset($result)) {
                    echo "<script type=\"text/javascript\">
                        alert(\"Invalid File:Please Upload CSV File.\");
                        window.location = \"rPage.php\"
                        </script>";
                } else {
                    echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"rPage.php\"
                        </script>";
                }
            }

            fclose($file);
        }
    } else {
        // Display error message for invalid file type
        echo "<script type=\"text/javascript\">
            alert(\"Invalid File Type: Please Upload CSV File.\");
            window.location = \"rPage.php\"
            </script>";
    }
}


if (isset($_POST["teacher_mass_data"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $filename = $_FILES["file"]["tmp_name"];
    $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

    // Check if the file extension is CSV
    if ($file_extension === 'csv') {
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($filename, "r");

            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {

                $username = $getData[0];
                $password = $getData[1];
                $HASH = password_hash($password, PASSWORD_DEFAULT);
                $email = $getData[2];
                $token = bin2hex(random_bytes(14));

                $sql = "INSERT INTO `teacher`(`user_name`, `pass`, `email`, `token`) 
                    values ('$username','$HASH','$email', '$token')";
                $result = mysqli_query($conn, $sql);

                if (!isset($result)) {
                    echo "<script type=\"text/javascript\">
                        alert(\"Invalid File:Please Upload CSV File.\");
                        window.location = \"rPage.php\"
                        </script>";
                } else {
                    echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"rPage.php\"
                        </script>";
                }
            }

            fclose($file);
        }
    } else {
        // Display error message for invalid file type
        echo "<script type=\"text/javascript\">
            alert(\"Invalid File Type: Please Upload CSV File.\");
            window.location = \"rPage.php\"
            </script>";
    }
}


if (isset($_POST["company_mass_data"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $filename = $_FILES["file"]["tmp_name"];
    $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

    // Check if the file extension is CSV
    if ($file_extension === 'csv') {
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($filename, "r");

            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {

                $username = $getData[0];
                $password = $getData[1];
                $HASH = password_hash($password, PASSWORD_DEFAULT);
                $email = $getData[2];
                $token = bin2hex(random_bytes(14));

                $sql = "INSERT INTO `company`(`user_name`, `pass`, `email`, `token`) 
                    values ('$username','$HASH','$email', '$token')";
                $result = mysqli_query($conn, $sql);

                if (!isset($result)) {
                    echo "<script type=\"text/javascript\">
                        alert(\"Invalid File:Please Upload CSV File.\");
                        window.location = \"rPage.php\"
                        </script>";
                } else {
                    echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"rPage.php\"
                        </script>";
                }
            }

            fclose($file);
        }
    } else {
        // Display error message for invalid file type
        echo "<script type=\"text/javascript\">
            alert(\"Invalid File Type: Please Upload CSV File.\");
            window.location = \"rPage.php\"
            </script>";
    }
}
?>

<body class="bg-img">
    <div class="sidebar close">
        <div class="logo-details">
            <a href="admin.php">
                <div>CC</div>
            </a>
            <span class="logo_name">CareerConnect</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="admin.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="link_name">Dashboard</span>
                </a>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Lists</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="list/studentlist.php">Student's List</a></li>
                    <li><a href="list/teacherlist.php">Teacher's List</a></li>
                    <li><a href="list/companylist.php">Company's List</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class='bx bx-notepad'></i>
                        <span class="link_name">Profile Changes</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="pvalidation/stuValidation.php">Student Updates</a></li>
                    <li><a href="pvalidation/techValidation.php">Teacher Updates</a></li>
                    <li><a href="pvalidation/compValidation.php">Company Updates</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class='bx bxs-checkbox-checked'></i>
                        <span class="link_name">Internship and jobs verification</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="internjobverification/internverify.php">Internship updates</a></li>
                    <li><a href="internjobverification/jobverify.php">Job Updates</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class='bx bxl-venmo'></i>
                        <span class="link_name">Applied verification</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="applications/internApp.php">Internship application</a></li>
                    <li><a href="applications/jobApp.php">Job applications</a></li>
                </ul>
            </li>
            <li style="background-color:#0362ff;">
                <a href="rPage.php">
                    <i class='bx bxs-registered'></i>
                    <span class="link_name">Register IDs</span>
                </a>
            </li>
            <li>
                <a href="shortlistandselected.php">
                    <i class='bx bxs-download'></i>
                    <span class="link_name">Shortlist & Selected students</span>
                </a>
            </li>
            <li>
                <a href="settings.php">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Settings</span>
                </a>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <div class="logo">
                            <?php echo strtoupper($initials); ?>
                        </div>
                    </div>
                    <div class="name-job">
                        <div class="profile_name">
                            <?php echo $admin['user_name']; ?>
                        </div>
                        <div class="job">
                            <?php echo $admin['college_name']; ?>
                        </div>
                    </div>
                    <i onclick="openLogOut()" class='bx bx-log-out'></i>
                </div>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div id="blurBackground" class="blur-background" style="display: none;"></div>
        <div id="logOutPop">
            <div class="log-out-content">
                <div class="log-out-text">Are you sure you want to log out?</div>
                <div class="log-out-buttons">
                    <div class="choice yes" onclick="logOut()">Yes</div>
                    <div class="choice no" onclick="closeLogOut()">No</div>
                </div>
            </div>
            <!-- <div id="closeLogout" onclick="closeLogOut()"><i class='bx bx-x'></i></div> -->
        </div>
        <div class="home-content">
            <span class="text">Register Page</span>
        </div>

       <!-- Comapany Register  -->
        <div class="admin-Settings">
            <a id="uploadLink" class="boxes CR" href="#">
                <div onclick="openxlsxC()">Company Register</div>
                <p>Mass register company using CSV file</p>
            </a>
            <form action="#" method="post" name="company_excel" enctype="multipart/form-data">
                <div id="uploadModalC" class="modal">
                    <div class="modal-content">
                        <div id="closemodal" onclick="closexlsxC()"><i class='bx bx-x'></i></div>
                        <h2>Upload Company File</h2>
                        <div id="dropArea">
                            <p>Click choose file button to browse</p>
                            <input type="file" name="file" id="file" class="input-large" required accept=".csv" />
                        </div>
                        <div id="uploadResult"></div>
                        <button type="submit" id="submit" name="company_mass_data">Upload</button>
                        <span id="fileName"></span>
                    </div>
                </div>
            </form>

            <!-- Student register -->
            <a id="uploadLink" class="boxes CR" href="#">
                <div onclick="openxlsxS()">Student Register</div>
                <p>Mass register student using CSV file</p>
            </a>
            <form action="#" method="post" name="student_excel" enctype="multipart/form-data">
                <div id="uploadModalS" class="modal">
                    <div class="modal-content">
                        <div id="closemodal" onclick="closexlsxS()"><i class='bx bx-x'></i></div>
                        <h2>Upload Student File</h2>
                        <div id="dropArea">
                            <p>Click choose file button to browse</p>
                            <input type="file" name="file" id="file" class="input-large" required accept=".csv" />
                        </div>
                        <div id="uploadResult"></div>
                        <button type="submit" id="submit" name="student_mass_data">Upload</button>
                        <span id="fileName"></span>
                    </div>
                </div>
            </form>

            <!-- Teacher register -->
            <a id="uploadLink" class="boxes CR" href="#">
                <div onclick="openxlsxT()">Teacher Register</div>
                <p>Mass register Teacher using CSV file</p>
            </a>
            <form action="#" method="post" name="teacher_excel" enctype="multipart/form-data">
                <div id="uploadModalT" class="modal">
                    <div class="modal-content">
                        <div id="closemodal" onclick="closexlsxT()"><i class='bx bx-x'></i></div>
                        <h2>Upload Teacher File</h2>
                        <div id="dropArea">
                            <p>Click choose file button to browse</p>
                            <input type="file" name="file" id="file" class="input-large" required accept=".csv" />
                        </div>
                        <div id="uploadResult"></div>
                        <button type="submit" id="submit" name="teacher_mass_data">Upload</button>
                        <span id="fileName"></span>
                    </div>
                </div>
            </form>

            <a class="boxes IR" href="registration/register.php">
                <div>Individual Register</div>
                <p>Enter Company, Student or Teacher one by one.</p>
            </a>
        </div>
    </section>

    <!-- script link -->
    <script src="../../../javaScripts/sideBar.js"></script>
    <script src="../../../javaScripts/buttonPop.js"></script>
    <script src="../../../javaScripts/adminLogOut.js"></script>
    <script src="../../../javaScripts/uploadFile.js"></script>
</body>

</html>