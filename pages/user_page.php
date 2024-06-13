<!DOCTYPE html>
<?php
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<title></title>
	</head>
	<body>
		<h4>Welcome, <?=$_SESSION['userName']?>!</h4>
		<button type="button" class="btn btn-danger">Log out</button>
		<script src="../js/bootstrap.bundle.min.js"></script>
	</body>
</html>