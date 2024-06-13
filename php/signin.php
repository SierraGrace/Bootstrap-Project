<?php
	$login = $_POST['loginInput'];
	$password = $_POST['passwordInput'];

	if(empty($login) || empty($password)) {
		echo "Empty fields<br><a href=\"http://localhost/Bootstrap-Project\">Back to sign in form</a>";
	} else {
		$mysql = new mysqli('localhost', 'root', '', 'users-db');
		$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
		$mysql->close();

		if($result->num_rows > 0) {
			echo "Welcome";
		} else {
			echo "Wrong login or password<br><a href=\"http://localhost/Bootstrap-Project\">Back to sign in form</a>";
		}
	}
?>