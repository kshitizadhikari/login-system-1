    <?php include("user-session.php") ?>

    <?php 
        $sql_select = "SELECT * FROM users WHERE id = $user_id";
        $result = $conn->query($sql_select);
        if (!$result) {
            echo "Error: " . $conn->error;
            exit();
        }
        $row = $result->fetch_assoc();
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <div class="d-flex align-items-center justify-content-center p-5">
        <div class="border border-dark p-5">
            <div>
            <a href="home.php">Home</a>

                <h2 class="p-3 mb-1">Edit Details</h2>
            </div>
            <div>
                
                <form action="edit-details.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" value="<?php echo $row['username']?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="<?php echo $row['email']?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" required>
                    </div>

                    <div class="d-flex justify-content-center mt-5">
                        <button type="submit" name="updateDetailsBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["updateDetailsBtn"])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql_update = "UPDATE users SET username=?, email=?, password=? WHERE id=?";
            $stmt = $conn->prepare($sql_update);
            if ($stmt) {
                $stmt->bind_param("sssi", $username, $email, $hashed_password, $user_id);

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


