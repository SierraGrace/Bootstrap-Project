<?php
	use Workerman\Worker;
	require_once __DIR__ . '/../vendor/autoload.php';

	$worker = new Worker('websocket://localhost:8001');

	$adminConnections = [];
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

	$worker->onMessage = function ($connection, $data) use ($worker, $adminConnections) {
		// post form login is-admin >>>  add conn id to array
		//
		// echo "\nData catched!\n";

		// if($data === 'admin') {
		// 	$adminConnections[$connection->id] = $connection;
		// 	echo "Admin connected\n";
		// } else {
		// 	foreach($adminConnections as $adminCon) {
		// 		// if cliconn->id == admin conn id >>> send mess
		// 		$adminCon->send($data);
		// 		echo 'Data send to admins';
		// 		echo $data . "\n";
		// 	}
		// }
		foreach($worker->connections as $clientConnection) {
			// if cliconn->id == admin conn id >>> send mess
			$clientConnection->send($data);
			echo $data . "\n";
		}

		//print_r($adminConnections);
	};

	$worker->onClose = function ($connection) use (&$connections) {
		unset($connections[$connection->id]);
		echo "Connection closed\n";
	};

	Worker::runAll();
?>