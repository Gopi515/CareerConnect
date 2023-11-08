<!DOCTYPE html>
<html lang="en">
<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titles -->
    <title>CareerConnect-Login</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../style.css">

</head>

<!-- the php part -->
<?php
require '../../dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('Error: Username, email and password all are required.');</script>";
    } else {
        if (isset($_POST['role'])) {
            $role = $_POST['role'];

            if (empty($role)) {
                echo "<script>alert('Error: Please select a role.');</script>";
            } else {
                function loginUser($conn, $role, $username, $email, $password)
                {
                    $sql = "SELECT * FROM `$role` WHERE BINARY `user_name` = '$username' AND `email` = '$email'";
                    $result = mysqli_query($conn, $sql);

                    if ($row = mysqli_fetch_assoc($result)) {
                        if (password_verify($password, $row['pass'])) {
                            header("location: ../landingPage/landingPage.html");
                        } else {
                            echo "<script>alert('Error: Incorrect password. Please try again.');</script>";
                        }
                    } else {
                        echo "<script>alert('Error:Case sensitive username or you have selected a different role.');</script>";
                    }
                }

                if ($role == 'teacher' || $role == 'student' || $role == 'company') {
                    loginUser($conn, $role, $username, $email, $password);
                } else {
                    echo "<script>alert('Error: Invalid role selected.');</script>";
                }
            }
        }
    }
}
?>


<!-- Here starts the body part -->
<body>

    <div class="login-page">

        <!-- leftside -->
        <div class="left-side"><h1>WELCOME TO, <br><span class="title-name">CAREER CONNECT</span></h1></div>

        <!-- rightside -->
        <div class="right-side">
        <form action="login.php" method="POST">
            <!-- for the re-direct -->
            <div class="select-box">
                <p class="selecttext">Please select your role:</p>
                <div class="selectrole">
                    <select class="roles" name="role" id="roles">
                        <option class="drpdwn" value="default">Select a role</option>
                        <option class="drpdwn" value="teacher">Teacher</option>
                        <option class="drpdwn" value="student">Student</option>
                        <option class="drpdwn" value="company">Company</option>
                    </select>
                </div>
            </div>

            <!-- entries -->
            <div class="withsubmit">
                <div class="inputboxes">
                    <p class="inphead user-name">User Name</p>
                    <input name="username" class="pleasebox" type="text" placeholder="Enter your username">
                        
                    <p class="inphead email">Email</p>
                    <input name="email" class="pleasebox" type="email" placeholder="Enter the email">
                        
                    <p class="inphead password">Password</p>
                    <input name="password" class="pleasebox" type="password" placeholder="Password please">
                </div>
                <div class="subdiv">
                    <button class="btn submit" id="submitButton" onclick="submitSelection()">Login</button>
                </div>
            </div>
        </form>

            <!-- registration re-direct -->
            <div class="gotoreg">
                <p>Don't have an account?</p>
                <a href="../LoginandRegister/register.php"><button class="btn">Register Here</button></a>
            </div>
        </div>
    </div>

    <!-- JavaScript connects -->
    <script src="/javaScripts/pageRedirect.js"></script>
    <script src="/javaScripts/selectGender.js"></script>
</body>
</html>