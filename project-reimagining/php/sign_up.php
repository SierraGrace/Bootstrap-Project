<?php
	$username = $_POST['username'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $admin = isset($_POST['adminCheck']) ? 1 : 0;

    echo "Username: $username<br>";
    echo "Login: $login<br>";
    echo "Password: $password<br>";
    echo "Admin: $admin<br>";
?>