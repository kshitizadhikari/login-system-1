<?php include("user-session.php") ?>

<?php 

    $sql = "SELECT users.username, users.email, roles.name as role 
            FROM users 
            INNER JOIN roles ON users.role_id = roles.id 
            WHERE users.id = $user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found";
    }
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="d-flex align-items-center justify-content-center p-5">
    <div class="border border-dark p-5">
        <div>
        <a href="home.php">Home</a>
        <a href="edit-details.php">Edit Details</a>
            <h2 class="p-3 mb-1">My Details</h2>
        </div>
        <div>
            <div class="mb-3">
                <label class="form-label">Username: <?php echo $row['username']?></label>
                </div>

            <div class="mb-3">
                <label class="form-label">Email: <?php echo $row['email']?></label>
            </div>

            <div class="mb-3">
                <label class="form-label">Role: <?php echo $row['role']?></label>
            </div>
        </div>
    </div>
</div>
