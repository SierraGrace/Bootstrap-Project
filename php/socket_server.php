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

	function saveData($logged_in, $sessionId, $type, $value) {
	    global $dataFile;
	    $userData = loadData();

	    if (!isset($userData[$sessionId])) {
	        $userData[$sessionId] = [
	            'logged_in' => $logged_in,
	            'session_id' => $sessionId,
	            'messages' => []
	        ];
	    } else {
	        $userData[$sessionId]['logged_in'] = $logged_in;
	    }


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

	function deleteData($sessionId) {
	    global $dataFile;
	    $userData = loadData();

	    if (isset($userData[$sessionId])) {
	        unset($userData[$sessionId]);
	    }

    	file_put_contents($dataFile, json_encode($userData, JSON_PRETTY_PRINT));

    	echo "Data deleted";
	}

	$worker->onConnect = function ($connection) {
		$connections[$connection->id] = $connection;

		echo "New connection\n";
		echo "ID: " . $connection->id . "\n";
		echo "IP: " . $connection->getRemoteIp() . "\n";
   		echo "Remote port: " . $connection->getRemotePort() . "\n";
   		echo "Used prototocol: " . $connection->protocol . "\n";
	};

	$worker->onMessage = function ($connection, $data) use ($worker, &$adminConnections) {


		echo "\nData catched!\n";

		if($data === 'admin') {
			$adminConnections[$connection->id] = $connection;
			echo "Admin connected\n";
		} else {
			$message = json_decode($data, true);
			saveData($message['logged_in'], $message['session_id'], $message['type'], $message['value']);

			foreach($adminConnections as $adminCon) {
				$adminCon->send($data);
				echo 'Data send to admins';
				echo $data . "\n";
			}
		}
	};

	$worker->onClose = function ($connection) use (&$connections) {
		unset($connections[$connection->id]);
		//deleteData();

		echo "Connection closed\n";
	};

	Worker::runAll();
?>