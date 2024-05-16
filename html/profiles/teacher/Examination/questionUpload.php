<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../../LoginandRegister/teacherLogin.php");
}

require '../../../../dbconnect.php'; // Adjust path if necessary

if (isset($_POST["submitQuestion"])) {
    $questionName = mysqli_real_escape_string($conn, $_POST["question"]);
    $option1 = mysqli_real_escape_string($conn, $_POST["option1"]);
    $option2 = mysqli_real_escape_string($conn, $_POST["option2"]);
    $option3 = mysqli_real_escape_string($conn, $_POST["option3"]);
    $option4 = mysqli_real_escape_string($conn, $_POST["option4"]);
    $correctOption = mysqli_real_escape_string($conn, $_POST["answer"]);

    $addedSkillsArray = isset($_POST['addedSkills']) ? json_decode($_POST['addedSkills'], true) : []; // Decoding the JSON string to an array here
    $skillsString = implode(', ', $addedSkillsArray); // Converting the array into a string by imploding it

    $query = "INSERT INTO `question_bank`(`email`, `Questions`, `Option1`, `Option2`, `Option3`, `Option4`, `right_option`, `skills`) 
        values ('{$_SESSION['mail']}', '$questionName', '$option1', '$option2', '$option3', '$option4', '$correctOption', '$skillsString')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Questions added successfully')</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Internship questions</title>
    <link rel="stylesheet" href="../../../../style.css?v=<?php echo time(); ?>" />
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- heading -->
    <h1 class="interQuestionhead">Add Questions</h1>
    <a href="../../../landingPage/landingTeacher.php" class="backinggo goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: -2.5%;"></i></a>
    <!-- <div style="width: 100%; margin: 10px"><div class="openCSV" style="cursor: pointer; background-color: #0083fa; border-radius: 25px; padding:10px; color: white; position: absolute; font-size: 20px; margin-top: -2.5%; float: right;">Import Question from CSV file</div></div> -->

    <!-- form -->
    <form action="" method="post" id="questionForm">
        <div class="interQuestion">

            <!-- question -->
            <div class="interQuestion">
                <label for="question">Question</label>
                <input type="text" id="question" name="question" placeholder="Type the question here..." required />
            </div>

            <!-- options -->
            <div class="interQuestion">
                <label for="option1">Option 1</label>
                <input type="text" id="option" name="option1" placeholder="Type first option here..." required />
            </div>
            <div class="interQuestion">
                <label for="option2">Option 2</label>
                <input type="text" id="option" name="option2" placeholder="Type second option here..." required />
            </div>
            <div class="interQuestion">
                <label for="option3">Option 3</label>
                <input type="text" id="option" name="option3" placeholder="Type third option here..." required />
            </div>
            <div class="interQuestion">
                <label for="option4">Option 4</label>
                <input type="text" id="option" name="option4" placeholder="Type fourth option here..." required />
            </div>

            <!-- right answer -->
            <div class="interQuestion">
                <label for="answer">Right answer</label>
                <input type="text" id="option" name="answer" placeholder="Type right answer here..." required />
            </div>


            <!-- skills -->
            <div class="addDomainelement">
                <p>Add Skills</p>
                <input type="text" id="option1Input" placeholder="Search skills..." />
                <div id="dropdownFilterprofile" class="dropdown"></div>
                <div id="tag-container" class="tag-container"></div>

                <!-- Hidden input field to store selected skills -->
                <input type="hidden" id="skillsInput" name="addedSkills" required />
            </div>

            <!-- submit button -->
            <div class="letsgoright">
                <div class="internQuestionthing">
                    <button type="submit" value="submit" name="submitQuestion">Submit
                        and Add another</button>
                </div>
            </div>
        </div>
    </form>
</body>

<!-- script -->
<script src="../../../../javaScripts/internshipQuestion.js"></script>

</html>