<?php
	$userName = $_POST['userNameInput'];
	$login = $_POST['loginInput'];
	$password = $_POST['passwordInput'];

	if (isset($_POST['isAdmin'])) {
		$isAdmin = 1;
	} else {
		$isAdmin = 0;
	}

	if (empty($userName) || mb_strlen($userName) > 50) {
		echo "User name error<br><a href=\"http://localhost/Bootstrap-Project\">Back to sign up form</a>";
	} else if (empty($login) || mb_strlen($login) > 50) {
		echo "Login error<br><a href=\"http://localhost/Bootstrap-Project\">Back to sign up form</a>";
	} else if (empty($password) || mb_strlen($password) > 32) {
		echo "Password error<br><a href=\"http://localhost/Bootstrap-Project\">Back to sign up form</a>";
	} else {
		$mysql = new mysqli('localhost', 'root', '', 'users-db');
		$queryResult = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");

		if ((int)$queryResult->num_rows === 0) {
			$mysql->query("INSERT INTO `users` (`user_name`, `login`, `password`, `is_admin`) VALUES ('$userName', '$login', '$password', '$isAdmin')");
			$mysql->close();

			header('Location: http://localhost/Bootstrap-Project');
		} else {
			echo "Login has already been used by another user<br><a href=\"http://localhost/Bootstrap-Project\">Back to sign up form</a>";
			$mysql->close();
		}
	}
?>