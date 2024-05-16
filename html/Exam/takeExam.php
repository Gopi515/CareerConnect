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
    // ...

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
    <a href="../Internship/applyInternship.php" class="goBack"><i class="fa-regular fa-circle-left" style="color: #0083fa; position: absolute; font-size: 50px; margin-top: 55px; margin-left: 40px;"></i></a>

    <!-- headings and instructions -->
    <h1 class="takeExamheading">Take exam</h1>
    <p class="examInstructions">
      [Instructions: Answer all the questions below. You can only submit the exam once.
      Refreshing the page or going back will result in loss of all saved data.
      You have 15 minutes to complete the exam. If you refresh the page the timer will not reset but, the exam will be submitted automatically when the time is up]
    </p>
     


    <!-- question section -->
    <form action="result.php" method="post" class="takeExamform" id="examForm">
      <input type="hidden" name="autoSubmit" id="autoSubmit" value="0">

     <!-- timer -->
    <div class="timer" >
    <h3>Remaining Time:</h3>
    <div id="timer" style="color: black;">15:00</div>
    </div>

      <label for="question1" class="questionName">1. Question 1</label>
       <br/>
      <div class="examOptions">
        <div>
          <input type="radio" name="question1option" id="option1"  />
          <label for="option1">Option 1</label>
        </div>
        <div>
          <input type="radio" name="question1option" id="option2" />
          <label for="option2">Option 2</label>
        </div>
        <div>
          <input type="radio" name="question1option" id="option3"  />
          <label for="option3">Option 3</label>
        </div>
        <div>
          <input type="radio" name="question1option" id="option4"  />
          <label for="option4">Option 4</label>
        </div>
      </div>

      <br />
      <br />

      <label for="question2" class="questionName">2. Question 2</label>
       <br/>
      <div class="examOptions">
        <div>
          <input type="radio" name="question2option" id="option1"  />
          <label for="option1">Option 1</label>
        </div>
        <div>
          <input type="radio" name="question2option" id="option2" />
          <label for="option2">Option 2</label>
        </div>
        <div>
          <input type="radio" name="question2option" id="option3"  />
          <label for="option3">Option 3</label>
        </div>
        <div>
          <input type="radio" name="question2option" id="option4"  />
          <label for="option4">Option 4</label>
        </div>
      </div>

      <br />
      <br />

      <label for="question3" class="questionName">3. Question 3</label>
       <br/>
      <div class="examOptions">
        <div>
          <input type="radio" name="question3option" id="option1"  />
          <label for="option1">Option 1</label>
        </div>
        <div>
          <input type="radio" name="question3option" id="option2" />
          <label for="option2">Option 2</label>
        </div>
        <div>
          <input type="radio" name="question3option" id="option3"  />
          <label for="option3">Option 3</label>
        </div>
        <div>
          <input type="radio" name="question3option" id="option4"  />
          <label for="option4">Option 4</label>
        </div>
      </div>

      <br />
      <br />

      <label for="question4" class="questionName">4. Question 4</label>
       <br/>
      <div class="examOptions">
        <div>
          <input type="radio" name="question4option" id="option1"  />
          <label for="option1">Option 1</label>
        </div>
        <div>
          <input type="radio" name="question4option" id="option2" />
          <label for="option2">Option 2</label>
        </div>
        <div>
          <input type="radio" name="question4option" id="option3"  />
          <label for="option3">Option 3</label>
        </div>
        <div>
          <input type="radio" name="question4option" id="option4"  />
          <label for="option4">Option 4</label>
        </div>
      </div>

      <br />
      <br />

      <label for="question5" class="questionName">5. Question 5</label>
       <br/>
      <div class="examOptions">
        <div>
          <input type="radio" name="question5option" id="option1"  />
          <label for="option1">Option 1</label>
        </div>
        <div>
          <input type="radio" name="question5option" id="option2" />
          <label for="option2">Option 2</label>
        </div>
        <div>
          <input type="radio" name="question5option" id="option3"  />
          <label for="option3">Option 3</label>
        </div>
        <div>
          <input type="radio" name="question5option" id="option4"  />
          <label for="option4">Option 4</label>
        </div>
      </div>

      <br />
      <br />

      <label for="question1" class="questionName">6. Question 6</label>
       <br/>
      <div class="examOptions">
        <div>
          <input type="radio" name="question6option" id="option1"  />
          <label for="option1">Option 1</label>
        </div>
        <div>
          <input type="radio" name="question6option" id="option2" />
          <label for="option2">Option 2</label>
        </div>
        <div>
          <input type="radio" name="question6option" id="option3"  />
          <label for="option3">Option 3</label>
        </div>
        <div>
          <input type="radio" name="question6option" id="option4"  />
          <label for="option4">Option 4</label>
        </div>
      </div>

      <br />
      <br />

      <label for="question2" class="questionName">7. Question 7</label>
       <br/>
      <div class="examOptions">
        <div>
          <input type="radio" name="question7option" id="option1"  />
          <label for="option1">Option 1</label>
        </div>
        <div>
          <input type="radio" name="question7option" id="option2" />
          <label for="option2">Option 2</label>
        </div>
        <div>
          <input type="radio" name="question7option" id="option3"  />
          <label for="option3">Option 3</label>
        </div>
        <div>
          <input type="radio" name="question7option" id="option4"  />
          <label for="option4">Option 4</label>
        </div>
      </div>

      <br />
      <br />

      <label for="question3" class="questionName">8. Question 8</label>
       <br/>
      <div class="examOptions">
        <div>
          <input type="radio" name="question8option" id="option1"  />
          <label for="option1">Option 1</label>
        </div>
        <div>
          <input type="radio" name="question8option" id="option2" />
          <label for="option2">Option 2</label>
        </div>
        <div>
          <input type="radio" name="question8option" id="option3"  />
          <label for="option3">Option 3</label>
        </div>
        <div>
          <input type="radio" name="question8option" id="option4"  />
          <label for="option4">Option 4</label>
        </div>
      </div>

      <br />
      <br />

      <label for="question4" class="questionName">9. Question 9</label>
       <br/>
      <div class="examOptions">
        <div>
          <input type="radio" name="question9option" id="option1"  />
          <label for="option1">Option 1</label>
        </div>
        <div>
          <input type="radio" name="question9option" id="option2" />
          <label for="option2">Option 2</label>
        </div>
        <div>
          <input type="radio" name="question9option" id="option3"  />
          <label for="option3">Option 3</label>
        </div>
        <div>
          <input type="radio" name="question9option" id="option4"  />
          <label for="option4">Option 4</label>
        </div>
      </div>

      <br />
      <br />

      <label for="question5" class="questionName">10. Question 10</label>
       <br/>
      <div class="examOptions">
        <div>
          <input type="radio" name="question10option" id="option1"  />
          <label for="option1">Option 1</label>
        </div>
        <div>
          <input type="radio" name="question10option" id="option2" />
          <label for="option2">Option 2</label>
        </div>
        <div>
          <input type="radio" name="question10option" id="option3"  />
          <label for="option3">Option 3</label>
        </div>
        <div>
          <input type="radio" name="question10option" id="option4"  />
          <label for="option4">Option 4</label>
        </div>
      </div>

      <br />
      <br />

       <button class="examSubmitbtn" type="submit" name="submit">Submit</button>
    </form>


    <!-- script -->
    <script src="../../javaScripts/timer.js"></script>
  </body>
</html>
