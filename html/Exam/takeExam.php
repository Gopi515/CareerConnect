<?php
// submitExam.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the submitted answers
    // For example, save the answers to the database

    // Check if the submission was auto-submitted
    if (isset($_POST['autoSubmit']) && $_POST['autoSubmit'] == '1') {
        // Redirect to result.php
        header("Location: result.php");
        exit();
    }

    // Regular form submission logic

    // Redirect to result.php after processing the exam
    header("Location: result.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/0d6185a30c.js" crossorigin="anonymous"></script>
    <title>Take exam</title>
  </head>
  <body>
    <a href="../Internship/internship.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 55px; margin-left: 40px;"></i></a>

    <!-- headings and instructions -->
    <h1 class="takeExamheading">Take exam</h1>
     


    <!-- question section -->
    <form action="submitExam.php" method="post" class="takeExamform" id="examForm">
      <input type="hidden" name="autoSubmit" id="autoSubmit" value="0">

      <!-- timer -->
      <div class="timer">
          <h3>Remaining Time:</h3>
          <div id="timer" style="color: black;">15:00</div>
      </div>

      <?php
      require '../../dbconnect.php';

      // Get the internship ID from the URL parameter (you need to sanitize this input)
      $internship_id = $_SESSION['int_id'];

      // Fetch internship details including skills from the database
      $sql = "SELECT required_skills FROM internships WHERE id = $internship_id";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $skills = explode(", ", $row['required_skills']);
          $num_skills = count($skills);

          // Calculate the number of questions to select from each skill based on the specified criteria
          $num_questions_per_skill = array();
          if ($num_skills == 1) {
              $num_questions_per_skill[$skills[0]] = 10;
          } elseif ($num_skills == 2) {
              $num_questions_per_skill[$skills[0]] = 5;
              $num_questions_per_skill[$skills[1]] = 5;
          } elseif ($num_skills == 3) {
              $num_questions_per_skill[$skills[0]] = 4;
              $num_questions_per_skill[$skills[1]] = 3;
              $num_questions_per_skill[$skills[2]] = 3;
          } elseif ($num_skills == 4) {
              $num_questions_per_skill[$skills[0]] = 3;
              $num_questions_per_skill[$skills[1]] = 2;
              $num_questions_per_skill[$skills[2]] = 3;
              $num_questions_per_skill[$skills[3]] = 2;
          } elseif ($num_skills == 5) {
              $num_questions_per_skill[$skills[0]] = 2;
              $num_questions_per_skill[$skills[1]] = 2;
              $num_questions_per_skill[$skills[2]] = 2;
              $num_questions_per_skill[$skills[3]] = 2;
              $num_questions_per_skill[$skills[4]] = 2;
          } elseif ($num_skills == 6) {
              $num_questions_per_skill[$skills[0]] = 2;
              $num_questions_per_skill[$skills[1]] = 1;
              $num_questions_per_skill[$skills[2]] = 2;
              $num_questions_per_skill[$skills[3]] = 2;
              $num_questions_per_skill[$skills[4]] = 1;
              $num_questions_per_skill[$skills[5]] = 2;
          } elseif ($num_skills == 7) {
              $num_questions_per_skill[$skills[0]] = 1;
              $num_questions_per_skill[$skills[1]] = 2;
              $num_questions_per_skill[$skills[2]] = 1;
              $num_questions_per_skill[$skills[3]] = 2;
              $num_questions_per_skill[$skills[4]] = 1;
              $num_questions_per_skill[$skills[5]] = 1;
              $num_questions_per_skill[$skills[6]] = 2;
          } elseif ($num_skills == 8) {
              $num_questions_per_skill[$skills[0]] = 2;
              $num_questions_per_skill[$skills[1]] = 1;
              $num_questions_per_skill[$skills[2]] = 1;
              $num_questions_per_skill[$skills[3]] = 1;
              $num_questions_per_skill[$skills[4]] = 2;
              $num_questions_per_skill[$skills[5]] = 1;
              $num_questions_per_skill[$skills[6]] = 1;
              $num_questions_per_skill[$skills[7]] = 1;
          } elseif ($num_skills == 9) {
              $num_questions_per_skill[$skills[0]] = 1;
              $num_questions_per_skill[$skills[1]] = 1;
              $num_questions_per_skill[$skills[2]] = 1;
              $num_questions_per_skill[$skills[3]] = 1;
              $num_questions_per_skill[$skills[4]] = 1;
              $num_questions_per_skill[$skills[5]] = 1;
              $num_questions_per_skill[$skills[6]] = 2;
              $num_questions_per_skill[$skills[7]] = 1;
              $num_questions_per_skill[$skills[8]] = 1;
          } elseif ($num_skills == 10) {
              $num_questions_per_skill[$skills[0]] = 1;
              $num_questions_per_skill[$skills[1]] = 1;
              $num_questions_per_skill[$skills[2]] = 1;
              $num_questions_per_skill[$skills[3]] = 1;
              $num_questions_per_skill[$skills[4]] = 1;
              $num_questions_per_skill[$skills[5]] = 1;
              $num_questions_per_skill[$skills[6]] = 1;
              $num_questions_per_skill[$skills[7]] = 1;
              $num_questions_per_skill[$skills[8]] = 1;
              $num_questions_per_skill[$skills[9]] = 1;
          }

          // Retrieve and display random questions from each skill
          $question_number = 1;
          foreach ($num_questions_per_skill as $skill => $num_questions) {
              $sql = "SELECT * FROM question_bank WHERE skills = '$skill' ORDER BY RAND() LIMIT $num_questions";
              $result = $conn->query($sql);
              
              if ($result->num_rows > 0) {
                  echo "<h3>$skill</h3>";
                  while ($row = $result->fetch_assoc()) {
                      echo "<input type='hidden' name='question_ids[]' value='{$row['QID']}' />";
                      echo "<label for='question$question_number' class='questionName'>$question_number. {$row['Questions']}</label><br/>";
                      echo "<div class='examOptions'>";
                      for ($i = 1; $i <= 4; $i++) {
                          $option = "Option$i";
                          echo "<div>
                                  <input type='radio' name='answers[{$row['QID']}]' id='question{$question_number}option$i' value='{$row[$option]}' />
                                  <label for='question{$question_number}option$i'>{$row[$option]}</label>
                                </div>";
                      }
                      echo "</div>";
                      echo "<br />";
                      echo "<br />";
                      $question_number++;
                  }
              }
          }
      } else {
          echo "Internship not found.";
      }

      $conn->close();
      ?>

      <button class="examSubmitbtn" type="submit" name="submit">Submit</button>
  </form>

  <!-- Popup container for exam instructions -->
    <div id="examInstructionsPopup" class="popup-container">
    <div class="popup-content">
        <h2>Exam Instructions</h2>
        <p style="color: var(--fourth-col); font-weight: bold;">Read the instructions carefully before taking the test:</p>
        <ul style="margin-top: 20px; text-align: left;">
            <li>In this page you will be facing 10 multiple choice questions based on the internship/job you are applying for.
            </li>
            <li>
                You will get 15 minutes to complete the exam. If you able to score 60% marks (6 correct out of 10 questions), then you will be able to submit the application otherwise you can take the test again.
            </li>
            <li>You can only submit the exam once. Refreshing the page or going back will result in the loss of all saved data.</li>
            <li>Exam will be submitted automatically when the time is up.</li>
        </ul>
        <br>
        <p>Good Luck!</p>
        <button id="startExamBtn">OK</button>
        <button id="cancelExamBtn">Cancel Exam</button>
    </div>
    </div>

    <!-- script -->
    <script src="../../javaScripts/timer.js"></script>
    <script>
        function showExamInstructionsPopup() {
          var popup = document.getElementById("examInstructionsPopup");
          popup.style.display = "flex";
      }

      // Function to start the exam
      function startExam() {
          var popup = document.getElementById("examInstructionsPopup");
          popup.style.display = "none";
          // Set the autoSubmit hidden input value to 0 to indicate manual submission
          document.getElementById("autoSubmit").value = "0";
          // Start the timer
          startTimer();
      }

      // Function to cancel the exam and go back to the internship page
      function cancelExam() {
          localStorage.removeItem("endTime");
          window.location.href = "../Internship/internship.php";
      }

      // Show the exam instructions popup when the page loads
      window.onload = function() {
          showExamInstructionsPopup();
          document.getElementById("startExamBtn").addEventListener("click", startExam);
          document.getElementById("cancelExamBtn").addEventListener("click", cancelExam);
      };

       window.history.forward(); 
        function noBack() { 
            window.history.forward(); 
        } 
</script>
  </body>
</html>
