<?php
	$login = $_POST['auth_login'];
	$password = $_POST['auth_password'];

	if (empty($login) || empty($password)) {
		echo "Empty fields<br><a href=\"http://localhost/Bootstrap-Project/project-reimagining/index.php\">Back to sign in form</a>";
	} else {
		$mysql = new mysqli('localhost', 'root', '', 'users-db');
		$queryResult = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
		
		if ($queryResult->num_rows > 0) {
			$userNameQuery = $mysql->query("SELECT `user_name` FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
			$userNameQueryResult = $userNameQuery->fetch_assoc();

			$isAdminQuery = $mysql->query("SELECT `is_admin` FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
			$isAdminQueryResult = $isAdminQuery->fetch_assoc();

			if ((int)$isAdminQueryResult['is_admin'] === 0) {
				$mysql->close();
				header('Location: ../pages/user-page.php');
			} else {
				$mysql->close();
				header('Location: /pages/admin-page.php');
			}		
		} else {
			$mysql->close();
			echo "Wrong login or password<br><a href=\"http://localhost/Bootstrap-Project/project-reimagining/index.php\">Back to sign in form</a>";
		}
	}
?>