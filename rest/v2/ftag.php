<?php
header('Content-Type: application/json');
$base_url = (!empty($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
$tag = "trending";
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $base_url . "/rest/v2/musicals/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    
    $json_input = curl_exec($ch);
    curl_close($ch);
$data = json_decode($json_input, true);
 
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error parsing JSON: " . json_last_error_msg() . "\n" . "The error is: " . $json_input);
}
if (!isset($data['result']['content']) || !is_array($data['result']['content'])) {
    die("Error: 'result.content' not found or is not an array.\n");
}
 
$content = $data['result']['content'];
$all_results = [];
 
foreach ($content as $index => $item) {
    if (!isset($item['caption'])) {
        continue;
    }
 
    $caption = $item['caption'];
    preg_match_all('/#[\w]+/u', $caption, $matches);
    $hashtags = $matches[0];
 foreach ($hashtags as $h) {
    $all_results[] = [
		"tagId" => $index,
		"tag"  => $h,
		"displayName" => $h,
		"desc" => $h . " hashtag",
		"ext" => null,
		"imageUri"  => null,
		"videoCaption" => null,
		"followed" => false,
		"followedNum" => 0,
		"musicalNum" => 0,
		"officialMusicalId" => 289082938932,
		"promoteTime" => 1774372271000,
		"promoteType" => 3,
		"inContest" => false,
		"inDuet" => false
		];
		}
}
$all_tags = count($all_results);
echo json_encode([
    "success"   => true,
	"advItems" => [],
	"errorCode" => null,
	"errorMsg" => null,
	"errorTitle" => null,
	"fail" => false,
    "result"    => [
		"content" => $all_results,
		"total" => $all_tags,
		"number" => 0,
		"size" => $all_tags + 5,
		"totalPages" => 1,
		"totalElements" => $all_tags,
		"numberOfElements" => $all_tags,
		"firstPage" => true,
		"lastPage" => true
    ],
    "timestamp" => round(microtime(true) * 1000)
]);
?>
