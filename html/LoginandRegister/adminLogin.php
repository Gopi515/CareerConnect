<!DOCTYPE html>
<html lang="en">
<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titles -->
    <title>CareerConnect - Admin Login</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>

</head>

<!-- the php part -->
<?php
session_start();
require '../../dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('Error: Username, email, and password are all required.');</script>";
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

                    if ($result) {
                        $_SESSION['mail'] = $email;
                        $_SESSION['user_name'] = $username;
                    }


                    if ($row = mysqli_fetch_assoc($result)) {
                        if (password_verify($password, $row['adminpass'])) {
                            switch ($role) {
                                case 'admin':
                                    header("location: ../profiles/admin/admin.php");
                                    break;
                                default:
                                    echo "<script>alert('Error: Unknown role.');</script>";
                                    break;
                            }
                        } else {
                            echo "<script>alert('Error: Incorrect password. Please try again.');</script>";
                        }
                    } else {
                        echo "<script>alert('Error: Case-sensitive username or you have selected a different role.');</script>";
                    }
                }

                if ($role == 'admin') {
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
        <div class="left-side"><h1>LOGIN TO, <br><span class="title-name">YOUR PROFILE</span></h1></div>

        <!-- rightside -->
        <div class="right-side">
            <form action="adminLogin.php" method="POST">
                <!-- for the re-direct -->
                <div class="select-box">
                    <p class="selecttext">You are logging in as:</p>
                    <div class="selectrole">
                        <select class="roles" name="role" id="roles">
                            <option class="drpdwn" value="admin">Admin</option>
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
                        <div id="foreye" class="password-container logincont">
                            <input name="password" required onpaste="return false;" autocomplete="off" class="pwrdl" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password" placeholder="Password please" oninput="setCustomValidity('')">
                            <span class="eye-iconl" onclick="togglePassword()">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="subdiv">
                        <button class="btn submit" id="submitButton" onclick="submitSelection()">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript connects -->
    <script src="../../javaScripts/theeye.js"></script>
    <script src="../../javaScripts/passvalidation.js"></script>
</body>
</html>