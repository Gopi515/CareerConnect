<?php
session_start();
if (!isset($_SESSION['mail'])) {
  header("Location: ../LoginandRegister/studentLogin.php");
}
?>

<?php
require '../../dbconnect.php';

$limit = 6;

$query = "SELECT * FROM internships ORDER BY topic ASC LIMIT $limit";
$result1 = mysqli_query($conn, $query);

$query = "SELECT * FROM internships ORDER BY topic DESC LIMIT $limit";
$result2 = mysqli_query($conn, $query);

$query = "SELECT * FROM job ORDER BY topic ASC LIMIT $limit";
$result3 = mysqli_query($conn, $query);

$query = "SELECT * FROM job ORDER BY topic DESC LIMIT $limit";
$result4 = mysqli_query($conn, $query);
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Student</title>
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>" />
    <!-- <link rel="stylesheet" href="../profiles/student/resume.css?v=<?php echo time(); ?>" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> -->
    <!-- SWIPER CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <script
      src="https://kit.fontawesome.com/0d6185a30c.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <body class="bg-img">
    <!-- welcome section -->
    <header>
      <nav id="navbar">
        <div class="container">
          <div class="logo">CareerConnect</div>
          <ul class="nav-links">
            <li>
              <a href="../Internship/internship.php" class="navItems"
                >Internship
                <span class="navItemshover" style="margin-left: -110px"
                  >Find best internships</span
                >
              </a>
            </li>
            <li>
              <a href="../Job/job.php" class="navItems"
                >Job
                <span class="navItemshover" style="margin-left: -75px"
                  >Find best jobs</span
                >
              </a>
            </li>
            <li>
              <div id="skillTest" onclick="openTheSkill()" class="navItems"
                >Skill Test
                <span class="navItemshover" style="margin-left: -100px"
                  >Check your Skill with Skill Test</span
                >
              </div>
            </li>

            <div class="dropdown">
              <li onclick="toggleDropdown()">
                <a class="navItems"
                  ><i class="fas fa-user" id="postOptions"></i>
                  <span class="navItemshover">Your profile</span>
                </a>
                <div id="myDropdown" class="dropdown-content">
                  <a href="../profiles/student/student.php">Create Profile</a>
                  <a href="../profiles/student/viewStudentDetails.php"
                    >View Profile</a
                  >
                  <a href="../profiles/student/updateStudentDetails.php"
                    >Update Profile</a
                  >
                  <a href="../profiles/student/resume.php">Resume/CV builder</a>
                  <a href="../Internship/appliedInternship.php"
                    >Applied Internship</a
                  >
                  <a href="../Job/appliedJob.php">Applied Job</a>
                  <a onclick="openLogOut()">Log Out</a>
                </div>
              </li>
            </div>
          </ul>
        </div>
      </nav>
    </header>

    <!-- content area -->
    <div class="content">
      <div class="helloText">
        <h1>Hi, There! &#128075;</h1>
        <p>Explore</p>
      </div>

      <div>
      <div class="overlay" id="overlay" style="display: none;"></div>
      <div id="skilladdpart">
        <div class="cv-form-blk">
          <div class="cv-form-row-title">
              <h3>Skills</h3>
          </div>
          <div class="row-separator repeater">
              <div class="repeater" data-repeater-list="group-e">
                  <div data-repeater-item>
                      <div class="cv-form-row cv-form-row-skills">
                          <div ss="form-elem">
                              <div class="input-options">
                                  <div class="option-dropdown">
                                      <select name="skill" class="form-control skill" id="skill_select">
                                          <option value="">Select Skill</option>
                                          <option value="AJAX">AJAX</option>
                                          <option value="ALGORITHMS">ALGORITHMS</option>
                                          <option value="AMAZON WEB SERVICE">AMAZON WEB SERVICE</option>
                                          <option value="ANDROID APP DEVELOPMENT">ANDROID APP DEVELOPMENT</option>
                                          <option value="ANGULAR">ANGULAR</option>
                                          <option value="ANIMATION">ANIMATION</option>
                                          <option value="APACHE">APACHE</option>
                                          <option value="APIs">APIs</option>
                                          <option value="ARTIFICIAL INTELLIGENCE">ARTIFICIAL INTELLIGENCE</option>
                                          <option value="AUTOCAD">AUTOCAD</option>
                                          <option value="AUTOMOBILE ENGINEERING">AUTOMOBILE ENGINEERING</option>
                                          <option value="AWS">AWS</option>
                                          <option value="BACKEND DEVELOPMENT">BACKEND DEVELOPMENT</option>
                                          <option value="BIOLOGY">BIOLOGY</option>
                                          <option value="BLOCKCHAIN">BLOCKCHAIN</option>
                                          <option value="BLOGGING">BLOGGING</option>
                                          <option value="BOOTSTRAP">BOOTSTRAP</option>
                                          <option value="BUSINESS DEVELOPMENT">BUSINESS DEVELOPMENT</option>
                                          <option value="Budgeting">Budgeting</option>
                                          <option value="C">C</option>
                                          <option value="C#">C#</option>
                                          <option value="C++">C++</option>
                                          <option value="CANVA">CANVA</option>
                                          <option value="CodeIgniter">CodeIgniter</option>
                                          <option value="CIVIL ENGINEERING">CIVIL ENGINEERING</option>
                                          <option value="CLOUD COMPUTING">CLOUD COMPUTING</option>
                                          <option value="COMPUTER NETWORKS">COMPUTER NETWORKS</option>
                                          <option value="CONTENT MARKETING">CONTENT MARKETING</option>
                                          <option value="CONTENT WRITING">CONTENT WRITING</option>
                                          <option value="COPYWRITING">COPYWRITING</option>
                                          <option value="CREATIVE DESIGN">CREATIVE DESIGN</option>
                                          <option value="CSS">CSS</option>
                                          <option value="CYBER SECURITY">CYBER SECURITY</option>
                                          <option value="DATA ANALYSIS">DATA ANALYSIS</option>
                                          <option value="DATA ENTRY">DATA ENTRY</option>
                                          <option value="DATA SCIENCE">DATA SCIENCE</option>
                                          <option value="DATA STRUCTURES">DATA STRUCTURES</option>
                                          <option value="DECISION MAKING">DECISION MAKING</option>
                                          <option value="DEEP LEARNING">DEEP LEARNING</option>
                                          <option value="DESIGN THINKING">DESIGN THINKING</option>
                                          <option value="DJANGO">DJANGO</option>
                                          <option value="DART">DART</option>
                                          <option value="DOCKER">DOCKER</option>
                                          <option value="DIGITAL ART">DIGITAL ART</option>
                                          <option value="DIGITAL MARKETING">DIGITAL MARKETING</option>
                                          <option value="EDITING">EDITING</option>
                                          <option value="EMAIL MARKETING">EMAIL MARKETING</option>
                                          <option value="ETHICAL HACKING">ETHICAL HACKING</option>
                                          <option value="ECONOMICS">ECONOMICS</option>
                                          <option value="ECLIPSE">ECLIPSE</option>
                                          <option value="EFFECTIVE COMMUNICATION">EFFECTIVE COMMUNICATION</option>
                                          <option value="ELECTRICAL ENGINEERNING">ELECTRICAL ENGINEERNING</option>
                                          <option value="ENGINEERING DESIGN">ENGINEERING DESIGN</option>
                                          <option value="ENGINEERING DRAWING">ENGINEERING DRAWING</option>
                                          <option value="ETHEREUM">ETHEREUM</option>
                                          <option value="EXPRESS.JS">EXPRESS.JS</option>
                                          <option value="FACEBOOK ADS">FACEBOOK ADS</option>
                                          <option value="FACEBOOK MARKETING">FACEBOOK MARKETING</option>
                                          <option value="FASHION DESIGN">FASHION DESIGN</option>
                                          <option value="FASHION STYLING">FASHION STYLING</option>
                                          <option value="FASTAPI">FASTAPI</option>
                                          <option value="FINAL CUT PRO">FINAL CUT PRO</option>
                                          <option value="FINANCE">FINANCE</option>
                                          <option value="FINANCIAL ANALYSIS">FINANCIAL ANALYSIS</option>
                                          <option value="FINANCIAL MODELING">FINANCIAL MODELING</option>
                                          <option value="FIREBASE">FIREBASE</option>
                                          <option value="FIREWALL CONFIGURATION">FIREWALL CONFIGURATION</option>
                                          <option value="FLASH">FLASH</option>
                                          <option value="FLASK">FLASK</option>
                                          <option value="FLUTTER">FLUTTER</option>
                                          <option value="FRONTEND DEVELOPMENT">FRONTEND DEVELOPMENT</option>
                                          <option value="FULL STACK DEVELOPMENT">FULL STACK DEVELOPMENT</option>
                                          <option value="FIGMA">FIGMA</option>
                                          <option value="GIT">GIT</option>
                                          <option value="GIT BASH">GIT BASH</option>
                                          <option value="GITHUB">GITHUB</option>
                                          <option value="GITLAB">GITLAB</option>
                                          <option value="GAME DESIGN">GAME DESIGN</option>
                                          <option value="GAME DEVELOPMENT">GAME DEVELOPMENT</option>
                                          <option value="GOOGLE ANALYTICS">GOOGLE ANALYTICS</option>
                                          <option value="GOOGLE CLOUD COMPUTING">GOOGLE CLOUD COMPUTING</option>
                                          <option value="GOOGLE SKETCHUP">GOOGLE SKETCHUP</option>
                                          <option value="GOOGLE WORKSPACE">GOOGLE WORKSPACE</option>
                                          <option value="GRAPHIC DESIGN">GRAPHIC DESIGN</option>
                                          <option value="HOTEL MANAGEMENT">HOTEL MANAGEMENT</option>
                                          <option value="HUMAN RESOURCES">HUMAN RESOURCES</option>
                                          <option value="HTML">HTML</option>
                                          <option value="ILLUSTRATION">ILLUSTRATION</option>
                                          <option value="IMAGE PROCESSING">IMAGE PROCESSING</option>
                                          <option value="INFORMATION TECHNOLOGY">INFORMATION TECHNOLOGY</option>
                                          <option value="INSTAGRAM MARKETING">INSTAGRAM MARKETING</option>
                                          <option value="INVESTMENT ANALYSIS">INVESTMENT ANALYSIS</option>
                                          <option value="IOS">IOS</option>
                                          <option value="JAVA">JAVA</option>
                                          <option value="JAVASCRIPT">JAVASCRIPT</option>
                                          <option value="JENKINS">JENKINS</option>
                                          <option value="JOURNALISM">JOURNALISM</option>
                                          <option value="JSON">JSON</option>
                                          <option value="JSP">JSP</option>
                                          <option value="JQUERY">JQUERY</option>
                                          <option value="KOTLIN">KOTLIN</option>
                                          <option value="KUBERNETES">KUBERNETES</option>
                                          <option value="LEADERSHIP">LEADERSHIP</option>
                                          <option value="LARAVEl">LARAVEl</option>
                                          <option value="LEAGUE OF LEGENDS">LEAGUE OF LEGENDS</option>
                                          <option value="LINKEDIN MARKETING">LINKEDIN MARKETING</option>
                                          <option value="LINEAR PROGRAMMING">LINEAR PROGRAMMING</option>
                                          <option value="LINUX">LINUX</option>
                                          <option value="MACHINE LEARNING">MACHINE LEARNING</option>
                                          <option value="MATLAB">MATLAB</option>
                                          <option value="MEAN STACK">MEAN STACK</option>
                                          <option value="MERN STACK">MERN STACK</option>
                                          <option value="MICROSOFT VISUAL STUDIO">MICROSOFT VISUAL STUDIO</option>
                                          <option value="MOBILE APP DEVELOPMENT">MOBILE APP DEVELOPMENT</option>
                                          <option value="MONGODB">MONGODB</option>
                                          <option value="MS-EXCEL">MS-EXCEL</option>
                                          <option value="MS-OFFICE">MS-OFFICE</option>
                                          <option value="MS-POWERPOINT">MS-POWERPOINT</option>
                                          <option value="MS-WORD">MS-WORD</option>
                                          <option value="MYSQL">MYSQL</option>
                                          <option value="Maya">Maya</option>
                                          <option value="NETWORKING">NETWORKING</option>
                                          <option value="NEXT.JS">NEXT.JS</option>
                                          <option value="NODE.JS">NODE.JS</option>
                                          <option value="NOSQL">NOSQL</option>
                                          <option value="OBJECTIVE C">OBJECTIVE C</option>
                                          <option value="ONLINE TEACHING">ONLINE TEACHING</option>
                                          <option value="OPENCV">OPENCV</option>
                                          <option value="ORACLE">ORACLE</option>
                                          <option value="PENETRATION TESTING">PENETRATION TESTING</option>
                                          <option value="PHOTOGRAPHY">PHOTOGRAPHY</option>
                                          <option value="PHOTOSHOP">PHOTOSHOP</option>
                                          <option value="PHP">PHP</option>
                                          <option value="PPC">PPC</option>
                                          <option value="PRODUCT MANAGEMENT">PRODUCT MANAGEMENT</option>
                                          <option value="PROTOTYPING">PROTOTYPING</option>
                                          <option value="PSYCHOLOGY">PSYCHOLOGY</option>
                                          <option value="PYTHON">PYTHON</option>
                                          <option value="PYTORCH">PYTORCH</option>
                                          <option value="PROJECT MANAGEMENT">PROJECT MANAGEMENT</option>
                                          <option value="PROTOTYPING">PROTOTYPING</option>
                                          <option value="PPC">PPC</option>
                                          <option value="PRODUCT MANAGEMENT">PRODUCT MANAGEMENT</option>
                                          <option value="PROTOTYPING">PROTOTYPING</option>
                                          <option value="PSYCHOLOGY">PSYCHOLOGY</option>
                                          <option value="PYTHON">PYTHON</option>
                                          <option value="PYTORCH">PYTORCH</option>
                                          <option value="REACT.JS">REACT.JS</option>
                                          <option value="REACTJS">REACTJS</option>
                                          <option value="REACT">REACT</option>
                                          <option value="REACT NATIVE">REACT NATIVE</option>
                                          <option value="REST API">REST API</option>
                                          <option value="REDUX">REDUX</option>
                                          <option value="RISK MANAGEMENT">RISK MANAGEMENT</option>
                                          <option value="RUBY ON RAILS">RUBY ON RAILS</option>
                                          <option value="RUBY">RUBY</option>
                                          <option value="RUST">RUST</option>
                                          <option value="SEARCH ENGINE OPTIMIZATION">SEARCH ENGINE OPTIMIZATION</option>
                                          <option value="SEM">SEM</option>
                                          <option value="SEO">SEO</option>
                                          <option value="SKETCH">SKETCH</option>
                                          <option value="SOCIAL MEDIA MARKETING">SOCIAL MEDIA MARKETING</option>
                                          <option value="SOCIAL WORK">SOCIAL WORK</option>
                                          <option value="SOFTWARE DEVELOPMENT">SOFTWARE DEVELOPMENT</option>
                                          <option value="SQL">SQL</option>
                                          <option value="STATISTICS">STATISTICS</option>
                                          <option value="STOCK MARKETING">STOCK MARKETING</option>
                                          <option value="STOCK TRADING">STOCK TRADING</option>
                                          <option value="SWIFT">SWIFT</option>
                                          <option value="TAILWIND CSS">TAILWIND CSS</option>
                                          <option value="TALLY">TALLY</option>
                                          <option value="TEAM COLLABORATION">TEAM COLLABORATION</option>
                                          <option value="TEACHING">TEACHING</option>
                                          <option value="TECHNICAL WRITING">TECHNICAL WRITING</option>
                                          <option value="TABLEAU">TABLEAU</option>
                                          <option value="TENSORFLOW">TENSORFLOW</option>
                                          <option value="TIME MANAGEMENT">TIME MANAGEMENT</option>
                                          <option value="TRANSCRIPTION">TRANSCRIPTION</option>
                                          <option value="TRAINING AND DEVELOPMENT">TRAINING AND DEVELOPMENT</option>
                                          <option value="TRANSLATION">TRANSLATION</option>
                                          <option value="TYPOGRAPHY">TYPOGRAPHY</option>
                                          <option value="UI & UX DESIGN">UI & UX DESIGN</option>
                                          <option value="UI/UX DESIGN">UI/UX DESIGN</option>
                                          <option value="UNITY 3D">UNITY 3D</option>
                                          <option value="UNITY ENGINE">UNITY ENGINE</option>
                                          <option value="UNITY">UNITY</option>
                                          <option value="UNREAL ENGINE">UNREAL ENGINE</option>
                                          <option value="VS CODE">VS CODE</option>
                                          <option value="VUE JS">VUE JS</option>
                                          <option value="VIDEOGRAPHY">VIDEOGRAPHY</option>
                                          <option value="VIDEO EDITING">VIDEO EDITING</option>
                                          <option value="WEB APPLICATION SECURITY">WEB APPLICATION SECURITY</option>
                                          <option value="WEB DESIGN">WEB DESIGN</option>
                                          <option value="WEB DEVELOPMENT">WEB DEVELOPMENT</option>
                                          <option value="WEBFLOW">WEBFLOW</option>
                                          <option value="WINDOWS MOBILE APPLICATION DESIGN">WINDOWS MOBILE APPLICATION DESIGN
                                          </option>
                                          <option value="WORDPRESS">WORDPRESS</option>
                                          <option value="WIREFRAMING">WIREFRAMING</option>
                                          <option value="XML">XML</option>
                                          <option value="XCODE">XCODE</option>
                                          <option value="YOUTUBE ADS">YOUTUBE ADS</option>
                                          <option value="ZBRUSH">ZBRUSH</option>
                                          <!-- Add more options as needed -->
                                      </select>
                                  </div>
                              </div>
                              <div class="btn">Take Test</div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="closeRegIn" id="closeUploadQuestion" onclick="closeTheSkill()"><i class="fa-solid fa-xmark"></i></div>
        </div>
      </div>
    </div>

      <!-- trending section -->
      <div class="trending">
        <h1 style="margin-bottom: 80px">Internships</h1>
        <a href="../Internship/internship.php" class="landingToall">View all ></a>
        <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <?php
    while ($row = mysqli_fetch_assoc($result1)) {
      ?>
          <div class="swiper-slide">
            <div class="detailodd">
              <div class="lol">
                <img src="../../assets/<?php echo $row['topic_image']; ?>" alt="image missing" />
                <div class="content">
                  <h3><?php echo $row['topic']; ?></h3>
                  <i class="uil uil-desktop"></i>
                  <i class="uil uil-laptop"></i>
                  <div style="margin-top: 20px">
                    <p><i class="fa-solid fa-location-dot"></i> <?php echo $row['location_name']; ?></p>
                    <p> &#8377; <?php echo $row['stipend']; ?>/month</p>
                    <p><i class="fa-solid fa-clock"></i> <?php echo $row['duration']; ?> months</p>
                  </div>
                  <a href="../Internship/viewDetailsinternship.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
                </div>
              </div>
            </div>
          </div>
        <?php
    }
    ?>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>
</div>

      </div>

      <!-- Internship section -->
      <div class="Internship_section">
        <h1 style="margin-bottom: -80px">New Internships</h1>
        <a href="../Internship/internship.php" class="landingToall" style="margin-top: 165px;">View all ></a>
        <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <?php
    while ($row = mysqli_fetch_assoc($result2)) {
      ?>
          <div class="swiper-slide">
            <div class="detailodd">
              <div class="lol">
                <img src="../../assets/<?php echo $row['topic_image']; ?>" alt="image missing" />
                <div class="content">
                  <h3><?php echo $row['topic']; ?></h3>
                  <i class="uil uil-desktop"></i>
                  <i class="uil uil-laptop"></i>
                  <div style="margin-top: 20px">
                    <p><i class="fa-solid fa-location-dot"></i> <?php echo $row['location_name']; ?></p>
                    <p>&#8377; <?php echo $row['stipend']; ?>/month</p>
                    <p><i class="fa-solid fa-clock"></i> <?php echo $row['duration']; ?> months</p>
                  </div>
                  <a href="../Internship/viewDetailsinternship.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
                </div>
              </div>
            </div>
          </div>
        <?php
    }
    ?>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>
</div>
      </div>

      <!-- Jobs section -->
      <div class="Job">
        <h1 style="margin-bottom: -80px">Jobs</h1>
        <a href="../Job/job.php" class="landingToall" style="margin-top: 170px;">View all ></a>
        <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <?php
    while ($row = mysqli_fetch_assoc($result3)) {
      ?>
          <div class="swiper-slide">
            <div class="detailodd">
              <div class="lol">
                <img src="../../assets/<?php echo $row['topic_image']; ?>" alt="image missing" />
                <div class="content">
                  <h3><?php echo $row['topic']; ?></h3>
                  <i class="uil uil-desktop"></i>
                  <i class="uil uil-laptop"></i>
                  <div style="margin-top: 20px">
                    <p><i class="fa-solid fa-location-dot"></i> <?php echo $row['location_name']; ?></p>
                    <p>&#8377; <?php echo $row['CTC']; ?>/month</p>
                  </div>
                  <a href="../Job/viewDetailsjob.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
                </div>
              </div>
            </div>
          </div>
        <?php
    }
    ?>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>
</div>
      </div>

      <!-- preferences section -->
      <div class="preferences">
        <h1 style="margin-bottom: -80px">New Jobs</h1>
        <a href="../Job/job.php" class="landingToall" style="margin-top: 175px;">View all ></a>
        <div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <?php
    while ($row = mysqli_fetch_assoc($result4)) {
      ?>
          <div class="swiper-slide">
            <div class="detailodd">
              <div class="lol">
                <img src="../../assets/<?php echo $row['topic_image']; ?>" alt="image missing" />
                <div class="content">
                  <h3><?php echo $row['topic']; ?></h3>
                  <i class="uil uil-desktop"></i>
                  <i class="uil uil-laptop"></i>
                  <div style="margin-top: 20px">
                    <p><i class="fa-solid fa-location-dot"></i> <?php echo $row['location_name']; ?></p>
                    <p>&#8377;</i> <?php echo $row['CTC']; ?>/month</p>
                  </div>
                  <a href="../Job/viewDetailsjob.php?id=<?php echo $row["id"]; ?>" target="blank">View Details</a>
                </div>
              </div>
            </div>
          </div>
        <?php
    }
    ?>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>
</div>
      </div>
    </div>
    <section class="home-section">
      <div
        id="blurBackground"
        class="blur-background"
        style="display: none"
      ></div>
      <div id="logOutPop">
        <div class="log-out-content">
          <div class="log-out-text">Are you sure you want to log out?</div>
          <div class="log-out-buttons">
            <div class="choice yes" onclick="logOut()">Yes</div>
            <div class="choice no" onclick="closeLogOut()">No</div>
          </div>
        </div>
        <!-- <div id="closeLogout" onclick="closeLogOut()"><i class='bx bx-x'></i></div> -->
      </div>
    </section>

    <!-- footer -->
    <footer class="stufooter">
      <div class="footerMainlanding">
        <div class="footerContainer">
          <a class="footertopicname" href="#">
            <div class="footerLogo">CareerConnect</div>
          </a>
          <div class="footerLinks">
            <ul>
              <li><a href="../Internship/internship.php">Internships</a></li>
              <li><a href="../Job/job.php">Jobs</a></li>
              <li><a href="../profiles/student/resume.php">CV Builder</a></li>
              <li>
                <a href="mailto:careerconnect383@gmail.com">Contact Us</a>
              </li>
            </ul>
          </div>
          <div class="footerSocial">
            <ul>
              <li>
                <a class="facebook" href="https://www.facebook.com/"
                  ><i class="fab fa-facebook-f"></i
                ></a>
              </li>
              <li>
                <a class="twitter" href="https://twitter.com/?lang=en"
                  ><i class="fa-brands fa-x-twitter"></i
                ></a>
              </li>
              <li>
                <a class="youtube" href="https://www.youtube.com/"
                  ><i class="fab fa-youtube"></i
                ></a>
              </li>
              <li>
                <a class="linkedin" href="https://www.linkedin.com/"
                  ><i class="fab fa-linkedin"></i
                ></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="footerBottom">
          <p>
            &copy; 2024 CareerConnect. Made with ❤️ by Gopinath, Arnab and
            Priyadarsi.
          </p>
        </div>
      </div>
    </footer>

    <!-- script -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="../../javaScripts/slider.js"></script>
    <script src="../../javaScripts/showDropdown.js"></script>
    <script src="../../javaScripts/buttonPop.js"></script>
    <script src="../../javaScripts/landingInternshipJobLogout.js"></script>
  </body>
</html>
