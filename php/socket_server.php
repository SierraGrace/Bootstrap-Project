<?php
	use Workerman\Worker;

	require_once __DIR__ . '/../vendor/autoload.php';
	$dataFile = __DIR__ . '/../data.json';

	$worker = new Worker('websocket://localhost:8001');

	$adminConnections = [];

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

	    echo "Data saved to file\n";
	}

	function deleteData($sessionId) {
	    global $dataFile;
	    $userData = loadData();

	    if (isset($userData[$sessionId])) {
	        unset($userData[$sessionId]);
	    }

    	file_put_contents($dataFile, json_encode($userData, JSON_PRETTY_PRINT));

    	echo "Data deleted from file\n";
	}

	$worker->onConnect = function ($connection) use (&$adminConnections) {
		echo "New connection\n";
		echo "ID: " . $connection->id . "\n";
		echo "IP: " . $connection->getRemoteIp() . "\n";
   		echo "Remote port: " . $connection->getRemotePort() . "\n";
   		echo "Used prototocol: " . $connection->protocol . "\n";
	};

	$worker->onMessage = function ($connection, $data) use ($worker, &$adminConnections) {
		if($data === 'admin') {
			$adminConnections[$connection->id] = $connection;

			$fullData = loadData();
			$existingFullData = [
				'type' => 'existing_data',
				'data' => $fullData
			];

			$connection->send(json_encode($existingFullData, JSON_PRETTY_PRINT));

			echo "Admin connected and data send!\n";
		} else {
			$message = json_decode($data, true);

			if (is_array($message) && isset($message['session_id'], $message['logged_in'])) {
            	$connection->session_id = $message['session_id'];
            	$connection->logged_in = $message['logged_in'];
        	}

        	$previousData = loadData();

        	if (isset($previousData[$message['session_id']]) && $previousData[$message['session_id']]['logged_in'] !== $message['logged_in']) {
        		deleteData($message['session_id']);
        	}  
        	
        	saveData($message['logged_in'], $message['session_id'], $message['type'], $message['value']);

        	foreach($adminConnections as $adminCon) {
				$adminCon->send($data);
				echo "Data send to admins and updated in files\n";
			}
		}
	};

	$worker->onClose = function ($connection) use (&$connections, &$adminConnections) {
		deleteData($connection->session_id);

		unset($connections[$connection->id]);

		echo "Connection closed\n";
	};

	Worker::runAll();
?>