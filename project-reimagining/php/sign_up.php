<?php
	$username = $_POST['username'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $admin = isset($_POST['adminCheck']) ? 1 : 0;

    if (empty($username) || mb_strlen($username) > 50) {
		echo "User name error<br><a href=\"http://localhost/Bootstrap-Project/project-reimagining\">Back to sign up form</a>";
	} else if (empty($login) || mb_strlen($login) > 50) {
		echo "Login error<br><a href=\"http://localhost/Bootstrap-Project/project-reimagining\">Back to sign up form</a>";
	} else if (empty($password) || mb_strlen($password) > 32) {
		echo "Password error<br><a href=\"http://localhost/Bootstrap-Project/project-reimagining\">Back to sign up form</a>";
	} else {

	    $mysql = new mysqli('localhost', 'root', '', 'users-db');

	    $queryResult = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");

		if ((int)$queryResult->num_rows === 0) {
			$mysql->query("INSERT INTO `users` (`user_name`, `login`, `password`, `is_admin`) VALUES ('$username', '$login', '$password', '$admin')");

			echo "Registration was successful<br><a href=\"http://localhost/Bootstrap-Project/project-reimagining\">Back to sign up form</a>";

			$mysql->close();
		} else {
			echo "Login has already been used by another user<br><a href=\"http://localhost/Bootstrap-Project/project-reimagining\">Back to sign up form</a>";

			$mysql->close();
		}
	}
?>