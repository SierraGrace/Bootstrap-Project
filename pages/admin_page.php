<!DOCTYPE html>
<?php
	session_start();

	$mysql = new mysqli('localhost', 'root', '', 'users-db');
	$data = $mysql->query("SELECT * FROM `users`");
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<title></title>
	</head>
	<body>
		<form id="logoutForm" action="../php/logout.php" method="post">
			<h4>Welcome, Administrator <?=$_SESSION['userName']?>!</h4>
			<?php
				while ($dataResult = $data->fetch_assoc()) {
			        echo "Id: " . $dataResult['id'] . "<br>";
			        echo "User name: " . $dataResult['user_name'] . "<br>";
			        echo "Login: " . $dataResult['login'] . "<br>";
			        echo "Password: " . $dataResult['password'] . "<br>";
			    	echo "Is admin: " . $dataResult['is_admin'] . "<br>";
			        echo "<hr>";
		    	}

		    	$mysql->close();
			?>
			<button type="submit" class="btn btn-danger">Log out</button>			
		</form>
		<script src="../js/bootstrap.bundle.min.js"></script>
	</body>
</html>