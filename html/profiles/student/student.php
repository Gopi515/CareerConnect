<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student profile</title>
    <link rel="stylesheet" href="../../../style.css">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- wrapper -->
    <div id="wrapper">

        <!-- navbar -->
        <nav id="navbar">

            <div class="container">

                <div class="logo">CareerConnect</div>

                <ul class="nav-links">
                    <li><a href="#"><i class="fas fa-bookmark"></i></a></li>
                    <li><a href="#"><i class="fas fa-message"></i></a></li>
                    <li><a href="#"><i class="fas fa-user"></i></a></li>
                </ul>

            </div>

        </nav>

        <!-- main container -->
        <div class="stu-container">

            <!-- header -->
            <div class="stu-header">
                <p class="header-item1">Hi there!</p>
                <p class="header-item2">Let's get started</p>
            </div>

            <!-- entry boxes -->
            <div class="stu-hero-section">

                <div class="stu-entry-boxes1">

                    <div class="stu-first-name">
                        <p class="stu-para-style1">First name</p>
                        <input type="text" placeholder="Enter first name" class="stu-box-design1" required>
                    </div>

                    <div class="stu-last-name">
                        <p class="stu-para-style1">Last name</p>
                        <input type="text" placeholder="Enter last name" class="stu-box-design1" required>
                    </div>

                </div>

                <div class="stu-entry-boxes2">

                    <div class="stu-email">
                        <p class="stu-para-style1">Email</p>
                        <input type="text" placeholder="Enter email" class="stu-box-design2" required>
                    </div>

                </div>

                <div class="stu-entry-boxes3">

                    <p class="stu-para-style1">Contact number</p>
                    <!-- country code dropdown -->
                    <select name="#" id="country-code">
                        <option value="+91">+91</option>
                        <option value="+880">+880</option>
                        <option value="+977">+977</option>
                        <option value="+7">+7</option>
                        <option value="+1">+1</option>
                        <option value="+49">+49</option>
                        <option value="+33">+33</option>
                        <!-- Add more options for other countries -->
                    </select>
                    <input type="number" placeholder="0000000000" class="mob-box" required> 

                </div>

                <div class="stu-address">
                    <p class="stu-para-style1">Address</p>
                    <p class="stu-para">To connect you with opportunities closer to you</p>
                </div>

                <div class="stu-entry-boxes2">

                    <div class="stu-address1">
                        <p class="stu-para-style2">Address1</p>
                        <input type="text" placeholder="Ex.-House no, Building, Street, Area" class="stu-box-design2" required>
                    </div>

                    <div class="stu-address2">
                        <p class="stu-para-style2">Address2</p>
                        <input type="text" placeholder="Ex.-Locality/Town, City/District" class="stu-box-design2" required>
                    </div>

                </div>

                <div class="stu-entry-boxes4">

                    <div class="pin-state">

                        <div class="stu-pin">
                            <p class="stu-para-style2">Pin</p>
                            <input type="number" placeholder="Enter pin" class="stu-box-design3" required>
                        </div>

                        <div class="stu-state">
                            <p class="stu-para-style2">State</p>
                            <input type="text" placeholder="Enter state" class="stu-box-design3" required>
                        </div>

                    </div>

                    <div class="city-country">

                        <div class="stu-city">
                            <p class="stu-para-style2">City</p>
                            <input type="text" placeholder="Enter city" class="stu-box-design3" required>
                        </div>

                        <div class="stu-country">
                            <p class="stu-para-style2">Country</p>
                            <input type="text" placeholder="Enter country" class="stu-box-design3" required>
                        </div>

                    </div>
                </div>


                <!-- gender button -->


                <div class="stu-gender">
                    <p class="stu-para-style1">Gender</p>
                    <div class="gender-selection">
                        <div class="male">
                            <input type="radio" id="male" name="gender" value="male" class="radio" checked>
                            <label for="male" class="gen-label label-1">Male</label>
                        </div>
                        <div class="female">
                            <input type="radio" id="female" name="gender" value="female" class="radio">
                            <label for="female" class="gen-label label-2">Female</label>
                        </div>
                        <div class="others">
                            <input type="radio" id="others" name="gender" value="others" class="radio">
                            <label for="others" class="gen-label label-3">Others</label>
                        </div>
                    </div> 
                </div> 



                <!-- select languages -->

                <div class="stu-language">


                    <p class="stu-para-style1">Languages you know</p>


                    <div id="selected-items">
                        <div id="selected-items-list"></div>
                    </div>

                    <div class="add-language">
                        <div id="select-items-button" onclick="showMenu()">+ Add Languages</div>
                        <div id="languages">
                          <div class="checkbox-div">
                            <div class="label">
                                <input type="checkbox" value="bengail" id="bengail">
                                <label for="bengail">Bengali</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" value="hindi" id="hindi">
                                <label for="hindi">Hindi</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" value="english" id="english">
                                <label for="english">English</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" value="tamil" id="tamil">
                                <label for="tamil">Tamil</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" value="french" id="french">
                                <label for="french">French</label>
                            </div>
                            <div class="label">
                                <input type="checkbox" value="spanish" id="spanish">
                                <label for="spanish">Spanish</label>
                            </div>
                          </div>
                          <div onclick="addToSelected()" class="ok-btn">OK</div>
                        </div>
                    </div>

                   
                </div>


            </div>

          
            <!-- end next button  -->
            <button value="submit" name="submit" class="btn next-btn">Next</button>

        </div>


    </div>

    <script src="../../../javaScripts/selectLanguage.js"></script>
</body>
</html>


