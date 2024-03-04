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

<body class="mainLandingPage">
    <navbar class="navbar">
        <div class="navbar-brand">Career Connect</div>
        <div class="navbar-buttons">

            <!-- the login -->
            <div class="navbar-button" onclick="openLogIn()">Log in</div>
            <div class="logInNav" id="logInNav">
                <div class="LoginInterface">
                    <div class="Tlogin">
                        <p>
                            Teacher Login Here
                        </p>
                        <a class="linkingLogIn" href="../LoginandRegister/teacherLogin.php">
                            <div class="buttonInnerLog" id="buttonInnerLog">Teacher Log in -></div>
                        </a>
                    </div>
                    <div class="Slogin">
                        <p>
                            Student Login Here
                        </p>
                        <a class="linkingLogIn" href="../LoginandRegister/studentLogin.php">
                            <div class="buttonInnerLog" id="buttonInnerLog">Student Log in -></div>
                        </a>
                    </div>
                    <div class="Clogin">
                        <p>
                            Company Login Here
                        </p>
                        <a class="linkingLogIn" href="../LoginandRegister/companyLogin.php">
                            <div class="buttonInnerLog" id="buttonInnerLog">Company Log in -></div>
                        </a>
                    </div>
                
                <div class="closeLogIn" id="closeLogIn" onclick="closeLogIn()"><i class="fa-solid fa-xmark"></i></div>
            </div>
        </div>

            <!-- the admin page-->
            <div class="navbar-button" onclick="openRegIn()">Register your college</div>
            <div id="RegisterNav">
                <div class="twooptions">
                    <div class="regop optionone">
                        <p>Want to register your college?</p>
                        <div class="regbtnclg">Register college</div>
                    </div>
                    <div class="regop optiontwo">
                        <p>Already have a registered account?</p>
                        <div class="regbtnclg">Admin Login</div>
                    </div>
                </div>
                <div class="closeRegIn" id="closeRegIn" onclick="closeRegIn()"><i class="fa-solid fa-xmark"></i></div>
            </div>
            </div>
        </div>
    </navbar>
    <div class="temp">
        Have some power mate
    </div>

    <script src="../../javaScripts/buttonPop.js"></script>
</body>

</html>