<!DOCTYPE html>
<?php
  session_start();
?>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>User page</title>
  </head>
  <body>
    <form id="logoutForm" action="../php/logout.php" method="post">
      <h4>Welcome, <?=$_SESSION['userName']?>!</h4>
      <button type="submit" class="btn btn-danger">Log out</button>			
    </form>
    <script src="../js/bootstrap.bundle.min.js"></script>
  </body>
</html>