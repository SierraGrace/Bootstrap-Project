<?php
	use Workerman\Worker;
	require_once __DIR__ . '/../vendor/autoload.php';

	$worker = new Worker('websocket://localhost:8001');

	$connections = [];

	$worker->onConnect = function ($connection) {
		$connections[$connection->id] = $connection;
		echo "New connection\n";

	$worker->onMessage = function ($connection, $data) use ($worker) {
		foreach($worker->connections as $clientConnection) {
			$clientConnection->send($data);
		}
	};

	$worker->onClose = function ($connection) use (&$connections) {
		unset($connections[$connection->id]);
		echo "Connection closed\n";
	};

	Worker::runAll();
?>