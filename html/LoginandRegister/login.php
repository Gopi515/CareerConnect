<!DOCTYPE html>
<html lang="en">
<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- titles -->
    <title>CareerConnect-Login</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../style.css">

</head>
<body>

    <div class="login-page">

        <!-- leftside -->
        <div class="left-side"><h1>WELCOME TO, <br><span class="title-name">CAREER CONNECT</span></h1></div>

        <!-- rightside -->
        <div class="right-side">

            <!-- for the re-direct -->
            <div class="right-card">
                <button class="btn" id="teacherButton">Teacher</button>
                <button class="btn" id="studentButton">Student</button>
                <button class="btn" id="companyButton">Company</button>
            </div>

            <!-- entries -->
            <div class="entry">
                <div class="withsubmit">
                    <div class="inputboxes">
                        <p class="inphead user-name">User Name</p>
                        <input class="pleasebox" type="text" placeholder="Enter your username">
                        
                        <p class="inphead email">Email</p>
                        <input class="pleasebox" type="email" placeholder="Enter the email">
                        
                        <p class="inphead password">Password</p>
                        <input class="pleasebox" type="password" placeholder="Password please">
                    </div>
                    <div class="subdiv">
                        <button class="btn submit" id="submitButton" onclick="submitSelection()">Login</button>
                    </div>
                </div>

                <!-- registration re-direct -->
                <div class="gotoreg">
                    <p>Don't have an account?</p>
                    <a href="../LoginandRegister/register.php"><button class="btn">Register Here</button></a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript connects -->
    <script src="/javaScripts/pageRedirect.js"></script>
    <script src="/javaScripts/selectGender.js"></script>
</body>
</html>