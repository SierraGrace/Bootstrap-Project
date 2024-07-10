<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Sign Up Forms</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-message">
                    <h2>Welcome, Guest!</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-container">
                    <h2>Sign Up</h2>
                    <form action="php/sign_up.php" method="post">
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter your username">
                        </div>
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" class="form-control" name="login" placeholder="Enter your login">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter your password">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="adminCheck">
                            <label class="form-check-label" for="adminCheck">Admin</label>
                        </div>
                        <button type="submit" class="btn btn-block">Sign Up</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-container">
                    <h2>Sign In</h2>
                    <form action="php/sign_in.php" method="post">
                        <div class="form-group">
                            <label for="auth_login">Login</label>
                            <input type="text" class="form-control" name="auth_login" placeholder="Enter your login">
                        </div>
                        <div class="form-group">
                            <label for="auth_password">Password</label>
                            <input type="password" class="form-control" name="auth_password" placeholder="Enter your password">
                        </div>
                        <button type="submit" class="btn btn-block">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>