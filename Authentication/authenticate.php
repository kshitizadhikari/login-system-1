<?php
include("../dbcon.php");

session_start();

if (!isset($_POST['username'], $_POST['password'])) {
    echo "Please fill out both username and password fields";
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql_select = "SELECT id, username, password, role_id FROM users WHERE username=?";
$stmt_select = $conn->prepare($sql_select);

if (!$stmt_select) {
    echo "Couldn't prepare statement";
    exit();
}

$stmt_select->bind_param("s", $username);
if (!$stmt_select->execute()) {
    echo "Couldn't execute statement";
    exit();
}

$stmt_select->store_result();

if ($stmt_select->num_rows() > 0) {
    $stmt_select->bind_result($id, $db_username, $db_password, $db_role_id);
    $stmt_select->fetch();
    
    if (password_verify($password, $db_password)) {
        session_regenerate_id();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $id;
        $_SESSION['role_id'] = $db_role_id;

        if($db_role_id == 1)
        {
            header("Location: ../Admin/home.php");
        } else if($db_role_id == 2) {
            header("Location: ../User/home.php");
        }
        exit();
    } else {
        echo "Incorrect username or password";
        header("Location: ../login.php");
    }
} else {
    echo "User not found";
    header("Location: ../login.php");
}

$stmt_select->close();
?>
