<?php
	$login = $_POST['loginInput'];
	$password = $_POST['passwordInput'];

	if(empty($login) || empty($password)) {
		echo "Empty fields<br><a href=\"http://localhost/Bootstrap-Project\">Back to sign in form</a>";
	} else {
		$mysql = new mysqli('localhost', 'root', '', 'users-db');
		$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
		
		if($result->num_rows > 0) {
			$userName = $mysql->query("SELECT `user_name` FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
			$nameResult = $userName->fetch_assoc();

			session_start();
			$_SESSION['userName'] = $nameResult['user_name'];

			$isAdmin = $mysql->query("SELECT `is_admin` FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
			$isAdminResult = $isAdmin->fetch_assoc();

			if($isAdminResult['is_admin'] == 0) {
				$mysql->close();
				header('Location: ../pages/user_page.php');
			} else {
				$mysql->close();
				header('Location: ../pages/admin_page.php');
			}		
		} else {
			$mysql->close();
			echo "Wrong login or password<br><a href=\"http://localhost/Bootstrap-Project\">Back to sign in form</a>";
		}
	}
?>