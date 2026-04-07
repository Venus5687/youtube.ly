<?php
if (isset($_GET["chid"]) && str_starts_with($_GET["chid"], "UC")) {
	// proper config hasn't been done yet so if you want a different instance (must not have a bot check), replace the url with the instance you want
    $curlSES = curl_init();
	curl_setopt($curlSES, CURLOPT_URL, "http://invidious.kemonomimi.nl/api/v1/channels/" . urlencode($_GET["chid"]));
    curl_setopt($curlSES, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlSES, CURLOPT_HEADER, false);
	curl_setopt($curlSES, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64)");
    curl_setopt($curlSES, CURLOPT_FOLLOWLOCATION, true); 
    curl_exec($curlSES);
    $finalUrl = curl_getinfo($curlSES, CURLINFO_EFFECTIVE_URL); 
    curl_setopt($curlSES, CURLOPT_URL, $finalUrl);
    $chid = curl_exec($curlSES);
	$chid = json_decode($chid, true);
    curl_close($curlSES);
	$num_str = sprintf("%06d", mt_rand(10000, 999999));
	$bid = $_GET["chid"];
	header('Content-Type: application/json');
	echo json_encode([
	    "success"    => true,
	    "errorCode"  => null,
	    "errorMsg"   => null,
	    "errorTitle" => null,
	    "advItems"   => [],
		"result" => [
		    "userId"             => $bid,
		    "userIdStr"          => $bid,
		    "name"               => $chid["author"],
		    "nickName"           => $chid["author"],
		    "realName"           => $chid["author"],
		    "handle"             => $chid["author"],
		    "email"              => "example@example.com",
		    "password"           => null,
		    "phone"              => null,
		    "icon"               => "http://192.168.120.21:8080/servepfp/" . $_GET["chid"],
		    "gender"             => "m",
		    "bid"                => $bid,
		    "admin"              => false,
		    "blocked"            => false,
		    "disabled"           => false,
		    "verified"           => false,
		    "verifiedPhone"      => false,
		    "emailVerified"      => true,
		    "reviewer"           => false,
		    "suspicious"         => false,
		    "inCn"               => false,
		    "postNotify"         => false,
		    "registered"         => true,
		    "source"             => 0,
		    "regionCode"         => 0,
		    "regionTitle"        => null,
		    "countryCode"        => null,
		    "scm"                => null,
		    "introduction"       => null,
		    "userDesc"           => $chid["description"],
		    "instagramID"        => null,
		    "googleAccount"      => null,
		    "youtubeChannelId"   => null,
		    "youtubeChannelTitle"=> null,
		    "liveId"             => null,
		    "livelyHearts"       => 0,
		    "recType"            => null,
		    "extProps"           => null,
		    "featuredScope"      => 0,
		    "featuredTime"       => null,
		    "featuredRegions"    => [],
		    "handleModified"     => null,
		    "insertTime"         => null,
		    "updateTime"         => null,
		    "musicalNum"         => 0,
		    "privateMusicalNum"  => 0,
		    "musicalLikedNum"    => 0,
		    "musicalReadNum"     => 0,
		    "likesNum"           => 0,
		    "fansNum"            => $chid["subCount"],
		    "followNum"          => 0,
		    "commentsNum"        => 0,
		    "readNum"            => 0,
		    "followed"           => false,
		    "following"          => false,
		    "complimented"       => false,
		    "followList"         => [],
		    "relationsFromMe"    => [],
		    "relationsToMe"      => [],
		    "sociaMediaList"     => [],
		    "subscribeList"      => [],
		    "userRequestDTO"     => [
		        "follow" => false
		    ],
		    "userSettingDTO"     => [
		        "userId"        => $num_str,
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
	    "registered" => true,
	    "timestamp"  => 1754538451000,
	    "fail"       => false
	]);
} else {
	$num_str = sprintf("%06d", mt_rand(10000, 999999));
	$bid = base64_encode((string)$num_str);
	header('Content-Type: application/json');
	echo json_encode([
	    "success"    => true,
	    "errorCode"  => null,
	    "errorMsg"   => null,
	    "errorTitle" => null,
	    "advItems"   => [],
		"result" => [
		    "userId"             => $num_str,
		    "userIdStr"          => (string)$num_str,
		    "name"               => (string)$num_str,
		    "nickName"           => (string)$num_str,
		    "realName"           => (string)$num_str,
		    "handle"             => (string)$num_str,
		    "email"              => "example@example.com",
		    "password"           => null,
		    "phone"              => null,
		    "icon"               => null,
		    "gender"             => "m",
		    "bid"                => $bid,
		    "admin"              => false,
		    "blocked"            => false,
		    "disabled"           => false,
		    "verified"           => false,
		    "verifiedPhone"      => false,
		    "emailVerified"      => true,
		    "reviewer"           => false,
		    "suspicious"         => false,
		    "inCn"               => false,
		    "postNotify"         => false,
		    "registered"         => true,
		    "source"             => 0,
		    "regionCode"         => 0,
		    "regionTitle"        => null,
		    "countryCode"        => null,
		    "scm"                => null,
		    "introduction"       => null,
		    "userDesc"           => '"live with passion, live musical.ly"',
		    "instagramID"        => null,
		    "googleAccount"      => null,
		    "youtubeChannelId"   => null,
		    "youtubeChannelTitle"=> null,
		    "liveId"             => null,
		    "livelyHearts"       => 0,
		    "recType"            => null,
		    "extProps"           => null,
		    "featuredScope"      => 0,
		    "featuredTime"       => null,
		    "featuredRegions"    => [],
		    "handleModified"     => null,
		    "insertTime"         => null,
		    "updateTime"         => null,
		    "musicalNum"         => 0,
		    "privateMusicalNum"  => 0,
		    "musicalLikedNum"    => 0,
		    "musicalReadNum"     => 0,
		    "likesNum"           => 0,
		    "fansNum"            => 0,
		    "followNum"          => 0,
		    "commentsNum"        => 0,
		    "readNum"            => 0,
		    "followed"           => false,
		    "following"          => false,
		    "complimented"       => false,
		    "followList"         => [],
		    "relationsFromMe"    => [],
		    "relationsToMe"      => [],
		    "sociaMediaList"     => [],
		    "subscribeList"      => [],
		    "userRequestDTO"     => [
		        "follow" => false
		    ],
		    "userSettingDTO"     => [
		        "userId"        => $num_str,
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
	    "registered" => true,
	    "timestamp"  => 1754538451000,
	    "fail"       => false
	]);	
}
