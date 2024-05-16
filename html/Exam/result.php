<?php
session_start();
if (!isset($_SESSION['score'])) {
    header("Location: takeExam.php");
    exit();
}

$score = $_SESSION['score'];
$correct_answers_count = $_SESSION['correct_answers_count'];
$wrong_answers_count = $_SESSION['wrong_answers_count'];
$total_questions = $_SESSION['total_questions'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
    <title>Exam Results</title>
</head>
<body>
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 100px;">
    <h1 style="color: var(--fourth-col);">Exam Results</h1>
    <div style="width: 400px; padding: 20px 30px; border-radius: 10px; background-color: var(--third-col); margin-top: 70px;">
    <p style="font-size: 22px; color: var(--first-col); font-weight: 600;">Your score: <?php echo $score; ?>/100</p>
    <p style="font-size: 22px; color: var(--first-col); font-weight: 600;">Correct answers: <?php echo $correct_answers_count; ?></p>
    <p style="font-size: 22px; color: var(--first-col); font-weight: 600;">Wrong answers: <?php echo $wrong_answers_count; ?></p>
    <p style="font-size: 22px; color: var(--first-col); font-weight: 600;">Total questions: <?php echo $total_questions; ?></p>
    </div>
    <a href="../Internship/applyInternship.php" style="text-decoration: none; padding: 10px 15px; background-color: var(--fourth-col); color: var(--first-col); margin-top: 20px; border-radius: 20px; box-shadow: var(--box-shadow);">Go Back</a>
    </div>

 
</body>
</html>