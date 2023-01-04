<?php 
    include "connect.php";
  
    session_start();

    if(isset($_SESSION["username"]) and isset($_SESSION["cart"]) || isset($_SESSION["username"])) {
        header("location: home.php");
        session_destroy();
    }
    header("location: home.php");
?>