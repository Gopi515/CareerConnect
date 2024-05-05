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
            <div class="overlay" id="overlay" style="display: none;"></div>
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
            <div class="overlay" id="overlay" style="display: none;"></div>
            <div id="RegisterNav">
                <div class="twooptions">
                    <div class="regop optionone">
                        <p>Want to register your college?</p>
                        <a class="adminreg" href="../LoginandRegister/adminRegister.php">
                            <div class="regbtnclg">Register college</div>
                        </a>
                    </div>
                    <div class="regop optiontwo">
                        <p>Already have a registered account?</p>
                        <a class="adminreg" href="../LoginandRegister/adminLogin.php">
                            <div class="regbtnclg">Admin Login</div>
                        </a>
                    </div>
                </div>
                <div class="closeRegIn" id="closeRegIn" onclick="closeRegIn()"><i class="fa-solid fa-xmark"></i></div>
            </div>
            </div>
        </div>
    </navbar>

    <!-- landing page content -->
    <div class="mainlangidingContent">
        <div class="welcomeImgcard">
            <video src="../../assets/career.webm" loop muted autoplay type="video/webm" class="welcomeImg"></video>
        </div>
        <div class="welcomeNote">
            <h1>Welcome To CareerConnect</h1>
            <p>Explore endless opportunities for your career growth.</p>
            <a href="#servicesContainer">Explore</a>
        </div>

        <!-- services -->
        <div class="servicesContainer" id="servicesContainer">
            <h2>Our Services</h2>

             <!-- student services -->
            <div class="serviceStudent serviceAll">
                <h2>
                    Secure your future with us
                </h2>
                <div class="studentserviceCards servicecardsAll">
                    <div class="serviceCard studentserviceCard1">
                        <div class="imagePart">
                            <img src="../../assets/hiring.jpg" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Explore Companies</h3>
                            <p>Get a change to work in favourite companies</p>
                        </div>
                    </div>
                    <div class="serviceCard studentserviceCard2">
                        <div class="imagePart">
                            <img src="../../assets/NITMAS.png" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Explore Internships</h3>
                            <p>Find a internship to enhance your skills</p>
                        </div>
                    </div>
                    <div class="serviceCard studentserviceCard3">
                        <div class="imagePart">
                            <img src="../../assets/NITMAS.png" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Explore Jobs</h3>
                            <p>Find a job of your dream</p>
                        </div>
                    </div>
                </div>

                <div class="serviceButtons">
                <button class="serviceRegister">Know more</button>
                <button class="serviceLogin">Login &#x25B6;</button>
                </div>
            </div>

             <!-- company services -->
            <div class="serviceCompany serviceAll">
                <h2>
                    Hire the best talent
                </h2>
                <div class="studentserviceCards servicecardsAll">
                    <div class="serviceCard companyserviceCard1">
                        <div class="imagePart">
                            <img src="../../assets/NITMAS.png" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Search for Talent</h3>
                            <p>Find profiles that exactly match your needs</p>
                        </div>
                    </div>
                    <div class="serviceCard companyserviceCard2">
                        <div class="imagePart">
                            <img src="../../assets/NITMAS.png" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Post Internships</h3>
                            <p>Find interns to work on your projects</p>
                        </div>
                    </div>
                    <div class="serviceCard companyserviceCard3">
                        <div class="imagePart">
                            <img src="../../assets/NITMAS.png" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Post Jobs</h3>
                            <p>Find the best candidates for your company</p>
                        </div>
                    </div>
                </div>

                <div class="serviceButtons">
                <button class="serviceRegister">Know more</button>
                <button class="serviceLogin">Login &#x25B6;</button>
                </div>
            </div>

            <!-- university services -->
            <div class="serviceUniversity serviceAll">
                <h2>
                    Connect with the best companies
                </h2>
                <div class="studentserviceCards servicecardsAll">
                    <div class="serviceCard universityserviceCard1">
                        <div class="imagePart">
                            <img src="../../assets/NITMAS.png" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Connect with Companies</h3>
                            <p>Get the best companies to visit your campus</p>
                        </div>
                    </div>
                    <div class="serviceCard universityserviceCard2">
                        <div class="imagePart">
                            <img src="../../assets/NITMAS.png" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Build Connection</h3>
                            <p>
                                Build a strong connection between your students and industry companies
                            </p>
                        </div>
                    </div>
                    <div class="serviceCard universityserviceCard3">
                        <div class="imagePart">
                            <img src="../../assets/NITMAS.png" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Skill Check</h3>
                            <p>
                                Get a chance to check the skills of your students before appling for jobs
                            </p>
                        </div>
                    </div>
                </div>

                <div class="serviceButtons">
                <button class="serviceRegister">Know more</button>
                <button class="serviceLogin">Login &#x25B6;</button>
                </div>
            </div>
        </div>

        <!-- trust worthy -->

        <!-- company marquee -->
        <div class="companyMarquee">
        <h2>Top companies trust us</h2>
        <marquee direction="right" scrollamount="10" class="companyMarqueeslide">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
            <img src="../../assets/Meta-Logo.png" alt="">
        </marquee>
        </div>

        <!-- university marquee -->
        <div class="companyMarquee universityMarquee">
        <h2>50+ universities alreay registered</h2>
        <marquee direction="left" scrollamount="10" class="companyMarqueeslide">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
            <img src="../../assets/NITMAS.png" alt="">
        </marquee>
        </div>
    </div>


    <!-- footer -->
    <footer class="footerMainlanding"></footer>

    <script src="../../javaScripts/buttonPop.js"></script>
</body>

</html>