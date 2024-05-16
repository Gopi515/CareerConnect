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
    <h1>Exam Results</h1>
    <p>Your score: <?php echo $score; ?>/100</p>
    <p>Correct answers: <?php echo $correct_answers_count; ?></p>
    <p>Wrong answers: <?php echo $wrong_answers_count; ?></p>
    <p>Total questions: <?php echo $total_questions; ?></p>
    <a href="../Internship/applyInternship.php">Go Back</a>
</body>
</html>