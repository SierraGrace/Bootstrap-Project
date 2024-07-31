<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
     
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-message">
                    <h2>Welcome, User!</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-container">
                    <h3>Text input</h3>
                    <form>
                        <div class="form-group">
                            <label for="text-input">Input your text</label>
                            <input type="text" class="form-control" name="usertext" id="usertext" placeholder="Enter text">
                        </div>
                        <button type="submit" class="btn btn-block mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="logout-block">
                    <form action="../php/sign_out.php" method="post">
                        <button type="submit" class="btn-danger btn-block">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        const ws = new WebSocket('ws://localhost:8001');
        console.log('WebSocket connection opened');
    </script>
    <script src="../js/user_input_tracker.js"></script>
</body>
</html>