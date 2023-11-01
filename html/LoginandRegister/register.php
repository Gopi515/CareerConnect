<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titles -->
    <title>CareerConnect-Register</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../style.css">

</head>

<!-- php -->
<?php
require '../../partials/dbconnect.php'
    ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if (isset($_POST['role'])) {
        $roles = $_POST['role'];

        if ($roles == 'teacher') {
            $existsql = "SELECT * FROM `teacher` WHERE `user_name` = '$username' or `email` = '$email'";
            $existresult = mysqli_query($conn, $existsql);
            $num = mysqli_num_rows($existresult);
            if ($num != 0) {
                header("location: ./register.php");
                exit;
            } else {
                if ($password == $cpassword) {
                    echo $username;
                    echo $email;
                    $HASH = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `teacher`(`user_name`, `pass`, `email`) VALUES ('$username','$HASH','$email')";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        header("location: ../profiles/teacher/teacher.html");
                        exit;
                    }
                }
            }
        } elseif ($roles == 'student') {
            if ($password == $cpassword) {
                echo $username;
                echo $email;
                $HASH = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `student`(`user_name`, `pass`, `email`) VALUES ('$username','$HASH','$email')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("location: ../profiles/student/student.html");
                    exit;
                }
            }
        }
    }
}

?>

<body>

    <div class="register-page">

        <!-- The main box -->
        <div class="right-side">

            <!-- heading -->
            <h2 class="title">Register Page</h2>

            <form action="register.php" method="POST">
                <div>
                    <!-- the input boxes -->
                    <div class="withReg">
                        <div class="inputboxes">
                            <p class="inphead user-name">User Name</p>
                            <input name="username" class="pleasebox" type="text" placeholder="Enter your username">

                            <p class="inphead email">Email</p>
                            <input name="email" class="pleasebox" type="email" placeholder="Enter the email">

                            <p class="inphead password">Password</p>
                            <input name="password" class="pleasebox" type="password" placeholder="Password please">

                            <p class="inphead password">Repeat Password</p>
                            <input name="cpassword" class="pleasebox" type="password"
                                placeholder="Retype password please">
                        </div>
                    </div>

                    <!-- role button -->
                    <div class="role-box">
                        <p class="selecttext">Please select your role:</p>
                        <div class="buttonsrole">
                            <select class="roles" name="role" id="roles">
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                                <option value="company">Company</option>
                            </select>


                            <!-- <button value="teacher" class="btn forpad" id="teacherButton">Teacher</button>
                            <button value="student" class="btn forpad" id="studentButton">Student</button>
                            <button value="company" class="btn forpad" id="companyButton">Company</button> -->
                        </div>
                    </div>

                    <!-- The submit button -->
                    <div class="regdiv">
                        <button class="btn register" id="submitButton" onclick="submitSelection()">Register</button>
                    </div>
                </div>
            </form>

            <div class="gotolog">
                <p>Already have an account?</p>
                <a href="/html/LoginandRegister/login.html"><button class="btn">Login Here</button></a>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="../../javaScripts/pageRedirect.js"></script>
    <script src="../../javaScripts/selectGender.js"></script>
</body>

</html>