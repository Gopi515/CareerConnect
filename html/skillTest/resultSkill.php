<?php
session_start();
if (!isset($_SESSION['mail'])) {
  header("Location: ../LoginandRegister/studentLogin.php");
  exit();
}

if (!isset($_SESSION['score'])) {
    header("Location: takeSkillExam.php");
    exit();
}

$score = $_SESSION['score'];
$correct_answers_count = $_SESSION['correct_answers_count'];
$wrong_answers_count = $_SESSION['wrong_answers_count'];
$total_questions = $_SESSION['total_questions'];

// Check if the form was submitted to unset session variables
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['go_back'])) {
    unset($_SESSION['score']);
    unset($_SESSION['correct_answers_count']);
    unset($_SESSION['wrong_answers_count']);
    unset($_SESSION['total_questions']);
    unset($_SESSION['test_skill']);
    header("Location: ../landingPage/landingStudent.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <title>Results</title>
</head>
<body>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 100px;">
        <h1 style="color: var(--fourth-col);">Results</h1>
        <div style="width: 400px; padding: 20px 30px; border-radius: 10px; background-color: var(--third-col); margin-top: 70px;">
            <p style="font-size: 22px; color: var(--first-col); font-weight: 600;">Your score: <?php echo $score; ?>/100</p>
            <p style="font-size: 22px; color: var(--first-col); font-weight: 600;">Correct answers: <?php echo $correct_answers_count; ?></p>
            <p style="font-size: 22px; color: var(--first-col); font-weight: 600;">Wrong answers: <?php echo $wrong_answers_count; ?></p>
            <p style="font-size: 22px; color: var(--first-col); font-weight: 600;">Total questions: <?php echo $total_questions; ?></p>
        </div>

        <form action="#" method="post" style="margin-top: 20px;">
            <button type="submit" name="go_back" style="text-decoration: none; padding: 10px 15px; background-color: var(--fourth-col); color: var(--first-col); border-radius: 20px; box-shadow: var(--box-shadow); border: none; cursor: pointer;">Go Back</button>
        </form>
    </div>
</body>
</html>
