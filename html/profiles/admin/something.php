<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../../LoginandRegister/adminLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
    header("Content-Type: text/html");
?>

<body>
    <h1>Welcome to CareerConnect test panel</h1>
    <p>This is the test panel to check on some hyperlinks.</p>
</body>

</html>