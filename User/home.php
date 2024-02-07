<?php 
    session_start();
    include("../dbcon.php"); 
    
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: ../login.php");
        exit();
    }

?>

<?php
    session_start();
    echo "Hello user";
?>

<a href="../logout.php">Logout</a>
