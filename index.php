<?php
    session_start();

    $_SESSION['session_id'] = session_id();
    $sessionData = [
        'logged_in' => 0,
        "session_id" => $_SESSION['session_id'],
        'type' => 'Session id',
        'value' => $_SESSION['session_id']
    ];

    $jsonSessionData = json_encode($sessionData);
?>
<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Bootstrap-Project</title>
  </head>
  <body>
    <!-- <?php echo "<pre>"; var_dump($_SESSION);  echo "</pre>"; ?> -->
    <div class="row">
      <div class="col">
        <form action="php/sign_up.php" method="post">
          <h4>Sign up form</h4>
          <div class="mb-3">
            <label class="form-label">User name</label>
            <input type="text" class="form-control" name="userNameInput" id="userNameInput"></input>
          </div>
          <div class="mb-3">
            <label class="form-label">Login</label>
            <input type="text" class="form-control" name="loginInput" id="loginInput"></input>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="passwordInput" id="passwordInput"></input>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="isAdmin" id="isAdminCheck"></input>
            <label class="form-check-label">Admin</label>
          </div>
          <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
      </div>
      <div class="col">
        <form action="php/sign_in.php" method="post">
          <h4>Sign in form</h4>
          <div class="mb-3">
            <label class="form-label">Login</label>
            <input type="login" class="form-control" name="loginInput" id="loginSignIn"></input>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="passwordInput" id="passwordSignIn"></input>
          </div>
          <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
      </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        const ws = new WebSocket('ws://localhost:8001');

        var sessionData = <?php echo $jsonSessionData;?>;
        console.log("Session Data:", sessionData);

        ws.onopen = function() {
            ws.send(JSON.stringify(sessionData));
            console.log('WebSocket connection opened');
        };
    </script>
    <script src="js/input_tracker.js"></script>
  </body>
</html>