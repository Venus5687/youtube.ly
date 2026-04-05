<?php
set_time_limit(120); 
// proper config hasn't been done yet so if you want a different instance (must not have a bot check), replace the url with the instance you want
$instance = "http://invidious.kemonomimi.nl";
// proper config hasn't been done yet so insert your target channel ids here
$channels = [
    
];

$allVideos = [];
$musicalArray = [];
$currentId = 1;


foreach ($channels as $id) {
    $apiUrl = $instance . "/api/v1/channels/" . $id . "/shorts";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpCode === 200 && $response) {
        $data = json_decode($response, true);
        if (isset($data['videos'])) {
    $videos = $data['videos'];
} else {
    $videos = $data;
}

if (is_array($videos)) {
    $allVideos = array_merge($allVideos, array_slice($videos, 0, 10));
}

    }
    usleep(500000); 
}

foreach ($allVideos as $video) {
    $num_str = sprintf("%06d", mt_rand(10000, 999999));
    if ($currentId == 12) $currentId++;

    $authorName = $video['author'] ?? 'Unknown';
    $videoId = $video['videoId'] ?? '';
    $title = $video['title'] ?? 'No Title';

    // proper config hasn't been done yet so replace the url with your server's url
    $item = [
        "musicalId" => $currentId,
        "caption" => $title,
        "width" => 360,
        "height" => 640,
        "videoUri" => "http://localhost:4000/servevid/" . $videoId . ".mp4",
        "thumbnailUri" => "http://localhost:4000/musicals/thumb.png",
        "startTime" => 0,
        "author" => [
            "bid" => $num_str,
            "handle" => $authorName,
            "icon" => null,
            "name" => $authorName,
            "nickName" => $authorName,
            "userId" => (int)$num_str
        ],
        "status" => 2,
        "promoted" => false,
        "promoteType" => null,
        "promteTime" => null,
        "indexTime" => 1774279955000,
        "liked" => false,
        "owned" => false,
        "likedNum" => 0,
        "readNum" => 0,
        "commentNum" => 0,
        "remixFrom" => null,
        "videoOssPushed" => false,
        "videoS3Pushed" => false,
        "thumbnailOssPushed" => false,
        "thumbnailS3Pushed" => false,
        "createdInCn" => false,
        "clientCreateTime" => 1771787350000,
        "videoSource" => null,
        "appliedFilter" => null,
        "inPool" => false,
        "appVersion" => "1.1.2",
        "ost" => false,
        "isDuet" => false,
        "duetFromMusicalId" => null,
        "duetFromUserId" => null,
        "bid" => (string)$currentId,
        "musicalSource" => "MLServer",
        "tags" => [],
        "track" => [
            "trackId" => 0,
            "buyLink" => null,
            "buyUrl" => null,
            "musicalNum" => 0,
            "previewUri" => null,
            "sequence" => 0,
            "youtubeLink" => null,
            "createdInCn" => true,
            "ossPushed" => false,
            "s3Pushed" => false,
            "foreignId" => "0",
            "source" => "mu",
            "album" => ["albumId" => (int)$num_str, "foreignId" => $num_str, "thumbnailUri" => null, "title" => "original sound", "ossPushed" => false, "s3Pushed" => false, "source" => "mu" ],
            "author" => ["artistId" => (int)$num_str, "foreignId" => $num_str, "source" => "mu", "name" => "original sound"],
            "song" => ["songId" => (int)$num_str, "foreignId" => $num_str, "source" => "mu", "title" => $authorName]
        ]
    ];

    $musicalArray[] = $item;
    $num_str = sprintf("%06d", mt_rand(10000, 999999));
    $currentId++;
}


shuffle($musicalArray);


$finalResponse = [
    "success" => true,
    "result" => [
        "content" => $musicalArray,
        "total" => count($musicalArray),
        "number" => 0,
        "size" => count($musicalArray),
        "totalPages" => 1,
        "totalElements" => count($musicalArray),
        "firstPage" => true,
        "lastPage" => true
    ],
    "timestamp" => time() * 1000,
    "fail" => false
];

header('Content-Type: application/json');
echo json_encode($finalResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
