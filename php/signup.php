<?php
	$uname = $_POST['unameInput'];
	$login = $_POST['loginInput'];
	$password = $_POST['passwordInput'];

	if(isset($_POST['isAdmin'])) {
		$isAdmin = 1;
	} else {
		$isAdmin = 0;
	}

	if(empty($uname) || mb_strlen($uname) > 50) {
		echo "User name error";
	} else if(empty($login) || mb_strlen($login) > 50) {
		echo "Login error";
	} else if(empty($password) || mb_strlen($password) > 32) {
		echo "Password error";
	} else {
		$mysql = new mysqli('localhost', 'root', '', 'users-db');
		$mysql->query("INSERT INTO `users` (`user_name`, `login`, `password`, `is_admin`) VALUES ('$uname', '$login', '$password', '$isAdmin')");
		$mysql->close();

		header('Location: http://localhost/Bootstrap-Project');
	}
?>