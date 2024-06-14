<!DOCTYPE html>
<?php
  session_start();

  $mysql = new mysqli('localhost', 'root', '', 'users-db');
  $data = $mysql->query("SELECT * FROM `users`");
  $mysql->close();
?>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Admin page</title>
  </head>
  <body>
    <form id="logoutForm" action="../php/logout.php" method="post">
      <h4>Welcome, Administrator <?=$_SESSION['userName']?>!</h4>
      <?php
        while ($dataResult = $data->fetch_assoc()) {
      ?>
          <div class="row">
            <div class="col">Id: <?=$dataResult['id']?></div>
            <div class="col">User name: <?=$dataResult['user_name']?></div>
            <div class="col">Login: <?=$dataResult['login']?></div>
            <div class="col">Password: <?=$dataResult['password']?></div>
            <div class="col">Is admin: <?=$dataResult['is_admin']?></div>
          </div>
      <?php
        }
      ?>
      <button type="submit" class="btn btn-danger">Log out</button>			
    </form>
    <script src="../js/bootstrap.bundle.min.js"></script>
  </body>
</html>