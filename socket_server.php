<?php
	use Workerman\Worker;
	require_once __DIR__ . '/vendor/autoload.php';

	$worker = new Worker('websocket://localhost:8001');
	$worker->count = 4;

	$worker->onConnect = function ($connection) {
		echo "New connection\n";
	};

	$worker->onMessage = function ($connection, $data) use ($worker) {
		foreach($worker->connections as $clientConnection) {
			$clientConnection->send($data);
		}
	};

	$worker->onClose = function ($connection) {
		echo "Connection closed\n";
	};

	Worker::runAll();
?>