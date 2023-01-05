<?php

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function get_env() {
	return $_ENV;
}

function sendResponse($value = [], $code = 200, $message = 'Success') {
	http_response_code($code);
	echo json_encode(['data' => $value, 'message' => $message]);
}

?>
