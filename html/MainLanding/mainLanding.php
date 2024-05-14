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
        <svg width="300" height="60">
        <text x="0" y="40" class="navbar-brand">CareerConnect</text>
        </svg>
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
            <video src="../../assets/career.mp4" loop muted autoplay type="video/mp4" class="welcomeImg"></video>
        </div>
        <div class="welcomeNote">
            <h1>Welcome To CareerConnect</h1>
            <p>Explore endless opportunities for your career growth.</p>
            <a href="#servicesContainer">Explore</a>
        </div>

        <!-- services -->
        <div class="servicesContainer" id="servicesContainer">
            <svg width="300" height="60" class="serviceSvg">
            <text x="0" y="40" class="navbar-brand">Our Services</text>
            </svg>

             <!-- student services -->
            <div class="serviceStudent serviceAll">
                <h2>
                    Secure your future with us
                </h2>
                <div class="studentserviceCards servicecardsAll">
                    <div class="serviceCard studentserviceCard1">
                        <div class="imagePart">
                            <img src="../../assets/hiring.avif" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Explore Companies</h3>
                            <p>Get a change to work in favourite companies</p>
                        </div>
                    </div>
                    <div class="serviceCard studentserviceCard2">
                        <div class="imagePart">
                            <img src="../../assets/internship.jpg" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Explore Internships</h3>
                            <p>Find a internship to enhance your skills</p>
                        </div>
                    </div>
                    <div class="serviceCard studentserviceCard3">
                        <div class="imagePart">
                            <img src="../../assets/job.jpeg" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Explore Jobs</h3>
                            <p>Find a job of your dream</p>
                        </div>
                    </div>
                </div>

                <div class="serviceButtons">
                <a href="../profiles/admin/something.php"><button class="serviceRegister">Know more</button></a>
                <a href="../LoginandRegister/studentLogin.php"><button class="serviceLogin">Login &#x25B6;</button></a>
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
                            <img src="../../assets/talent.jpg" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Search for Talent</h3>
                            <p>Find profiles that exactly match your needs</p>
                        </div>
                    </div>
                    <div class="serviceCard companyserviceCard2">
                        <div class="imagePart">
                            <img src="../../assets/internshipOnline.jpg" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Post Internships</h3>
                            <p>Find interns to work on your projects</p>
                        </div>
                    </div>
                    <div class="serviceCard companyserviceCard3">
                        <div class="imagePart">
                            <img src="../../assets/jobs.jpg" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Post Jobs</h3>
                            <p>Find the best candidates for your company</p>
                        </div>
                    </div>
                </div>

                <div class="serviceButtons">
                <a href="../profiles/admin/something.php"><button class="serviceRegister">Know more</button></a>
                <a href="../LoginandRegister/companyLogin.php"><button class="serviceLogin">Login &#x25B6;</button></a>
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
                            <img src="../../assets/companies.png" alt="">
                        </div>
                        <div class="textPart">
                            <h3>Connect with Companies</h3>
                            <p>Get the best companies to visit your campus</p>
                        </div>
                    </div>
                    <div class="serviceCard universityserviceCard2">
                        <div class="imagePart">
                            <img src="../../assets/connection.jpg" alt="">
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
                            <img src="../../assets/skill.webp" alt="">
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
                <a href="../profiles/admin/something.php"><button class="serviceRegister">Know more</button></a>
                <a href="../LoginandRegister/studentLogin.php"><button class="serviceLogin">Login &#x25B6;</button></a>
                </div>
            </div>
        </div>

        <!-- trust worthy -->

        <!-- company marquee -->
        <div class="companyMarquee">
        <h2>Top companies trust us</h2>
        <marquee direction="right" scrollamount="15" class="companyMarqueeslide">
            <img src="../../assets/Meta.png" alt="">
            <img src="../../assets/TCS.png" alt="">
            <img src="../../assets/CAP.png" alt="">
            <img src="../../assets/Accenture.png" alt="">
            <img src="../../assets/ibm.png" alt="">
            <img src="../../assets/deloitte.png" alt="">
            <img src="../../assets/wipro.webp" alt="">
            <img src="../../assets/infosys.webp" alt="">
            <img src="../../assets/intel.png" alt="">
            <img src="../../assets/adani.png" alt="">
            <img src="../../assets/HU.png" alt="">
            <img src="../../assets/Amazon.png" alt="">
            <img src="../../assets/AMD.png" alt="">
            <img src="../../assets/samsung.png" alt="">
            <img src="../../assets/nvidia.png" alt="">
            <img src="../../assets/riot.png" alt="">
        </marquee>
        </div>

        <!-- university marquee -->
        <div class="companyMarquee universityMarquee">
        <h2>15+ universities alreay registered</h2>
        <marquee direction="left" scrollamount="15" class="companyMarqueeslide">
            <img src="../../assets/Nitmas.png" alt="">
            <img src="../../assets/tnu.png" alt="">
            <img src="../../assets/ashoka.webp" alt="">
            <img src="../../assets/OP.png" alt="">
            <img src="../../assets/TI.png" alt="">
            <img src="../../assets/VIT.png" alt="">
            <img src="../../assets/UEM.png" alt="">
            <img src="../../assets/Toronto.png" alt="">
            <img src="../../assets/Princeton.png" alt="">
            <img src="../../assets/Bristol.png" alt="">
            <img src="../../assets/Lines.webp" alt="">
            <img src="../../assets/Fairfield.png" alt="">
            <img src="../../assets/howard.png" alt="">
            <img src="../../assets/Cambridge.png" alt="">
            <img src="../../assets/Open.png" alt="">
            <img src="../../assets/Illi.png" alt="">
        </marquee>
        </div>

        <div class="counts">
            <div class="companyCount countText">
                <h1 data-count="21">0</h1>
                <p>Companies hiring</p>
            </div>
            <div class="internshipCount countText">
                <h1 data-count="52">0</h1>
                <p>Internships available</p>
            </div>
            <div class="studentsCount countText">
                <h1 data-count="121">0</h1>
                <p>Students registered</p>
            </div>
            <div class="jobCount countText">
                <h1 data-count="66">0</h1>
                <p>Jobs available</p>
            </div>
        </div>

        <div class="registerFooter">
            
        </div>
    </div>


    <!-- footer -->
    <footer class="footerMainlanding"></footer>

    <script src="../../javaScripts/buttonPop.js"></script>
    <script src="../../javaScripts/countUpAnim.js"></script>
    <script src="../../javaScripts/navbarFooter.js"></script>
</body>

</html>