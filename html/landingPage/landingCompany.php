<!DOCTYPE html>
<html lang="en">
<head>

    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=], initial-scale=1.0">

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
                    <li><a href="../Internship/Internship.php">Internship</a></li>
                    <li><a href="../Internship/Internship.php">Job</a></li>
                    <li><a href="#"><i class="fas fa-bookmark"></i></a></li>
                    <li><a href="#"><i class="fas fa-window-restore"></i></a></li>
                    <div class="dropdownCompany">
                    <li><a href="#"><i class="fas fa-user" onclick="showDropdown()" id="postOptions"></i></a>
                        <div class="dropdown-content" id="dropdownOptionsPost">
                            <a href="../profiles/company/addinternship.php" onclick="selectOption('Post Internship')">Post Internship</a>
                            <a href="../profiles/company/addjob.php" onclick="selectOption('Post Job')">Post Job</a>
                          </div>
                    </li>
                </div>
                </ul>
            </div>
        </nav>
    </header>

    <script src="../../javaScripts/dropdown.js"></script>
</body>
</html>