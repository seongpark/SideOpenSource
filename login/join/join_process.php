<?php
include "../../db.php";
include "../password.php";

$name = me($_POST['name']);
$email = me($_POST['email']);
$pw = me($_POST['pw']);
$hash_pw = password_hash($pw, PASSWORD_DEFAULT);
$grade = me($_POST['grade']);
$class = me($_POST['class']);
$number = me($_POST['number']);
$code = "x";

// 이메일 중복 확인
$checkEmailQuery = "SELECT * FROM member WHERE email = '$email'";
$result = mq($checkEmailQuery);

if (mysqli_num_rows($result) > 0) {
    alertRedirect("이미 사용 중인 이메일입니다. 다른 이메일을 사용해 주세요.", "../");
} else {
    // 회원가입 처리
    mq("INSERT INTO member (name, email, grade, class, number, code, pw) VALUES ('$name', '$email', '$grade', '$class', '$number', '$code', '$hash_pw')");
    alertRedirect("회원가입이 완료되었습니다. 이메일 인증 후 로그인 가능합니다. (만약 이메일이 도착하지 않는다면 스팸함을 확인해주세요!)", "../");

    $body = '<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>이메일 인증</title>
    <link rel="stylesheet" href="../email.css" >
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>이메일 인증 안내</h1>
        </div>
        <div class="content">
            <p>안녕하세요!</p>
            <p>사이드에 가입해 주셔서 감사합니다.</p>
            <p>아래 버튼을 클릭하여 이메일 주소를 인증해 주세요. 이메일 인증을 완료해야 로그인이 가능합니다.</p>
            <a href="https://' . $_SERVER['HTTP_HOST'] . "/login/active.php?code=" . $hash_pw . '" class="button">이메일 인증</a>
            <br>
            <p>이 요청을 본인이 하지 않은 경우, 이 이메일을 무시하셔도 됩니다.</p>
            <p>감사합니다.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 사이드. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
';
    sendEmail($email, $name, "[사이드] 이메일을 인증해주세요.", $body, $altBody);

    //웹훅
    $webhook_url = "https://discord.com/api/webhooks/1282910233529810965/K72v58dsfGQ_wO-mZNOsS_6Prc7jmlIr8fpOWXlmGVOtBJw55ShyDZ6qbGSjWm8HEbj0";
    $message = "새로운 회원이 가입했습니다!\n가입자 : " . $grade . "학년 " . $class . "반 " . $name;

    $data = json_encode([
        "content" => $message
    ]);

    $ch = curl_init($webhook_url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_close($ch);

    $response = curl_exec($ch);
}