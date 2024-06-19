<?php
	use Workerman\Worker;
	require_once __DIR__ . '/../vendor/autoload.php';

	$worker = new Worker('websocket://localhost:8001');

	$connections = [];

	$worker->onConnect = function ($connection) {
		$connections[$connection->id] = $connection;

		echo "New connection\n";
		echo "ID: " . $connection->id . "\n";
		echo "IP: " . $connection->getRemoteIp() . "\n";
   		echo "Remote port: " . $connection->getRemotePort() . "\n";
   		echo "Used prototocol: " . $connection->protocol . "\n";
   		//print_r($connection);
	};

	$worker->onMessage = function ($connection, $data) use ($worker) {
		// post form login is-admin >>>  add conn id to array
		// 
		foreach($worker->connections as $clientConnection) {
			// if cliconn->id == admin conn id >>> send mess
			$clientConnection->send($data);
			echo $data;
		}
	};

	$worker->onClose = function ($connection) use (&$connections) {
		unset($connections[$connection->id]);
		echo "Connection closed\n";
	};

	Worker::runAll();
?>