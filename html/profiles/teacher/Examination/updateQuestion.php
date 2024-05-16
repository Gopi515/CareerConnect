<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../../LoginandRegister/teacherLogin.php");
}

require '../../../../dbconnect.php'; // Adjust path if necessary

// Check if 'id' is set in the URL
if(isset($_GET['id'])) {
    $question_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
} else {
    echo "<script>alert('Question ID not found in the URL.')</script>";
    exit(); // Stop execution if ID is not found
}

    $sql = "SELECT * FROM `question_bank` WHERE `QID`= '$question_id' AND `email` = '{$_SESSION['mail']}'";
    $question = $conn->query($sql);

if (isset($_POST["UpdateQuestion"])) {
    $questionName = mysqli_real_escape_string($conn, $_POST["question"]);
    $option1 = mysqli_real_escape_string($conn, $_POST["option1"]);
    $option2 = mysqli_real_escape_string($conn, $_POST["option2"]);
    $option3 = mysqli_real_escape_string($conn, $_POST["option3"]);
    $option4 = mysqli_real_escape_string($conn, $_POST["option4"]);
    $correctOption = mysqli_real_escape_string($conn, $_POST["answer"]);

    $query = "UPDATE `question_bank` SET `Questions`='$questionName',`OptionA`='$option1',`OptionB`='$option2',`OptionC`='$option3',
            `OptionD`='$option4',`right_option`='$correctOption' WHERE `QID`= '$question_id' AND `email` = '{$_SESSION['mail']}'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo"
            <script>
                alert('Questions update successfully.');
                document.location.href = 'viewQuestions.php';
            </script>
            ";
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
    <h1 class="interQuestionhead">Update Questions</h1>
    <a href="../../../landingPage/landingTeacher.php" class="backinggo goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: -2.5%;"></i></a>
    <!-- <div style="width: 100%; margin: 10px"><div class="openCSV" style="cursor: pointer; background-color: #0083fa; border-radius: 25px; padding:10px; color: white; position: absolute; font-size: 20px; margin-top: -2.5%; float: right;">Import Question from CSV file</div></div> -->

    <?php
        while($row = mysqli_fetch_assoc($question)){
    ?>

    <!-- form -->
    <form action="" method="post" id="questionForm">
        <div class="interQuestion">

            <!-- question -->
            <div class="interQuestion">
                <label for="question">Question</label>
                <input type="text" id="question" name="question" value="<?php echo $row["Questions"];?>" placeholder="Type the question here..." required />
            </div>

            <!-- options -->
            <div class="interQuestion">
                <label for="option1">Option 1</label>
                <input type="text" id="option" name="option1" value="<?php echo $row["OptionA"];?>" placeholder="Type first option here..." required />
            </div>
            <div class="interQuestion">
                <label for="option2">Option 2</label>
                <input type="text" id="option" name="option2" value="<?php echo $row["OptionB"];?>" placeholder="Type second option here..." required />
            </div>
            <div class="interQuestion">
                <label for="option3">Option 3</label>
                <input type="text" id="option" name="option3" value="<?php echo $row["OptionC"];?>" placeholder="Type third option here..." required />
            </div>
            <div class="interQuestion">
                <label for="option4">Option 4</label>
                <input type="text" id="option" name="option4" value="<?php echo $row["OptionD"];?>" placeholder="Type fourth option here..." required />
            </div>

            <!-- right answer -->
            <div class="interQuestion">
                <label for="answer">Right answer</label>
                <input type="text" id="option" name="answer" value="<?php echo $row["right_option"];?>" placeholder="Type right answer here..." required />
            </div>


            <!-- submit button -->
            <div class="letsgoright">
                <div class="internQuestionthings">
                    <button type="submit" value="submit" name="UpdateQuestion">Update</button>
                </div>
            </div>
        </div>
    </form>
    <?php
        }
    ?>
</body>

<!-- script -->
<script src="../../../../javaScripts/internshipQuestion.js"></script>

</html>