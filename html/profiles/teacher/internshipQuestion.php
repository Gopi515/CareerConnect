<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../../LoginandRegister/teacherLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Internship questions</title>
  <link rel="stylesheet" href="../../../style.css?v=<?php echo time(); ?>"/>
</head>

<?php
  require '../../../dbconnect.php';

  if (isset($_POST["submitQuestion"])) {
    $questionName = $_POST["question"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];
    $option4 = $_POST["option4"];
    $correctOption = $_POST["answer"];

    // Retrieving and decode the added skills array
    $addedSkillsArray = isset($_POST['addedSkills']) ? json_decode($_POST['addedSkills'], true) : [];

    if ($addedSkillsArray === null) {
        echo "Error decoding addedSkills JSON: " . json_last_error_msg();
        exit;
    }

    // Combining skills into a comma-separated string
    $skillsString = implode(', ', $addedSkillsArray);

    // Inserting data into the MySQL table for questions
    $query = "INSERT INTO internship_question (question, option_one, option_two, option_three, option_four, right_option, skills) 
              VALUES ('$questionName', '$option1', '$option2', '$option3', '$option4', '$correctOption', '$skillsString')";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "<script>alert('Question added successfully')</script>";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
?>

<body>

<!-- heading -->
<h1 class="interQuestionhead">Add Questions</h1>

<!-- form -->
<form action="" method="post" id="questionForm">
  <div class="interQuestion">

    <!-- question -->
    <div class="interQuestion">
      <label for="question">Question</label>
      <input type="text" id="question" name="question" placeholder="Type question here..."required/>
    </div>

    <!-- options -->
    <div class="interQuestion">
      <label for="option1">Option 1</label>
      <input type="text" id="option" name="option1" placeholder="Type option 1 here..."required/>
    </div>
    <div class="interQuestion">
      <label for="option2">Option 2</label>
      <input type="text" id="option" name="option2" placeholder="Type option 2 here..."required/>
    </div>
    <div class="interQuestion">
      <label for="option3">Option 3</label>
      <input type="text" id="option" name="option3" placeholder="Type option 3 here..."required/>
    </div>
    <div class="interQuestion">
      <label for="option4">Option 4</label>
      <input type="text" id="option" name="option4" placeholder="Type option 4 here..." required/>
    </div>

    <!-- right answer -->
    <div class="interQuestion">
      <label for="answer">Right answer</label>
      <input type="text" id="answer" name="answer" placeholder="Type the right option here..."required/>
    </div>

    <!-- skills -->
    <div class="addDomainelement">
      <p>Add Skills*</p>
      <div id="addskillButton" onclick="openskillPopup()" class="addquestionSkillbutton">Add</div>

      <!-- popup container -->
      <div id="popupskillContainer" class="hidePopup">
        <input type="text" id="searchBar" placeholder="Search..." oninput="filterElements()"/>

        <div class="closeContainerbutton">
        <span id="closeButton" onclick="closePopup()">×</span>
        </div>

        <div class="testCase1"><div id="elementsskillContainer" class="elementsContainer"></div></div>
      </div>

      <div id="addedElements" name="internshipSkills">
      
      <input type="hidden" id="addedSkillsInput" name="addedSkills" required/>
      </div>
      
    </div>

    <div class="interQuestionbutton">
      <button type="submit" value="submit" name="submitQuestion"> submit question</button>
    </div>
  </div>
</form>
</body>

<!-- script -->
<script src="../../../javaScripts/internshipQuestion.js"></script>
</html>
