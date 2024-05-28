<?php
session_start();
if (!isset($_SESSION['mail'])) {
  header("Location: ../LoginandRegister/studentLogin.php");
}
require '../../dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch submitted answers
    $submitted_answers = $_POST['answers'];
    $question_ids = $_POST['question_ids'];

    // Initialize score calculation variables
    $total_questions = count($question_ids);
    $correct_answers_count = 0;
    $wrong_answers_count = 0;

    // Retrieve the correct answers from the database
    $placeholders = implode(',', array_fill(0, count($question_ids), '?'));
    $stmt = $conn->prepare("SELECT QID, right_option FROM skill_questions WHERE QID IN ($placeholders)");
    $stmt->bind_param(str_repeat('i', count($question_ids)), ...$question_ids);
    $stmt->execute();
    $result = $stmt->get_result();

    // Store correct answers in an associative array
    $correct_answers = [];
    while ($row = $result->fetch_assoc()) {
        $correct_answers[$row['QID']] = $row['right_option'];
    }

    // Compare submitted answers with correct answers
    foreach ($submitted_answers as $question_id => $submitted_answer) {
        if (isset($correct_answers[$question_id]) && $submitted_answer === $correct_answers[$question_id]) {
            $correct_answers_count++;
        } else {
            $wrong_answers_count++;
        }
    }

    // Calculate the score
    $score = round(($correct_answers_count / $total_questions) * 100, 2);

    // Store the result in the session or database
    $_SESSION['score'] = $score;
    $_SESSION['correct_answers_count'] = $correct_answers_count;
    $_SESSION['wrong_answers_count'] = $wrong_answers_count;
    $_SESSION['total_questions'] = $total_questions;

    // Redirect to result.php
    header("Location: resultSkill.php");
    exit();
}
?>
