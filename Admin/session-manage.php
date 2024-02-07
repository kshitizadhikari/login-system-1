<?php 
    session_start(); 
    include("../dbcon.php");
    
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role_id'] !== 1) {
        header("Location: ../login.php"); 
        exit(); 
    }
    
    echo "Hello admin<br><br>";
?>