<!DOCTYPE html>
<?php
  session_start();

  $mysql = new mysqli('localhost', 'root', '', 'users-db');
  $dataQueryResult = $mysql->query("SELECT * FROM `users`");
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
    <form action="../php/log_out.php" method="post">
      <h4>Welcome, Administrator <?=$_SESSION['userName']?>!</h4>
      <?php
        while ($dataQueryResultProcessed = $dataQueryResult->fetch_assoc()) {
      ?>
          <div class="row">
            <div class="col">Id: <?=$dataQueryResultProcessed['id']?></div>
            <div class="col">User name: <?=$dataQueryResultProcessed['user_name']?></div>
            <div class="col">Login: <?=$dataQueryResultProcessed['login']?></div>
            <div class="col">Password: <?=$dataQueryResultProcessed['password']?></div>
            <div class="col">Is admin: <?=$dataQueryResultProcessed['is_admin']?></div>
          </div>
      <?php
        }
      ?>
      <button type="submit" class="btn btn-danger">Log out</button>			
    </form>
    <script src="../js/bootstrap.bundle.min.js"></script>
  </body>
</html>