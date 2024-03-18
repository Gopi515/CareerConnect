<?php 
    session_start();
    if(!isset($_SESSION['mail'])){
        header("Location: ../../../LoginandRegister/adminLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - General Settings</title>
</head>

<?php
    require '../../../../dbconnect.php';
?>

<body>
    
</body>
</html>