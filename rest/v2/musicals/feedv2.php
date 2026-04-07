<?php

	$mids = [];
	$ids = [];
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

    $authorName = $video['author'] ?? 'Unknown';
    $videoId = $video['videoId'] ?? '';
    $title = $video['title'] ?? 'No Title';
    $chId = $video['authorId'] ?? '';
    // proper config hasn't been done yet so replace the url with your server's url
	$headers = getallheaders();
	if (str_starts_with($headers['version'], "5.")) {
		$item = [
		    "musicalId"        => $currentId,
		    "musicalIdStr"     => (string)$currentId,
		    "caption"          => $title,
		    "width"            => 360,
		    "height"           => 640,
		    "videoUri"         => "http://localhost:4000/servevid/" . $videoId . ".mp4",
		    "thumbnailUri"     => "http://localhost:4000/musicals/thumb.png",
		    "startTime"        => 0,
		    "track"            => [
		        "trackId"   => (int)$num_str,
		        "foreignId" => $num_str,
		        "source"    => "mu",
		        "previewUri"=> null,
		        "sequence"  => 0,
		        "author"    => [
		            "artistId"  => (int)$num_str,
		            "foreignId" => $num_str,
		            "source"    => "mu",
		            "name"      => "original sound"
		        ],
		        "song"      => [
		            "songId"    => (int)$num_str,
		            "foreignId" => $num_str,
		            "source"    => "mu",
		            "title"     => $authorName
		        ],
		        "album"     => [
		            "albumId"      => (int)$num_str,
		            "foreignId"    => $num_str,
		            "source"       => "mu",
		            "title"        => "original sound",
		            "thumbnailUri" => null
		        ]
		    ],
		    "trackId"          => (int)$num_str,
		    "author"           => [
		        "userId"        => (int)$num_str,
		        "userIdStr"     => $chId,
		        "name"          => $authorName,
		        "nickName"      => $authorName,
		        "realName"      => $authorName,
		        "handle"        => $authorName,
		        "icon"          => "http://localhost:4000/servepfp/" . $chId,
		        "gender"        => "m",
		        "verified"      => false,
		        "featuredScope" => 0,
		        "bid"           => $chId,
		        "disabled"      => false,
		        "emailVerified" => false,
		        "userSettingDTO" => [
		            "userId"        => (int)$num_str,
		            "secret"        => false,
		            "duet"          => false,
		            "hideLocation"  => false,
		            "privateChat"   => false,
		            "policyVersion" => 1
		        ],
		        "userRequestDTO" => [
		            "follow" => false
		        ]
		    ],
		    "authorId"         => (int)$num_str,
		    "status"           => 2,
		    "promoted"         => false,
		    "promoteType"      => 0,
		    "indexTime"        => 1774279955000,
		    "liked"            => false,
		    "owned"            => false,
		    "likedNum"         => 0,
		    "readNum"          => 0,
		    "commentNum"       => 0,
		    "remixFrom"        => 0,
		    "musicalSource"    => "MLServer",
		    "clientCreateTime" => 1771787350000,
		    "bid"              => (string)$currentId,
		    "videoSource"      => 1,
		    "appliedFilter"    => null,
		    "appVersion"       => "3.5.1",
		    "ost"              => false,
		    "musicalType"      => 0,
		    "duet"             => false,
		    "createdInCn"      => false
		];
} else {
	$item = [
	    "musicalId"              => $currentId,
	    "musicalIdStr"           => (string)$currentId,
	    "caption"                => $title,
	    "width"                  => 360,
	    "height"                 => 640,
	    "videoUri"               => "http://localhost:4000/servevid/" . $videoId . ".mp4",
	    "lowQualityVideoUri"     => null,
	    "middleQualityVideoUri"  => null,
	    "previewUrl"             => null,
	    "thumbnailUri"           => "http://localhost:4000/musicals/thumb.png",
	    "thumbnailOriginalUri"   => null,
	    "thumbnailOriginalWidth" => 0,
	    "thumbnailOriginalHeight"=> 0,
	    "startTime"              => 0,
	    "orientation"            => null,
	    "width"                  => 360,
	    "height"                 => 640,
	    "os"                     => null,
	    "appVersion"             => "3.5.1",
	    "minClientVersion"       => null,
	    "extInfo"                => null,
	    "faceMaskId"             => null,
	    "scm"                    => null,
	    "track"                  => [
	        "trackId"   => (int)$num_str,
	        "foreignId" => $num_str,
	        "source"    => "mu",
	        "previewUri"=> null,
	        "sequence"  => 0,
	        "author"    => [
	            "artistId"  => (int)$num_str,
	            "foreignId" => $num_str,
	            "source"    => "mu",
	            "name"      => "original sound"
	        ],
	        "song"      => [
	            "songId"    => (int)$num_str,
	            "foreignId" => $num_str,
	            "source"    => "mu",
	            "title"     => $authorName
	        ],
	        "album"     => [
	            "albumId"      => (int)$num_str,
	            "foreignId"    => $num_str,
	            "source"       => "mu",
	            "title"        => "original sound",
	            "thumbnailUri" => null
	        ]
	    ],
	    "trackId"                => (int)$num_str,
	    "author"                 => [
	        "userId"         => (int)$num_str,
	        "userIdStr"      => $chId,
	        "name"           => $authorName,
	        "nickName"       => $authorName,
	        "realName"       => $authorName,
	        "handle"         => $authorName,
	        "icon"           => "http://localhost:4000/servepfp/" . $chId,
	        "gender"         => "m",
	        "verified"       => false,
	        "featuredScope"  => 0,
	        "bid"            => $chId,
	        "disabled"       => false,
	        "emailVerified"  => false,
	        "userSettingDTO" => [
	            "userId"        => (int)$num_str,
	            "secret"        => false,
	            "duet"          => false,
	            "hideLocation"  => false,
	            "privateChat"   => false,
	            "policyVersion" => 1
	        ],
	        "userRequestDTO" => [
	            "follow" => false
	        ]
	    ],
	    "authorId"               => (int)$num_str,
	    "reposter"               => null,
	    "status"                 => 2,
	    "banned"                 => 0,
	    "promoted"               => false,
	    "promoteType"            => 0,
	    "promotedRegion"         => 0,
	    "promotedRegions"        => [],
	    "partyId"                => null,
	    "partyPromotedFlag"      => null,
	    "activityId"             => null,
	    "indexTime"              => 1774279955000,
	    "insertTime"             => 1774279955000,
	    "clientCreateTime"       => 1771787350000,
	    "liked"                  => false,
	    "owned"                  => false,
	    "likedNum"               => 0,
	    "hotLikedNum"            => 0,
	    "readNum"                => 0,
	    "commentNum"             => 0,
	    "remixFrom"              => 0,
	    "musicalSource"          => "MLServer",
	    "businessSource"         => null,
	    "musicalType"            => 0,
	    "isDuet"                 => false,
	    "duet"                   => false,
	    "duetFromMusicalId"      => null,
	    "duetFromUserId"         => null,
	    "ost"                    => false,
	    "inPool"                 => false,
	    "tags"                   => [],
	    "latitude"               => null,
	    "longitude"              => null,
	    "regionCode"             => 0,
	    "regionTitle"            => null,
	    "recommendMeta"          => null,
	    "question"               => null,
	    "videoSource"            => 1,
	    "appliedFilter"          => null,
	    "bid"                    => (string)$currentId
	];
}
    $musicalArray[] = $item;
	$mids[] = (string)$currentId;
	$ids[] = $videoId;
    $num_str = sprintf("%06d", mt_rand(10000, 999999));
    $currentId++;
}

$export = "<?php\n";
$export .= "\$mids = " . var_export($mids, true) . ";\n";
$export .= "\$ids = " . var_export($ids, true) . ";\n";
file_put_contents('../../idsForComments.php', $export);
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
		"numberOfElements" => count($musicalArray),
        "firstPage" => true,
        "lastPage" => true
    ],
    "timestamp" => time() * 1000,
    "fail" => false
];

header('Content-Type: application/json');
echo json_encode($finalResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
