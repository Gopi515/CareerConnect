<?php
session_start();
if (!isset($_SESSION['mail'])) {
  header("Location: ../LoginandRegister/studentLogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Student</title>
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <script
      src="https://kit.fontawesome.com/0d6185a30c.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <body>
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
              <a href="../CEE/home.php" class="navItems"
                ><i class="fa-solid fa-code"></i>
                <span class="navItemshover">Test your skill</span>
              </a>
            </li>

            <div class="dropdown">
              <li onclick="toggleDropdown()">
                <a class="navItems"
                  ><i class="fas fa-user" id="postOptions"></i>
                  <span class="navItemshover">Your profile</span>
                </a>
                <div id="myDropdown" class="dropdown-content">
                  <a href="../profiles/student/student.php">Create Profile</a>
                  <a href="../profiles/student/viewStudentDetails.php">View Profile</a>
                  <a href="../profiles/student/updateStudentDetails.php">Update Profile</a>
                  <a href="../profiles/student/resume.php">Resume/CV builder</a>
                  <a href="../Internship/appliedInternship.php">Applied Internship</a>
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

      <!-- trending section -->
      <div class="trending">
        <h1>Trending on CareerConnect &#128293;</h1>
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="card1 cards"></div>
              <div class="card2 cards"></div>
              <div class="card3 cards"></div>
            </div>
            <div class="swiper-slide">
              <div class="card4 cards"></div>
              <div class="card5 cards"></div>
              <div class="card6 cards"></div>
            </div>
            <div class="swiper-slide">
              <div class="card7 cards"></div>
              <div class="card8 cards"></div>
              <div class="card9 cards"></div>
            </div>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

      <!-- Internship section -->
      <div class="Internship_section">
        <h1>Internships</h1>
        <div class="swiper mySwiper swiper-Int">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="card10 cards">
                <div class="cardContent">
                  <div class="imageCard">
                    <img src="../../assets/frontendDevelopment.png" alt="" />
                  </div>
                  <!-- internship details -->

                  <div class="infos">
                    <div class="activeHire">
                      <i class="fa-solid fa-chart-line"></i>
                      <p>Active Hiring</p>
                    </div>
                    <h2>Android Teaching Assistance (Virtual)</h2>
                    <div class="locationP">
                      <i class="fa-solid fa-location-dot"></i>
                      <p>work from home</p>
                    </div>
                    <div class="stipendP">
                      <i class="fa-solid fa-money-bill"></i>
                      <p>₹ 5,000,00 - 10,000,00/year</p>
                    </div>

                    <a href="">View details ></a>
                  </div>
                </div>
              </div>

              <div class="card11 cards">
                <div class="cardContent">
                  <div class="imageCard">
                    <img src="../../assets/fullStack.jpg" alt="" />
                  </div>
                  <!-- internship details -->

                  <div class="infos">
                    <div class="activeHire">
                      <i class="fa-solid fa-chart-line"></i>
                      <p>Active Hiring</p>
                    </div>
                    <h2>Android Teaching Assistance (Virtual)</h2>
                    <div class="locationP">
                      <i class="fa-solid fa-location-dot"></i>
                      <p>work from home</p>
                    </div>
                    <div class="stipendP">
                      <i class="fa-solid fa-money-bill"></i>
                      <p>₹ 5,000,00 - 10,000,00/year</p>
                    </div>

                    <a href="">View details ></a>
                  </div>
                </div>
              </div>
              <div class="card12 cards">
                <div class="cardContent">
                  <div class="imageCard">
                    <img src="../../assets/backend.jpg" alt="" />
                  </div>
                  <!-- internship details -->

                  <div class="infos">
                    <div class="activeHire">
                      <i class="fa-solid fa-chart-line"></i>
                      <p>Active Hiring</p>
                    </div>
                    <h2>Android Teaching Assistance (Virtual)</h2>
                    <div class="locationP">
                      <i class="fa-solid fa-location-dot"></i>
                      <p>work from home</p>
                    </div>
                    <div class="stipendP">
                      <i class="fa-solid fa-money-bill"></i>
                      <p>₹ 5,000,00 - 10,000,00/year</p>
                    </div>

                    <a href="">View details ></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="card13 cards">
                <div class="cardContent">
                  <div class="imageCard">
                    <img src="../../assets/iosApp.jpg" alt="" />
                  </div>
                  <!-- internship details -->

                  <div class="infos">
                    <div class="activeHire">
                      <i class="fa-solid fa-chart-line"></i>
                      <p>Active Hiring</p>
                    </div>
                    <h2>Android Teaching Assistance (Virtual)</h2>
                    <div class="locationP">
                      <i class="fa-solid fa-location-dot"></i>
                      <p>work from home</p>
                    </div>
                    <div class="stipendP">
                      <i class="fa-solid fa-money-bill"></i>
                      <p>₹ 5,000,00 - 10,000,00/year</p>
                    </div>

                    <a href="">View details ></a>
                  </div>
                </div>
              </div>
              <div class="card14 cards">
                <div class="cardContent">
                  <div class="imageCard">
                    <img src="../../assets/blender.jpg" alt="" />
                  </div>
                  <!-- internship details -->

                  <div class="infos">
                    <div class="activeHire">
                      <i class="fa-solid fa-chart-line"></i>
                      <p>Active Hiring</p>
                    </div>
                    <h2>Android Teaching Assistance (Virtual)</h2>
                    <div class="locationP">
                      <i class="fa-solid fa-location-dot"></i>
                      <p>work from home</p>
                    </div>
                    <div class="stipendP">
                      <i class="fa-solid fa-money-bill"></i>
                      <p>₹ 5,000,00 - 10,000,00/year</p>
                    </div>

                    <a href="">View details ></a>
                  </div>
                </div>
              </div>
              <div class="card15 cards">
                <div class="cardContent">
                  <div class="imageCard">
                    <img src="../../assets/wordpress.jpg" alt="" />
                  </div>
                  <!-- internship details -->

                  <div class="infos">
                    <div class="activeHire">
                      <i class="fa-solid fa-chart-line"></i>
                      <p>Active Hiring</p>
                    </div>
                    <h2>Android Teaching Assistance (Virtual)</h2>
                    <div class="locationP">
                      <i class="fa-solid fa-location-dot"></i>
                      <p>work from home</p>
                    </div>
                    <div class="stipendP">
                      <i class="fa-solid fa-money-bill"></i>
                      <p>₹ 5,000,00 - 10,000,00/year</p>
                    </div>

                    <a href="">View details ></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="card16 cards">
                <div class="cardContent">
                  <div class="imageCard">
                    <img src="../../assets/finance.webp" alt="" />
                  </div>
                  <!-- internship details -->

                  <div class="infos">
                    <div class="activeHire">
                      <i class="fa-solid fa-chart-line"></i>
                      <p>Active Hiring</p>
                    </div>
                    <h2>Android Teaching Assistance (Virtual)</h2>
                    <div class="locationP">
                      <i class="fa-solid fa-location-dot"></i>
                      <p>work from home</p>
                    </div>
                    <div class="stipendP">
                      <i class="fa-solid fa-money-bill"></i>
                      <p>₹ 5,000,00 - 10,000,00/year</p>
                    </div>

                    <a href="">View details ></a>
                  </div>
                </div>
              </div>
              <div class="card17 cards">
                <div class="cardContent">
                  <div class="imageCard">
                    <img src="../../assets/fundraising.jpg" alt="" />
                  </div>
                  <!-- internship details -->

                  <div class="infos">
                    <div class="activeHire">
                      <i class="fa-solid fa-chart-line"></i>
                      <p>Active Hiring</p>
                    </div>
                    <h2>Android Teaching Assistance (Virtual)</h2>
                    <div class="locationP">
                      <i class="fa-solid fa-location-dot"></i>
                      <p>work from home</p>
                    </div>
                    <div class="stipendP">
                      <i class="fa-solid fa-money-bill"></i>
                      <p>₹ 5,000,00 - 10,000,00/year</p>
                    </div>

                    <a href="">View details ></a>
                  </div>
                </div>
              </div>
              <div class="card18 cards">
                <div class="cardContent">
                  <div class="imageCard">
                    <img src="../../assets/finance.webp" alt="" />
                  </div>
                  <!-- internship details -->

                  <div class="infos">
                    <div class="activeHire">
                      <i class="fa-solid fa-chart-line"></i>
                      <p>Active Hiring</p>
                    </div>
                    <h2>Android Teaching Assistance (Virtual)</h2>
                    <div class="locationP">
                      <i class="fa-solid fa-location-dot"></i>
                      <p>work from home</p>
                    </div>
                    <div class="stipendP">
                      <i class="fa-solid fa-money-bill"></i>
                      <p>₹ 5,000,00 - 10,000,00/year</p>
                    </div>

                    <a href="">View details ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

      <!-- Jobs section -->
      <div class="Job">
        <h1>Jobs</h1>
        <div class="swiper mySwiper swiper-jobs">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="card28 cards"></div>
              <div class="card29 cards"></div>
              <div class="card30 cards"></div>
            </div>
            <div class="swiper-slide">
              <div class="card31 cards"></div>
              <div class="card32 cards"></div>
              <div class="card33 cards"></div>
            </div>
            <div class="swiper-slide">
              <div class="card34 cards"></div>
              <div class="card35 cards"></div>
              <div class="card36 cards"></div>
            </div>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

      <!-- preferences section -->
      <div class="preferences">
        <h1>Internships and Jobs based on your preferences</h1>
        <div class="swiper mySwiper swiper-preferences">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="card28 cards"></div>
              <div class="card29 cards"></div>
              <div class="card30 cards"></div>
            </div>
            <div class="swiper-slide">
              <div class="card31 cards"></div>
              <div class="card32 cards"></div>
              <div class="card33 cards"></div>
            </div>
            <div class="swiper-slide">
              <div class="card34 cards"></div>
              <div class="card35 cards"></div>
              <div class="card36 cards"></div>
            </div>
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

    <footer></footer>

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="../../javaScripts/slider.js"></script>
    <script src="../../javaScripts/showDropdown.js"></script>
    <script src="../../javaScripts/buttonPop.js"></script>
    <script src="../../javaScripts/landingInternshipJobLogout.js"></script>
  </body>
</html>
