<?php 
    session_start(); 
    include("../dbcon.php");
    
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role_id'] !== 1) {
        header("Location: ../login.php"); 
        exit(); 
    }
    
    echo "Hello admin";

    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$user_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="d-flex align-items-center justify-content-center p-5">
    <div class="border border-dark p-5">
        <div>
        <a href="home.php">Home</a>

            <h2 class="p-3 mb-1">Edit User Details</h2>
        </div>
        <div>
            
            <form action="edit-user.php?id=<?php echo $row['id']?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']?>" >
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control border border-dark" name="username" value="<?php echo $row['username']?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control border border-dark" name="email" value="<?php echo $row['email']?>" required>
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
                    <button type="submit" name="updateUserBtn">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["updateUserBtn"])) {
        $id = $_POST['id'];
        $role_id = $_POST['role'];
        $sql_update = "UPDATE users SET role_id=? WHERE id=?";
        $stmt = $conn->prepare($sql_update);
        if ($stmt) {
            $stmt->bind_param("is", $role_id, $id);

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


