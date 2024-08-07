<?php
	use Workerman\Worker;

	require_once __DIR__ . '/../vendor/autoload.php';

	$worker = new Worker('websocket://localhost:8001');

	$adminConnections = [];

	echo("Socket server has been started\n");

	$worker->onConnect = function ($connection) {
		echo "New connection\n";
	};

	$worker->onMessage = function ($connection, $data) use ($worker, &$adminConnections) {
		if($data === 'admin') {
			$adminConnections[$connection->id] = $connection;

			echo "Admin connected\n";
		} else {
			echo "Data recieved\n";
		}
	};

	$worker->onClose = function ($connection) {
		echo "Connection closed\n";
	};

	Worker::runAll();
?>