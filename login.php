<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="d-flex align-items-center justify-content-center p-5 vh-100">
        <div class="border border-dark p-5">
            <a href="signup.php">SignUp</a>
            <div>
                <h2 class="p-3 mb-5">Login Form</h2>
            </div>
            <div>
                <form action="Authentication/authenticate.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">UserName <i class="fas fa-user"></i></label>
                        <input type="text" class="form-control border border-dark" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password <i class="fas fa-lock"></i></label>
                        <input type="password" class="form-control border border-dark" name="password" required>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <button type="submit" class="btn border border-dark" name="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
