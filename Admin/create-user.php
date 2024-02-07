<?php 
    session_start(); 
    include("../dbcon.php");
    
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role_id'] !== 1) {
        header("Location: ../login.php"); 
        exit(); 
    }
    
    echo "Hello admin<br><br>";
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<a href="home.php">Home</a>
<a href="../logout.php">Logout</a>
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="border border-dark p-5">
        <div>
        </div>
        <div>
            <form action="create-user.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control border border-dark" name="username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control border border-dark" name="email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control border border-dark" name="password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role">
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                        <option value="3">Editor</option>
                        <option value="4">Customer</option>     
                        <option value="5">Designer</option>
                    </select>
                </div>

                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" name="createUserBtn">Create User</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["createUserBtn"])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role_id = $_POST['role'];

        $sql = "INSERT INTO users (username, password, email, role_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssi", $username, $hashed_password, $email, $role_id);

            if ($stmt->execute()) {
                header("Location: home.php");
                exit();
            } else {
                echo "User creation unsuccessful: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
?>
