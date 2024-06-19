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
      <h4>Welcome, <?=$_SESSION['session_id']?>!</h4>
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
      <hr></hr>
      <div id="unregisteredUsers">
        <!-- <div>
          <h5>Unregistered user</h5>
          <h6>Sign up form</h6>
          <div class="row">
            <label class="col">User name: <label id="userNameInput">Default name</label></label>
            <label class="col">Login: <label id="loginInput">Default login</label></label>
            <label class="col">Password: <label id="passwordInput">Default password</label></label>
            <label class="col">Is Admin: <label id="isAdminCheck">False</label></label>
          </div>
          <h6>Sign in form</h6>
           <div class="row">
            <label class="col">Login: <label id="loginSignIn">Default login</label></label>
            <label class="col">Password: <label id="passwordSignIn">Default password</label></label>
          </div>
          <hr></hr>
        </div>
        <h5>Unregistered user</h5>
        <h6>Sign up form</h6>
        <div class="row">
          <label class="col">User name: <label id="userNameInput">Default name</label></label>
          <label class="col">Login: <label id="loginInput">Default login</label></label>
          <label class="col">Password: <label id="passwordInput">Default password</label></label>
          <label class="col">Is Admin: <label id="isAdminCheck">False</label></label>
        </div>
        <h6>Sign in form</h6>
         <div class="row">
          <label class="col">Login: <label id="loginSignIn">Default login</label></label>
          <label class="col">Password: <label id="passwordSignIn">Default password</label></label>
        </div>
        <hr></hr>
        <h5>Unregistered user</h5>
        <h6>Sign up form</h6>
        <div class="row">
          <label class="col">User name: <label id="userNameInput">Default name</label></label>
          <label class="col">Login: <label id="loginInput">Default login</label></label>
          <label class="col">Password: <label id="passwordInput">Default password</label></label>
          <label class="col">Is Admin: <label id="isAdminCheck">False</label></label>
        </div>
        <h6>Sign in form</h6>
         <div class="row">
          <label class="col">Login: <label id="loginSignIn">Default login</label></label>
          <label class="col">Password: <label id="passwordSignIn">Default password</label></label>
        </div>
        <hr></hr> -->
      </div>
      <div id="registeredUsers">
        <!-- <h5>Registered user</h5>
        <h6>Input field</h6>
         <div class="row">
          <label class="col">Text: <label id="textInput">Default text</label></label>
        </div>
        <hr></hr>
        <h5>Registered user</h5>
        <h6>Input field</h6>
         <div class="row">
          <label class="col">Text: <label id="textInput">Default text</label></label>
        </div>
        <hr></hr>
        <h5>Registered user</h5>
        <h6>Input field</h6>
         <div class="row">
          <label class="col">Text: <label id="textInput">Default text</label></label>
        </div>
        <hr></hr>   -->
      </div>
      <button type="submit" class="btn btn-danger">Log out</button>			
    </form>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/input_handler.js"></script>
  </body>
</html>