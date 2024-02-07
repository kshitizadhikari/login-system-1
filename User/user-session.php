<?php 
    session_start(); 
    include("../dbcon.php");
    
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: ../login.php"); 
        exit(); 
    }
    $user_id = $_SESSION['userid'];

    echo "Hello User<br><br>";
?>