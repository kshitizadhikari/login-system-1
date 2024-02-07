<?php 
    session_start(); 
    include("../dbcon.php");
    
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role_id'] !== 1) {
        header("Location: ../login.php"); 
        exit(); 
    }
    
    echo "Hello admin";

    $user_id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id=$user_id";
    $result = $conn->query($sql);
    
    if(!$result) {
        echo "Deletion Failed";
        exit();
    } 

    echo "User Deleted Successfully";
    header("Location: home.php");
?>