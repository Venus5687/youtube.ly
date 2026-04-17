<?php
if ($_GET["key"] == "topSong") {
header('Content-Type: application/json');
echo json_encode([
    "success" => true,
	"advItems" => [],
	"errorCode" => null,
	"errorMsg" => null,
	"errorTitle" => null,
	"fail" => false,
    "result" => [
		"content" => '[{"trackId": 1, "song": "New Friendly","author": "Kevin MacLeod","champion": "New Friendly","cover" : null},{"trackId": 2, "song": "Itty Bitty 8 Bit","author": "Kevin MacLeod","champion": "Itty Bitty 8 Bit","cover" : null},{"trackId": 3, "song": "Fig Leaf Times Two","author": "Kevin MacLeod","champion": "Fig Leaf Times Two","cover" : null},]',
				 "itemId" => 3,
				 "itemKey" => "topSong",
				 "regionCode" => 2
    ],
    "timestamp" => round(microtime(true) * 1000)
    
]);
} else if ($_GET["key"] == "parameters") {
	header('Content-Type: application/json');

	echo "";
}
?>
