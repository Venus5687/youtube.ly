<?php
header('Content-Type: application/json');

$tag = "trending";

echo json_encode([
    "success"   => true,
	"advItems" => [],
	"errorCode" => null,
	"errorMsg" => null,
	"errorTitle" => null,
	"fail" => false,
    "result"    => [
		"content" => []
    ],
    "timestamp" => round(microtime(true) * 1000)
]);
?>