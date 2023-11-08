<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company profile</title>
    <link rel="stylesheet" href="../../../style.css">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<!-- php  -->



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
        <form action="#" method="POST"  class="com-container">

            <!-- header -->
            <div class="com-header">
                <p class="header-item1">Hi there!</p>
                <p class="header-item2">Let's get started</p>
            </div>

            <!-- entry boxes -->
            <div class="com-hero-section">

                <!-- company name  -->
                <div class="com-entry-boxes1">

                    <div class="com-name">
                        <p class="com-para-style1">Company name</p>
                        <input name="name" type="text" placeholder="Enter the name" class="com-box-design1" required>
                    </div>


                </div>

                <!-- email  -->
                <div class="com-entry-boxes1">

                    <div class="com-email">
                        <p class="com-para-style1">Email</p>
                        <input name="email" type="text" placeholder="Enter email" class="com-box-design1" required>
                    </div>

                </div>

                <!-- contact no  -->
                <div class="com-entry-boxes2">

                    <p class="com-para-style1">Contact number</p>
                    <!-- country code dropdown -->
                    <select name="countrycode" id="country-code">
                        <option value="+91">+91</option>
                        <option value="+880">+880</option>
                        <option value="+977">+977</option>
                        <option value="+7">+7</option>
                        <option value="+1">+1</option>
                        <option value="+49">+49</option>
                        <option value="+33">+33</option>
                        <!-- Add more options for other countries -->
                    </select>
                    <input name="mobilenumber" type="number" placeholder="0000000000" class="mob-box" required> 

                </div>

                <!-- date of arrival  -->
                <div class="com-entry-boxes2">

                    <div class="com-arrival">
                        <p class="com-para-style1">Date of Arrival</p>
                        <input name="arrivaldate" type="date" placeholder="Enter the date you first arrive" class="com-box-design2" required>
                    </div>

                </div>

                <!-- address  -->

                <div class="com-address">
                    <p class="com-para-style1">Address</p>
                    <p class="com-para">To connect you with opportunities closer to you</p>
                </div>

                <div class="com-entry-boxes1">

                    <div class="com-address1">
                        <p class="com-para-style2">Address1</p>
                        <input name="address1" type="text" placeholder="Ex.-House no, Building, Street, Area" class="com-box-design1" required>
                    </div>

                    <div class="com-address2">
                        <p class="com-para-style2">Address2</p>
                        <input name="adderss2" type="text" placeholder="Ex.-Locality/Town, City/District" class="com-box-design1" required>
                    </div>

                </div>

                <div class="com-entry-boxes3">

                    <div class="pin-state">

                        <div class="com-pin">
                            <p class="com-para-style2">Pin</p>
                            <input name="pincode" type="number" placeholder="Enter pin" class="com-box-design2" required>
                        </div>

                        <div class="com-state">
                            <p class="com-para-style2">State</p>
                            <input name="state" type="text" placeholder="Enter state" class="com-box-design2" required>
                        </div>

                    </div>

                    <div class="city-country">

                        <div class="com-city">
                            <p class="com-para-style2">City</p>
                            <input name="city" type="text" placeholder="Enter city" class="com-box-design2" required>
                        </div>

                        <div class="com-country">
                            <p class="com-para-style2">Country</p>
                            <input name="country" type="text" placeholder="Enter country" class="com-box-design2" required>
                        </div>

                    </div>
                </div>


                <!-- compani link -->

                <div class="com-link">
                    <p class="com-para-style1">Compani website</p>
                    <div>
                        <input  name="website" type="text" placeholder="Enter the link of your website" class="com-box-design1" required>
                    </div>
                </div>


                <!-- about section -->

                <div class="com-about">


                    <p class="com-para-style1">About</p>
                    <div>
                        <input  name="about" type="text" placeholder="Write about your company" class="com-box-design1" required>
                    </div>
                   
                </div>


            </div>

          
            <!-- end next button  -->
            <button value="submit" name="submit" class="btn next-btn">Next</button>

        </form>


    </div>

    
</body>
</html>