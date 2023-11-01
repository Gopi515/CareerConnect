<!-- To connect the database with the frontend -->
<?php
    $sname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'careerconnect';

    $conn = mysqli_connect($sname, $username, $password, $database);
?>