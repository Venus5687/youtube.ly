<?php
if (isset($_GET["vid"])) {
    $url = $_GET["vid"];
    if (str_ends_with($_GET["vid"], '.mp4')) {
        $url = str_replace(".mp4", "", $_GET["vid"]);
    }
    $curlSES = curl_init();
	// proper config hasn't been done yet so if you want a different instance (must not have a bot check), replace the url with the instance you want
    curl_setopt($curlSES, CURLOPT_URL, "http://invidious.kemonomimi.nl/latest_version?id=" . urlencode($url) . "&itag=18&check=");
    curl_setopt($curlSES, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlSES, CURLOPT_HEADER, false);
    curl_setopt($curlSES, CURLOPT_FOLLOWLOCATION, true); 
    curl_exec($curlSES);
    $finalUrl = curl_getinfo($curlSES, CURLINFO_EFFECTIVE_URL); 
    curl_setopt($curlSES, CURLOPT_URL, $finalUrl);
    $vid = curl_exec($curlSES);
    curl_close($curlSES);
    header('Content-Type: video/mp4');
    echo $vid;
    } else if (str_ends_with($_GET["url"], '.mp4')) {
$file = $_GET["url"];
$fp = fopen($file, 'rb');
$size = filesize($file);
$start = 0;
$end = $size - 1;

if (isset($_SERVER['HTTP_RANGE'])) {
    list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
    if (strpos($range, ',') !== false) {
        header('HTTP/1.1 416 Requested Range Not Satisfiable');
        exit;
    }
    $range = explode('-', $range);
    $start = (int)$range[0];
    $end = (isset($range[1]) && is_numeric($range[1])) ? (int)$range[1] : $size - 1;
    
    header('HTTP/1.1 206 Partial Content');
}

$length = ($end - $start) + 1;
header("Content-Type: video/mp4");
header("Accept-Ranges: bytes");
header("Content-Range: bytes " . $start . "-" . $end . "/" . $size);
header("Content-Length: " . $length);

fseek($fp, $start);
echo fread($fp, $length);
fclose($fp);
} else {

$homepage = file_get_contents($_GET["url"] . ".json");
header('Content-Type: application/json');
echo $homepage;
}

?>
