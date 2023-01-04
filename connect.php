<?php
   
    $pdo = new PDO("mysql:host=localhost;dbname=sneakers;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $servernam = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sneakers";

    $conn = mysqli_connect($servernam, $username, $password, $dbname);
?>
