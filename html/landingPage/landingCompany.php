<!DOCTYPE html>
<html lang="en">
<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- title -->
    <title>Landing Company</title>

    <!-- linking -->
    <link rel="stylesheet" href="../../style.css">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>    
</head>
<body>
    <!-- welcome section -->
    <header>
        <nav id="navbar">
            <div class="container">
                <div class="logo">CareerConnect</div>
                <ul class="nav-links">
                    <li><a href="#"><i class="fas fa-window-restore"></i></a></li>
                    <div class="dropdown">
                        <li onclick="toggleDropdown()"><a><i class="fas fa-user" id="postOptions"></i></a>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="../profiles/company/viewCompanyDetails.php">View Profile</a>
                                <a href="../profiles/company/company.php">Edit Profile Details</a>
                                <a href="../profiles/company/addinternship.php">Post Internship</a>
                                <a href="../profiles/company/addjob.php">Post Job</a>
                            </div>
                        </li>
                    </div>
                </ul>
            </div>
        </nav>
    </header>

    <!-- <script src="../../javaScripts/dropdown.js"></script> -->
    <script src="../../javaScripts/showDropdown.js"></script>

</body>
</html>