<?php
header('Content-Type: application/json');

if (($_POST["email"] == "example@example.com" || $_POST["email"] == "@820182") && $_POST["password"] == "123456") {
	setcookie('SLIDER_SHOW_COOKIE', 'musically_session_' . $userId, [
	    'expires'  => time() + (86400 * 30),
	    'path'     => '/',
	    'httponly' => false,
	    'samesite' => 'Lax'
	]);
	if ($_POST["nickName"] == "820182") {
		header('Content-Type: application/json');

		echo json_encode([
		    "success"    => true,
		    "errorCode"  => null,
		    "errorMsg"   => null,
		    "errorTitle" => null,
		    "advItems"   => [],
		    "result"     => [
		        "userId"         => (int)$_POST["userId"],
		        "userIdStr"      => $_POST["userId"],
		        "bid"            => $_POST["bid"],
		        "nickName"       => $_POST["nickName"],
		        "handle"         => $_POST["handle"],
		        "gender"         => $_POST["gender"],
		        "email"          => $_POST["email"],
		        "icon"           => $_POST["icon"] ?? null,
		        "instagramID"    => $_POST["instagramID"] ?? null,
		        "introduction"   => null,
		        "userDesc"       => $_POST["userDesc"] ?? "live with passion, live musical.ly",
		        "verified"       => (bool)$_POST["verified"],
		        "featuredScope"  => (int)$_POST["featuredScope"],
		        "followed"       => false,
		        "following"      => false,
		        "blocked"        => false,
		        "complimented"   => false,
		        "postNotify"     => false,
		        "handleModified" => null,
		        "fansNum"        => (int)$_POST["fansNum"],
		        "followNum"      => (int)$_POST["followNum"],
		        "likesNum"       => (int)$_POST["likesNum"] ?? 0,
		        "musicalNum"     => 0,
		        "musicalLikedNum"=> 0,
		        "musicalReadNum" => 0,
		        "realName"       => $_POST["realName"] ?? null,
		        "reviewer"       => (bool)($_POST["reviewer"] ?? false),
		        "sociaMediaList" => [],
		        "userRequestDTO" => ["follow" => false],
		        "userSettingDTO" => [
		            "userId"  => (int)$_POST["userId"],
		            "secret"  => (bool)($_POST["userSettingDTO"]["secret"] ?? false),
		            "duet"    => (bool)($_POST["userSettingDTO"]["duet"] ?? false),
		            "hideLocation" => false,
		            "privateChat"  => false,
		            "directAccount"=> null,
		            "policyVersion"=> 1,
		            "birthDay"     => null,
		            "birthYear"    => null,
		            "countryCode"  => null,
		            "languageCode" => null,
		            "timeZone"     => null
		        ]
		    ],
		    "registered" => true,
		    "timestamp"  => round(microtime(true) * 1000),
		    "fail"       => false
		]);
		
	} else {
    echo json_encode([
        "success"    => true,
        "errorCode"  => null,
        "errorMsg"   => null,
        "errorTitle" => null,
        "advItems"   => [],
        "result"     => [
    "userId"         => 1,        
    "userIdStr"      => "1",
    "bid"            => "1",      
    "nickName"       => "820182",
    "handle"         => "820182",
    "gender"         => "m",
    "icon"           => null,     
    "userDesc"       => "live with passion, live musical.ly",
    "verified"       => false,
    "featured"       => false,    
    "featuredScope"  => 0,
    "followed"       => false,
    "following"      => false,
    "blocked"        => false,
    "complimented"   => false,
    "postNotify"     => false,
    "instagramID"    => null,     
    "introduction"   => null,
    "handleModified" => null,
    "fansNum"        => 0,
    "followNum"      => 0,
    "likesNum"       => 0,
    "musicalNum"     => 0,
    "musicalLikedNum"=> 0,
    "musicalReadNum" => 0,
    "email"          => "example@example.com",
    "sociaMediaList" => [],       
    "userRequestDTO" => [
        "follow" => false         
    ],
    "userSettingDTO" => [
        "userId"  => 1,
        "secret"  => false,       
        "duet"    => false        
    ]
],
        "registered" => true,
        "timestamp"  => round(microtime(true) * 1000),
        "fail"       => false
    ]);
	}
} else {
    echo json_encode([
        "success"    => false,
        "errorCode"  => null,
        "errorMsg"   => "Invalid username or password.",
        "errorTitle" => "Login error",
        "advItems"   => [],
        "result"     => null,
        "timestamp"  => round(microtime(true) * 1000),
        "fail"       => true
    ]);
}
?>