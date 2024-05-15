<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../../LoginandRegister/studentLogin.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Resume Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- custom css -->
    <link rel="stylesheet" href="resume.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<?php 
    require '../../../dbconnect.php';

    if (isset($_SESSION['mail'])){
        $email = $_SESSION['mail'];
    } else {
        echo "<script>alert('Error: Session is not working.')</script>";
    }
    $sql = "SELECT * FROM `stu_personal_details` WHERE `email` = '$email'";
    $student_details = $conn->query($sql);
?>

<body>

    <a href="../../landingPage/landingStudent.php" class="goBack"><i class="back-button fa-regular fa-circle-left"></i></a>

    <?php
        while($row = mysqli_fetch_assoc($student_details)){
    ?>

    <section class="heading-main">
        <div class="main-topic">
            <h1>Build your resume/CV here.</h1>
        </div>
    </section>

    <section id="about-sc" class="">
        <div class="container">
            <div class="about-cnt">
                <form action="" class="cv-form" id="cv-form">
                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>about you section</h3>
                        </div>
                        <div class="cv-form-row cv-form-row-about">
                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="" class="form-label">First Name</label>
                                    <input name="firstname" type="text" value="<?php echo $row["F_name"];?>" class="form-control firstname" id=""
                                        onkeyup="generateCV()" placeholder="e.g. John">
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Middle Name <span
                                            class="opt-text">(optional)</span></label>
                                    <input name="middlename" type="text" class="form-control middlename" id=""
                                        onkeyup="generateCV()" placeholder="e.g. Herbert">
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Last Name</label>
                                    <input name="lastname" type="text" value="<?php echo $row["L_name"];?>" class="form-control lastname" id=""
                                        onkeyup="generateCV()" placeholder="e.g. Doe">
                                    <span class="form-text"></span>
                                </div>
                            </div>

                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="" class="form-label">Your Image</label>
                                    <input name="image" type="file" class="form-control image" id="" accept="image/*"
                                        onchange="previewImage()">
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Designation (optional)</label>
                                    <input name="designation" type="text" class="form-control designation" id=""
                                        onkeyup="generateCV()" placeholder="e.g. Sr. Product Manager">
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Address</label>
                                    <input name="address" type="text" class="form-control address" id=""
                                        onkeyup="generateCV()" placeholder="e.g. Lake Street-23">
                                    <span class="form-text"></span>
                                </div>
                            </div>

                            <div class="cols-3">
                                <div class="form-elem">
                                    <label for="" class="form-label">Email</label>
                                    <input name="email" type="text" value="<?php echo $row["email"];?>" class="form-control email" id=""
                                        onkeyup="generateCV()" placeholder="e.g. johndoe@gmail.com">
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">Phone No:</label>
                                    <input name="phoneno" type="text" value="<?php echo $row["phone_no"];?>" class="form-control phoneno" id=""
                                        onkeyup="generateCV()" placeholder="e.g. 8899112233, 567-654-002">
                                    <span class="form-text"></span>
                                </div>
                                <div class="form-elem">
                                    <label for="" class="form-label">About</label>
                                    <input name="summary" type="text" class="form-control summary" id=""
                                        onkeyup="generateCV()" placeholder="e.g. I am hard working">
                                    <span class="form-text"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>education</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-c">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-experience">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Institution Name</label>
                                                <input name="edu_school" type="text"
                                                    placeholder="e.g. school, collge or university name"
                                                    class="form-control edu_school" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Degree</label>
                                                <input name="edu_degree" type="text"
                                                    placeholder="e.g. secondary, senior secondary, graduate, etc."
                                                    class="form-control edu_degree" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">City</label>
                                                <input name="edu_city" type="text" class="form-control edu_city" id=""
                                                    onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Start Date</label>
                                                <input name="edu_start_date" type="date"
                                                    class="form-control edu_start_date" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">End Date</label>
                                                <input name="edu_graduation_date" type="date"
                                                    class="form-control edu_graduation_date" id=""
                                                    onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="edu_description" type="text"
                                                    class="form-control edu_description" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <button data-repeater-delete type="button"
                                            class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">Add
                                another</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>experience</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-b">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-experience">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Title</label>
                                                <input name="exp_title" placeholder="e.g. Junior web developer"
                                                    type="text" class="form-control exp_title" id=""
                                                    onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Company / Organization</label>
                                                <input name="exp_organization" type="text"
                                                    class="form-control exp_organization"
                                                    placeholder="e.g. tata, infosys" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Location</label>
                                                <input name="exp_location" type="text" class="form-control exp_location"
                                                    id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Start Date</label>
                                                <input name="exp_start_date" type="date"
                                                    class="form-control exp_start_date" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">End Date</label>
                                                <input name="exp_end_date" type="date" class="form-control exp_end_date"
                                                    id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="exp_description" type="text"
                                                    class="form-control exp_description" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>

                                        <button data-repeater-delete type="button"
                                            class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">Add
                                another</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>projects</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-d">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-experience">
                                        <div class="cols-3">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Project Name</label>
                                                <input name="proj_title" type="text" class="form-control proj_title"
                                                    id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Project link</label>
                                                <input name="proj_link" type="text" class="form-control proj_link" id=""
                                                    onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="proj_description" type="text"
                                                    class="form-control proj_description" id="" onkeyup="generateCV()">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>
                                        <button data-repeater-delete type="button"
                                            class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">Add
                                another</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>achievements</h3>
                        </div>

                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-a">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-achievement">
                                        <div class="cols-2">
                                            <div class="form-elem">
                                                <label for="" class="form-label">Title</label>
                                                <input name="achieve_title" type="text"
                                                    class="form-control achieve_title" id="" onkeyup="generateCV()"
                                                    placeholder="e.g. johndoe@gmail.com">
                                                <span class="form-text"></span>
                                            </div>
                                            <div class="form-elem">
                                                <label for="" class="form-label">Description</label>
                                                <input name="achieve_description" type="text"
                                                    class="form-control achieve_description" id=""
                                                    onkeyup="generateCV()" placeholder="e.g. johndoe@gmail.com">
                                                <span class="form-text"></span>
                                            </div>
                                        </div>
                                        <button data-repeater-delete type="button"
                                            class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">Add
                                another</button>
                        </div>
                    </div>

                    <div class="cv-form-blk">
                        <div class="cv-form-row-title">
                            <h3>Skills</h3>
                        </div>
                        <div class="row-separator repeater">
                            <div class="repeater" data-repeater-list="group-e">
                                <div data-repeater-item>
                                    <div class="cv-form-row cv-form-row-skills">
                                        <div ss="form-elem">
                                            <label for="" class="form-label">Skill</label>
                                            <div class="input-options">
                                                <div class="option-dropdown">
                                                    <select name="skill" class="form-control skill" id="skill_select" onchange="generateCV()">
                                                        <option value="">Select Skill</option>
                                                        <select id="skillsDropdown">
  <option value="AJAX">AJAX</option>
  <option value="ALGORITHMS">ALGORITHMS</option>
  <option value="AMAZON WEB SERVICE">AMAZON WEB SERVICE</option>
  <option value="ANDROID APP DEVELOPMENT">ANDROID APP DEVELOPMENT</option>
  <option value="ANGULAR">ANGULAR</option>
  <option value="ANIMATION">ANIMATION</option>
  <option value="APACHE">APACHE</option>
  <option value="APIs">APIs</option>
  <option value="APIS">APIS</option>
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
  <option value="PAYPAL API">PAYPAL API</option>
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
  <option value="WINDOWS MOBILE APPLICATION DESIGN">WINDOWS MOBILE APPLICATION DESIGN</option>
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
                                            <span class="form-text"></span>
                                            <input name="skill" type="text" placeholder="Only type here if the skill is not present in the dropdown" class="form-control skill" id="" onkeyup="generateCV()">
                                        </div>
                                        <button data-repeater-delete type="button" class="repeater-remove-btn">-</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" data-repeater-create value="Add" class="repeater-add-btn">Add another</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <hr>

    <section class="cv-form-preview">
        <div class="cv-form-preview-inner">
            <h3>Preview Area</h3>
        </div>
    </section>

    <section id="preview-sc" class="print_area">
        <div class="container">
            <div class="preview-cnt">
                <div class="preview-cnt-l bg-green text-white">
                    <div class="preview-blk">
                        <div class="preview-image">
                            <img src="" alt="" id="image_dsp">
                        </div>
                        <div class="preview-item preview-item-name">
                            <span class="preview-item-val fw-6" id="fullname_dsp"></span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-item-val text-uppercase fw-6 ls-1" id="designation_dsp"></span>
                        </div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>about</h3>
                        </div>
                        <div class="preview-blk-list">
                            <div class="preview-item">
                                <span class="preview-item-val" id="phoneno_dsp"></span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-item-val" id="email_dsp"></span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-item-val" id="address_dsp"></span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-item-val" id="summary_dsp"></span>
                            </div>
                        </div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>skills</h3>
                        </div>
                        <div class="skills-items preview-blk-list" id="skills_dsp">
                            <!-- skills list here -->
                        </div>
                    </div>
                </div>

                <div class="preview-cnt-r bg-white">
                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>educations</h3>
                        </div>
                        <div class="educations-items preview-blk-list" id="educations_dsp"></div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>experiences</h3>
                        </div>
                        <div class="experiences-items preview-blk-list" id="experiences_dsp"></div>
                    </div>

                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>projects</h3>
                        </div>
                        <div class="projects-items preview-blk-list" id="projects_dsp"></div>
                    </div>
                    <div class="preview-blk">
                        <div class="preview-blk-title">
                            <h3>Achievements</h3>
                        </div>
                        <div class="achievements-items preview-blk-list" id="achievements_dsp"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="print-btn-sc">
        <div class="container">
            <div class="for-the-right">
                <button type="button" class="print-btn btn btn-primary" onclick="printCV()">Print CV</button>
                <p class="notice">*Note: During print as PDF, only print the pages you have filled. Empty pages
                    can also get printed.</p>
            </div>
        </div>
    </section>

    <?php

        }
    ?>

    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!-- jquery repeater cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
        integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js -->
    <script src="../../../javaScripts/resume/app.js"></script>
    <!-- app js -->
    <script src="../../../javaScripts/resume/script.js"></script>
    <!-- skills js -->
    <script src="../../../javaScripts/resume/skills.js"></script>
</body>

</html>