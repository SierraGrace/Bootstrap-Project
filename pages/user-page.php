<!DOCTYPE html>
<?php
  session_start();

  $sessionData = [
      'logged_in' => 1,
      "session_id" => $_SESSION['session_id'],
      'type' => 'Session id',
      'value' => $_SESSION['session_id']
  ];

  $jsonSessionData = json_encode($sessionData);
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
    <script>
        const ws = new WebSocket('ws://localhost:8001');

        var sessionData = <?php echo $jsonSessionData;?>;
        console.log("Session Data:", sessionData);

        ws.onopen = function() {
            ws.send(JSON.stringify(sessionData));
            console.log('WebSocket connection opened');
        };
    </script>
    <script src="../js/user_page_input_tracker.js"></script>
  </body>
</html>