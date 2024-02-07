<?php include("session-manage.php")?>

<?php 

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