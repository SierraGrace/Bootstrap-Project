<?php
	use Workerman\Worker;
	require_once __DIR__ . '/../vendor/autoload.php';
	$dataFile = __DIR__ . '/../data.json';

	$worker = new Worker('websocket://localhost:8001');

	$userData = [];
	$adminConnections = [];
	$connections = [];

	function loadData() {
    global $dataFile;
    if (file_exists($dataFile)) {
        $data = file_get_contents($dataFile);
        return json_decode($data, true);
    }
    return [];
}

	function saveData($sessionId, $logged_in, $type, $value) {
    global $dataFile;
    $userData = loadData();

    // Если данных для данного sessionId нет, создаем их
    if (!isset($userData[$sessionId])) {
        $userData[$sessionId] = [
            'logged_in' => $logged_in,
            'session_id' => $sessionId,
            'messages' => []
        ];
    } else {
        // Обновление статуса logged_in для существующего sessionId
        $userData[$sessionId]['logged_in'] = $logged_in;
    }

    // Обновление или добавление нового типа сообщения
    $found = false;
    foreach ($userData[$sessionId]['messages'] as &$message) {
        if ($message['type'] === $type) {
            $message['value'] = $value;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $userData[$sessionId]['messages'][] = [
            'type' => $type,
            'value' => $value
        ];
    }

    file_put_contents($dataFile, json_encode($userData, JSON_PRETTY_PRINT));

    echo "Data saved V4";
}

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
		$message = json_decode($data, true);

		saveData($message['session_id'], $message['logged_in'], $message['type'], $message['value']);

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