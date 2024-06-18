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
    <h4>Welcome, <?=$_SESSION['userName']?>!</h4>
    <input type="text" placeholder="Type smth here" id="textInput"></input>
    <form action="../php/log_out.php" method="post">
      <button type="submit" class="btn btn-danger">Log out</button>			
    </form>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/user_page_input_tracker.js"></script>
  </body>
</html>