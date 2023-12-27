<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Connect</title>
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
</head>

<?php
header("Content-Type: text/html");
?>

<body>
    <div class="navbar">
        <div class="navbar-brand">Career Connect</div>
        <div class="navbar-buttons">

            <!-- the login -->
            <div class="navbar-button" onclick="openLogIn()">Log in</div>
            <div class="logInNav" id="logInNav">
                <p>The button below will redirect you to the login page for student, teacher and company</p>
                <a class="linkingLogIn" href="../LoginandRegister/login.php">
                    <div class="buttonInnerLog" id="buttonInnerLog">Log In -></div>
                </a>
                <div class="closeLogIn" id="closeLogIn" onclick="closeLogIn()"><i class="fa-solid fa-xmark"></i></div>
            </div>

            <!-- the admin page-->
            <div class="navbar-button" onclick="openRegister()">Register your college</div>
            <div id="RegisterNav">
                
            </div>
        </div>
    </div>

    <script src="../../javaScripts/buttonPop.js"></script>
</body>

</html>