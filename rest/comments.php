<?php
include "idsForComments.php";
header('Content-Type: application/json');
// proper config hasn't been done yet so if you want a different instance (must not have a bot check), replace the url with the instance you want
$instance = "http://invidious.kemonomimi.nl";
$targetKey  = $_GET["targetKey"] ?? "0";
$targetType = (int)($_GET["targetType"] ?? 0);
$pageNo     = (int)($_GET["pageNo"] ?? 1);
$pageSize   = (int)($_GET["pageSize"] ?? 20);
$index = array_search($targetKey, $mids);
$vid = $ids[$index];
$contents = []; 
    $apiUrl = $instance . "/api/v1/comments/" . $vid;
    
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
        if (isset($data['comments'])) {
    $comments = $data['comments'];
} else {
    $comments = $data;
}
if (is_array($comments)) {
	$contents = array_slice($comments, 0, 19);
}
}
$comment = [];
$currentId = 1;
foreach ($contents as $con) {
$num_str = sprintf("%06d", mt_rand(10000, 999999));
$chId = $con['authorId'] ?? '';
$item = [
    "commentId"   => $currentId,
    "bid"         => (string)$currentId,
    "commentText" => $con["content"],
    "commentType" => 0,
    "commentBy"   => [
        "userId" => (int)$num_str,
        "userIdStr"      => $chId,
        "name"           => $con["author"],
        "nickName"       => $con["author"],
        "realName"       => $con["author"],
        "handle"         => $con["author"],
        "email"          => null,
        "password"       => null,
        "phone"          => null,
        "icon"           => "http://192.168.120.21:8080/servepfp/" . $chId,
        "gender"         => "m",
        "bid"            => $chId,
        "admin"          => false,
        "blocked"        => false,
        "disabled"       => false,
        "verified"       => false,
        "verifiedPhone"  => false,
        "emailVerified"  => false,
        "reviewer"       => false,
        "suspicious"     => false,
        "inCn"           => false,
        "postNotify"     => false,
        "registered"     => true,
        "source"         => 0,
        "regionCode"     => 0,
        "regionTitle"    => null,
        "countryCode"    => null,
        "scm"            => null,
        "introduction"   => null,
        "userDesc"       => null,
        "instagramID"    => null,
        "googleAccount"  => null,
        "youtubeChannelId"   => null,
        "youtubeChannelTitle"=> null,
        "liveId"         => null,
        "livelyHearts"   => 0,
        "recType"        => null,
        "extProps"       => null,
        "featuredScope"  => 0,
        "featuredTime"   => null,
        "featuredRegions"=> [],
        "handleModified" => null,
        "insertTime"     => null,
        "musicalNum"     => 0,
        "privateMusicalNum" => 0,
        "musicalLikedNum"=> 0,
        "musicalReadNum" => 0,
        "likesNum"       => 0,
        "fansNum"        => 0,
        "followNum"      => 0,
        "commentsNum"    => 0,
        "readNum"        => 0,
        "followed"       => false,
        "following"      => false,
        "complimented"   => false,
        "followList"     => [],
        "relationsFromMe"=> [],
        "relationsToMe"  => [],
        "sociaMediaList" => [],
        "subscribeList"  => [],
        "userRequestDTO" => ["follow" => false],
        "userSettingDTO" => [
            "userId"        => 1,
            "secret"        => false,
            "duet"          => false,
            "hideLocation"  => false,
            "privateChat"   => false,
            "directAccount" => null,
            "policyVersion" => 1,
            "birthDay"      => null,
            "birthYear"     => null,
            "countryCode"   => null,
            "languageCode"  => null,
            "timeZone"      => null
        ]
    ],
    "targetId"    => (int)$targetKey,  // use targetKey from request
    "targetKey"   => $targetKey,
    "targetType"  => $targetType,      // use targetType from request
    "refId"       => null,
    "refLiveUri"  => null,
    "mediaUri"    => null,
    "replyTo"     => null,
    "status"      => 1,
    "featured"    => false,
    "liked"       => false,
    "likedNum"    => $con["likeCount"],
    "owned"       => false,
    "index"       => 0,
    "insertTime"  => round(microtime(true) * 1000)
];
$comment[] = $item;
$currentId++;
}
echo json_encode([
    "success"  => true,
    "fallback" => false,
    "fail"     => false,
    "result"   => [
        "content" => $comment,
        "total"            => 1,
        "number"           => $pageNo - 1,
        "size"             => $pageSize,
		"total"            => count($comment),
		"totalPages"            => count($comment),
		"totalElements"    => count($comment),
		"numberOfElements" => count($comment),
        "firstPage"        => true,
        "lastPage"         => true
    ],
    "timestamp" => round(microtime(true) * 1000)
]);
?>