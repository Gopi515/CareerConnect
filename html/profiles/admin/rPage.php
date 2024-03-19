<?php
session_start();
if (!isset ($_SESSION['mail'])) {
    header("Location: ../../LoginandRegister/adminLogin.php");
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
    if(isset($_POST["student_mass_data"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        
        $filename=$_FILES["file"]["tmp_name"];    
        if($_FILES["file"]["size"] > 0){
            $file = fopen($filename, "r");
            
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
                $sql = "INSERT INTO `student`(`user_name`, `pass`, `email`) 
                values ('".$getData[0]."','".$getData[1]."','".$getData[2]."')";
                $result = mysqli_query($conn, $sql);
                if(!isset($result)){
                    echo "<script type=\"text/javascript\">
                    alert(\"Invalid File:Please Upload CSV File.\");
                    window.location = \"rPage.php\"
                    </script>";    
                }
                else {
                    echo "<script type=\"text/javascript\">
                    alert(\"CSV File has been successfully Imported.\");
                    window.location = \"rPage.php\"
                    </script>";
                }
            }
          
            fclose($file);  
        }
    }

    if(isset($_POST["teacher_mass_data"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        
        $filename=$_FILES["file"]["tmp_name"];    
        if($_FILES["file"]["size"] > 0){
            $file = fopen($filename, "r");
            
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
                $sql = "INSERT INTO `teacher`(`user_name`, `pass`, `email`) 
                values ('".$getData[0]."','".$getData[1]."','".$getData[2]."')";
                $result = mysqli_query($conn, $sql);
                if(!isset($result)){
                    echo "<script type=\"text/javascript\">
                    alert(\"Invalid File:Please Upload CSV File.\");
                    window.location = \"rPage.php\"
                    </script>";    
                }
                else {
                    echo "<script type=\"text/javascript\">
                    alert(\"CSV File has been successfully Imported.\");
                    window.location = \"rPage.php\"
                    </script>";
                }
            }
          
            fclose($file);  
        }
    }

    if(isset($_POST["company_mass_data"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        
        $filename=$_FILES["file"]["tmp_name"];    
        if($_FILES["file"]["size"] > 0){
            $file = fopen($filename, "r");
            
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
                $sql = "INSERT INTO `company`(`user_name`, `pass`, `email`) 
                values ('".$getData[0]."','".$getData[1]."','".$getData[2]."')";
                $result = mysqli_query($conn, $sql);
                if(!isset($result)){
                    echo "<script type=\"text/javascript\">
                    alert(\"Invalid File:Please Upload CSV File.\");
                    window.location = \"rPage.php\"
                    </script>";    
                }
                else {
                    echo "<script type=\"text/javascript\">
                    alert(\"CSV File has been successfully Imported.\");
                    window.location = \"rPage.php\"
                    </script>";
                }
            }
          
            fclose($file);  
        }
    } 
?>

<body>
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
                        <span class="link_name">Category</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Category</a></li>
                    <li><a href="something.php">1st one</a></li>
                    <li><a href="something.php">2nd one</a></li>
                    <li><a href="something.php">3rd one</a></li>
                </ul>
            </li>

            <li style="background-color:#0362ff;">
                <a href="rPage.php">
                    <i class='bx bxs-registered'></i>
                    <span class="link_name">Register IDs</span>
                </a>
            </li>
            <li>
                <a href="settings.php">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Setting</span>
                </a>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="/assets/image.png" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">
                        <?php
                        if (isset ($_SESSION['user_name'])) {
                            $username = $_SESSION['user_name'];
                        } else {
                            echo "<script>alert('Error: Session is not working.')</script>";
                        }
                        echo $username;
                        ?>
                        </div>
                        <div class="job">College name</div>
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
                <div id="uploadModal" class="modal">
                    <div class="modal-content">
                        <div id="closemodal" onclick="closexlsxC()"><i class='bx bx-x'></i></div>
                        <h2>Upload File</h2>
                        <div id="dropArea">
                            <p>Drag and drop file here or click choose file button to browse</p>
                            <input type="file" name="file" id="file" class="input-large" required>
                            <label for="file" id="fileLabel">Choose File</label>
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
                <div id="uploadModal" class="modal">
                    <div class="modal-content">
                        <div id="closemodal" onclick="closexlsxS()"><i class='bx bx-x'></i></div>
                        <h2>Upload File</h2>
                        <div id="dropArea">
                            <p>Drag and drop file here or click choose file button to browse</p>
                            <input type="file" name="file" id="file" class="input-large" required>
                            <label for="file" id="fileLabel">Choose File</label>
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
                <div id="uploadModal" class="modal">
                    <div class="modal-content">
                        <div id="closemodal" onclick="closexlsxT()"><i class='bx bx-x'></i></div>
                        <h2>Upload File</h2>
                        <div id="dropArea">
                            <p>Drag and drop file here or click choose file button to browse</p>
                            <input type="file" name="file" id="file" class="input-large" required>
                            <label for="file" id="fileLabel">Choose File</label>
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