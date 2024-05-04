<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../../LoginandRegister/adminLogin.php");
    exit();
}

require '../../../../dbconnect.php';
$email = $_SESSION['mail']; // Retrieving email from session

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>
    <link rel="stylesheet" href="help.css">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <a href="../admin.php">
            <div class="regallclosebtn"><i class="fa-solid fa-caret-left"></i></div>
        </a>
        <h1>Email Form</h1>

        <form action="send.php" method="post">
            <label for="email">Your Email:</label><br>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>" readonly><br><br>
            <label for="subject">Email Subject:</label><br>
            <input type="text" id="subject" name="subject" placeholder="Subject of the mail" required><br><br>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" placeholder="Enter the problem you are facing" required></textarea><br><br>
            <button type="submit" name="send">Send</button>
        </form>
    </div>

</body>

</html>
