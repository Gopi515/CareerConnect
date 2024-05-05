<!DOCTYPE html>
<html lang="en">
<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titles -->
    <title>CareerConnect-Login</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>

</head>

<!-- the php part -->
<?php
session_start();
require '../../dbconnect.php';  // Connection to the first database
$host = 'localhost';  // or your host
$username = 'root';
$password = '';
$database = 'cee_db';

$conn_cee = new mysqli($host, $username, $password, $database);
if ($conn_cee->connect_error) {
    die('Connection failed: ' . $conn_cee->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>alert('Error: Username, email, and password are all required.'); window.history.back();</script>";
        exit;
    }

    if (isset($_POST['role'])) {
        $role = $_POST['role'];

        if (empty($role)) {
            echo "<script>alert('Error: Please select a role.'); window.history.back();</script>";
            exit;
        }

        if ($role === 'teacher') {
            loginUser($conn, $conn_cee, $role, $username, $email, $password);
        } else {
            echo "<script>alert('Error: Invalid role selected.'); window.history.back();</script>";
            exit;
        }
    }
}

function loginUser($conn, $conn_cee, $role, $username, $email, $password) {
    // Prepare and execute the query to fetch user data
    $sql = "SELECT * FROM `$role` WHERE BINARY `user_name` = ? AND `email` = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die('MySQL prepare error: ' . $conn->error);
    }
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists and the password is correct
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['pass'])) {
            $_SESSION['mail'] = $email;
            if ($role === 'teacher') {
                // Check if username already exists in the second database
                $checkSql = "SELECT * FROM admin_acc WHERE admin_user = ?";
                $checkStmt = $conn_cee->prepare($checkSql);
                $checkStmt->bind_param("s", $username);
                $checkStmt->execute();
                $checkResult = $checkStmt->get_result();

                // Only insert if the user does not already exist
                if ($checkResult->num_rows == 0) {
                    $insertSql = "INSERT INTO admin_acc (admin_user, admin_pass) VALUES (?, ?)";
                    $insertStmt = $conn_cee->prepare($insertSql);
                    if (!$insertStmt) {
                        die('MySQL prepare error: ' . $conn_cee->error);
                    }
                    $insertStmt->bind_param("ss", $username, $password);  // Inserting password as plain text as per your request
                    $insertStmt->execute();
                }

                // Redirect to teacher landing page regardless of insert
                header("location: ../landingPage/landingTeacher.php");
                exit;
            }
        } else {
            echo "<script>alert('Error: Incorrect password. Please try again.'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Error: Case-sensitive username or you have selected a different role.'); window.history.back();</script>";
        exit;
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
            <form action="teacherLogin.php" method="POST">
                <!-- for the re-direct -->
                <div class="select-box">
                    <p class="selecttext">You are logging in as:</p>
                    <div class="selectrole">
                        <select class="roles" name="role" id="roles">
                            <option class="drpdwn" value="teacher">Teacher</option>
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
                            <input onpaste="return false;" autocomplete="off" name="password" required class="pwrdl" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password" placeholder="Password please" oninput="setCustomValidity('')">
                            <span class="eye-iconl" onclick="togglePassword()">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="subdiv">
                        <p class="forgot-password"><a href="teacherForgotPassword.php">Forgot Password?</a></p>
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