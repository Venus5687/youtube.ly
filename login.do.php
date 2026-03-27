<?php

        header('Content-Type: application/json');
        echo json_encode([
            "success" => true, "errorCode" => null, "errorMsg" => null, "errorTitle" => null,
            "advItems" => [], "result" => [
                "admin" => false, "bid" => "0", "blocked" => false, "commentsNum" => 0,
                "complimented" => false, "disabled" => false, "email" => "email@example.com",
                "emailVerified" => false, "fansNum" => 0, "featuredScope" => 0,
                "featuredTime" => 1754538451000, "followList" => [], "followNum" => 0,
                "followed" => false, "following" => false, "gender" => "m",
                "handle" => "placeholder", "handleModified" => 1754538451000,
                "icon" => null, "inCn" => false, "password" => "123456", "instagramID" => null, "introduction" => null,
                "likesNum" => 0, "musicalLikedNum" => 0, "musicalNum" => 0,
                "musicalReadNum" => 0, "name" => "placeholder", "nickName" => "placeholder",
                "phone" => null, "postNotify" => false, "readNum" => 0, "realName" => null,
                "sociaMediaList" => [], "subscribeList" => [],
                "userDesc" => "live with passion, live musical.ly", "userId" => 0,
                "userRequestDTO" => ["follow" => false],
                "userSettingDTO" => [
                    "directAccount" => null, "duet" => false, "hideLocation" => false,
                    "policyVersion" => 1, "privateChat" => false, "secret" => false, "userId" => 0
                ],
                "verified" => false
            ],
            "registered" => false, "timestamp" => 1754538451000, "fail" => false
        ]);
?>