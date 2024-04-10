<!DOCTYPE html>
<html lang="en">
<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title>CareerConnect - Admin Registration</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>

</head>

<?php
    session_start();
    require '../../dbconnect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $collegeId = $_POST['collegeId'];
        $collegeName = $_POST['collegeName'];
        $adminpassword = $_POST['adminpassword'];
        $confirmpassword = $_POST['confirmpassword'];

        if ($adminpassword == $confirmpassword) {
            $HASH = password_hash($adminpassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `admin` (`user_name`, `email`, `college_id`, `college_name`, `adminpass`) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssiss", $username, $email, $collegeId, $collegeName, $HASH);
            mysqli_stmt_execute($stmt);

            if ($stmt) {
                $_SESSION['mail'] = $email;
                $_SESSION['user_name'] = $username;
            }

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header("location: ../profiles/admin/admin.php");
                exit();
            } else {
                echo "<script>alert('Error: Admin registration failed.');</script>";
            }
        } else {
            echo "<script>alert('Error: Password and password confirmation do not match.');</script>";
        }
    }
?>


<body>
    <div class="divideradmin">

        <!-- leftside -->
        <div class="testingsomething">Welcome to, <span>Career Connect</span><br>Please Register your college here.</div>

        <!-- rightside -->
        <div class="adminReg">
            <form action="adminRegister.php" method="post">

            <!-- the work starts here -->
                <div class="adminRegentry">
                    <div class="adminentryarea">
                        <div class="aregboxes">
                            <p>User Name</p>
                            <div class="areginput"><input type="text" name="username" placeholder="Enter Username" required></div>
                        </div>

                        <div class="aregboxes">
                            <p>Email address</p>
                            <div class="areginput"><input type="email" name="email" placeholder="Enter a valid Email" required></div>
                        </div>

                        <div class="aregboxes">
                            <p>College ID</p>
                            <div class="areginput"><input type="number" name="collegeId" placeholder="College Id" required></div>
                        </div>

                        <div class="aregboxes">
                            <p>College Name</p>
                            <div class="areginput"><input type="text" name="collegeName" placeholder="College Name" required></div>
                        </div>

                        <div class="aregboxes">
                            <p>Password</p>
                            <div id="foreye" class="areginput">
                                <input name="adminpassword"  required onpaste="return false;" autocomplete="off" class="adminpass" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password" placeholder="Create Password" oninput="setCustomValidity('')">
                                <span class="eye-icon" onclick="togglePassword()">
                                    <i class="far fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="aregboxes">
                            <p>Confirm Password</p>
                            <div class="areginput"><input  type="password" onpaste="return false;" autocomplete="off" name="confirmpassword" placeholder="Confirm Password" required></div>
                        </div>
                    </div>
                    
                    <div class="adminREGbutton">
                        <input class="btn" type="submit" value="Register">
                    </div>
                </div>
            </form>
        </div>
        </div>
    <script src="../../javaScripts/theeye.js"></script>
    <script src="../../javaScripts/passvalidation.js"></script>
</body>
</html>