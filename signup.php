<?php 
    include('dbcon.php'); 
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="d-flex align-items-center justify-content-center p-5">
    <div class="border border-dark p-5">
        <div>
            <h2 class="p-3 mb-5">Create User</h2>
        </div>
        <div>
        <form action="signup.php" method="POST">
            <div class="mb-3">
                <label class="form-label">UserName</label>
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

            <div class="d-flex justify-content-center mt-5">
                <button type="submit" name="createUserBtn">Create User</button>
            </div>
        </form>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["createUserBtn"])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, email, role_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $role_id = 2;
            $stmt->bind_param("sssi", $username, $hashed_password, $email, $role_id);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                echo "User creation unsuccessful: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}
?>

