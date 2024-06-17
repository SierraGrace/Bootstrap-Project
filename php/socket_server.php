<?php
	use Workerman\Worker;
	require_once __DIR__ . '../vendor/autoload.php';

	$worker = new Worker('websocket://localhost:8001');
	$worker->count = 4;
?>