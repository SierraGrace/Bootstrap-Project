<!DOCTYPE html>
<?php
  $mysql = new mysqli('localhost', 'root', '', 'bootstrap-project-db');
  $dataQueryResult = $mysql->query("SELECT * FROM `users`");
  $mysql->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-message">
                    <h2>Welcome, Administrator!</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered data-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>User Name</th>
                                <th>Login</th>
                                <th>Password</th>
                                <th>Is Admin</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            while ($dataQueryResultProcessed = $dataQueryResult->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?=$dataQueryResultProcessed['id']?></td>
                                    <td><?=$dataQueryResultProcessed['user_name']?></td>
                                    <td><?=$dataQueryResultProcessed['login']?></td>
                                    <td><?=$dataQueryResultProcessed['password']?></td>
                                    <td><?=$dataQueryResultProcessed['is_admin'] == 1 ? 'true' : 'false'?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4 class="form-container">Unregistered Users</h4>
                <div class="user-block">
                    <div class="mini-form">
                        <div class="form-group">
                            <label>User Name:</label>
                            <input type="text" class="form-control-plaintext" readonly>
                        </div>
                        <div class="form-group">
                            <label>Login:</label>
                            <input type="text" class="form-control-plaintext" readonly>
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="text" class="form-control-plaintext" readonly>
                        </div>
                         <div class="form-group">
                            <label>Admin:</label>
                            <label class="form-check-label" for="adminCheck">false</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="form-container">Registered Users</h4>
                <div class="registered-user-block">
                    <div class="mini-form">
                        <div class="form-group">
                            <label>Text:</label>
                            <input type="text" class="form-control-plaintext" readonly>
                        </div>
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"></script>
</body>
</html>