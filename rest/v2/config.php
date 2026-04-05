<?php
if ($_GET["key"] == "topSong") {
header('Content-Type: application/json');
echo json_encode([
    [
            "trackId"  => 1,
            "song"     => "New Friendly",
            "author"   => "Kevin MacLeod",
            "champion" => "Kevin MacLeod",
            "cover"    => null
        ],
        [
            "trackId"  => 2,
            "song"     => "Itty Bitty 8 Bit",
            "author"   => "Kevin MacLeod",
            "champion" => "Kevin MacLeod",
            "cover"    => null
        ],
        [
            "trackId"  => 3,
            "song"     => "Fig Leaf Times Two",
            "author"   => "Kevin MacLeod",
            "champion" => "Kevin MacLeod",
            "cover"    => null
		]
    
]);
} else if ($_GET["key"] == "parameters") {
	header('Content-Type: application/json');

	echo "";
}
?>