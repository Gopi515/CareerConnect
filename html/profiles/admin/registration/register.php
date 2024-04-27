<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../../LoginandRegister/adminLogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titles -->
    <title>CareerConnect-Register</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>

</head>

<!-- php -->
<?php
require '../../../../dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    if (isset($_POST['password']) && isset($_POST['cpassword'])) {
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
    } else {
        echo "<script>alert('Error: Password and password confirmation are required.');</script>";
        // For further error handling or redirect the user as needed.
        exit;
    }

    if (isset($_POST['role'])) {
        $roles = $_POST['role'];

        if (empty($roles)) {
            echo "<script>alert('Error: Please select a role.');</script>";
            // For further error handling or redirect the user as needed.
            exit;
        }

        function registerUser($conn, $role, $username, $password, $email, $cpassword)
        {
            $existsql = "SELECT * FROM `$role` WHERE `user_name` = ? or `email` = ?";
            $existstmt = mysqli_prepare($conn, $existsql);
            mysqli_stmt_bind_param($existstmt, "ss", $username, $email);
            mysqli_stmt_execute($existstmt);
            $existresult = mysqli_stmt_get_result($existstmt);
            $num = mysqli_num_rows($existresult);

            if ($num != 0) {
                header("location: ./register.php");
                exit;
            }

            if ($password == $cpassword) {
                $HASH = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `$role`(`user_name`, `pass`, `email`) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sss", $username, $HASH, $email);
                mysqli_stmt_execute($stmt);

                if ($stmt) {
                    header("location: ./register.php");
                    echo "<script>alert('$role has been successfully added. You will be redirected to the register page now.');</script>";
                    exit;
                } else {
                    echo "<script>alert('Error: Registration failed. Please try again later.');</script>";
                    error_log("Database error: " . mysqli_error($conn));
                }
            } else {
                echo "<script>alert('Error: Password and password confirmation do not match. Please make sure you entered the same password in both fields.');</script>";
            }
        }

        if ($roles == 'teacher') {
            registerUser($conn, 'teacher', $username, $password, $email, $cpassword);
        } elseif ($roles == 'student') {
            registerUser($conn, 'student', $username, $password, $email, $cpassword);
        } elseif ($roles == 'company') {
            registerUser($conn, 'company', $username, $password, $email, $cpassword);
        } else {
            echo "<script>alert('Error: Please select a role first')</script>";
        }
    }
}
?>

<!-- normal html starts again -->
<body>

    <div class="register-page">

        <!-- The main box -->
        <div class="right-side">
        <a href="../rPage.php"><div class="regallclosebtn"><i class="fa-solid fa-caret-left"></i></div></a>


            <!-- heading -->
            <h2 class="title">Register Page</h2>

            <form action="register.php" method="POST">
                <div>

                    <!-- role button -->
                    <div class="role-box">
                        <p class="selecttext">Please select your role:</p>
                        <div class="buttonsrole">
                            <select class="roles" name="role" id="roles">
                                <option class="drpdwn" value="default">Select a role</option>
                                <option class="drpdwn" value="teacher">Teacher</option>
                                <option class="drpdwn" value="student">Student</option>
                                <option class="drpdwn" value="company">Company</option>
                            </select>
                        </div>
                    </div>

                    <!-- the input boxes -->
                    <div class="withReg">
                        <div class="inputboxes">
                            <p class="inphead user-name">User Name</p>
                            <input name="username" required class="pleasebox" type="text" placeholder="Enter your username">

                            <p class="inphead email">Email</p>
                            <input name="email" required class="pleasebox" type="email" placeholder="Enter the email">

                            <p class="inphead password">Password</p>
                            <div id="foreye" class="password-container">
                                <input name="password" onpaste="return false;" autocomplete="off" required class="pwrd" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password" placeholder="Create Password" oninput="setCustomValidity('')">
                                <span class="eye-icon" onclick="togglePassword()">
                                    <i class="far fa-eye"></i>
                                </span>
                            </div>

                            <p class="inphead password">Repeat Password</p>
                            <input onpaste="return false;" autocomplete="off" name="cpassword" required class="pleasebox" type="password"
                                placeholder="Retype password please">
                        </div>
                    </div>

                    <!-- The submit button -->
                    <div class="regdiv">
                        <button class="btn register" id="submitButton" onclick="submitSelection()">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- scripts -->
    <script src="../../../../javaScripts/theeye.js"></script>
    <script src="../../../../javaScripts/passvalidation.js"></script>
</body>

</html>