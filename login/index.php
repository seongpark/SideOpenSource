<?php
@$url = $_GET['url'];
if (@$url == "") {
    $url = "../";
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>사이드</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>

    <meta name="description" content="당신의 학교 생활을 더 지혜롭게">
    <meta property="og:title" content="사이드">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://i.ibb.co/Qnf5Lmq/maskable-icon.png">
    <meta property="og:description" content="당신의 학교 생활을 더 지혜롭게">
</head>

<body>
<div class="container" style="margin-top: 50px;">
    <center>
        <img src="../assets/image/side_logo_b.svg" alt="" width="220px">
    </center>

    <form action="" method="POST">
        <input class="form-control form-control-lg mb-3 mt-5" type="email" name="email" placeholder="이메일">

        <input class="form-control form-control-lg mb-3" type="password" name="password" placeholder="비밀번호">
        <p id="statusInfo"></p>
        <button type="submit" class="btn btn-dark btn-lg mb-3" style="width:100%;">로그인</button>
    </form>

    <a href="join" class="description">회원가입</a><br>
    <a href="find" class="description">비밀번호 찾기</a>

    <?php
    include "../db.php";
    include "password.php";

    if (@$_COOKIE["email"] == "" || @$_COOKIE["pw"] == "") {
    } else {
        redirect("../");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = me($_POST["email"]);
        $pw = me($_POST["password"]);

        if ($email == "" || $pw == "") {
            echo "<script>document.getElementById('statusInfo').innerHTML = '아이디나 비밀번호를 입력해주세요.';</script>";
        } else {
            $sql = mq("select * from member where email='$email'");
            $member = $sql->fetch_array();
            @$hash_pw = $member['pw'];

            if (password_verify($pw, $hash_pw)) {
                if ($member["active"] == "0") {
                    echo "<script>document.getElementById('statusInfo').innerHTML = '가입하신 이메일로 인증 링크가 발송되었습니다. 인증 후 로그인 가능합니다. (만약 인증 메일이 도착하지 않는다면 스팸 메일함을 확인해주세요.)';</script>";
                } else {
                    setcookie("email", $email, time() + (10 * 365 * 24 * 60 * 60), "/"); // 10년 동안 유효
                    setcookie("pw", $hash_pw, time() + (10 * 365 * 24 * 60 * 60), "/"); // 10년 동안 유효
                    echo "<script>location.href='$url';</script>";
                }
            } else {
                echo "<script>document.getElementById('statusInfo').innerHTML = '아이디나 비밀번호를 다시 확인해주세요.';</script>";
            }
        }
    }
    ?>
</div>
<!-- 인앱브라우저 우회 -->
<script type='text/javascript' charset='UTF-8'>
    var inappdeny_exec_vanillajs = (callback) => {
        if (document.readyState !== 'loading') {
            callback();
        } else {
            document.addEventListener('DOMContentLoaded', callback);
        }
    }
    inappdeny_exec_vanillajs(() => {
        function copytoclipboard(val) {
            var t = document.createElement("textarea");
            document.body.appendChild(t);
            t.value = val;
            t.select();
            document.execCommand('copy');
            document.body.removeChild(t);
        }

        function inappbrowserout() {
            copytoclipboard(window.location.href);
            alert('URL주소가 복사되었습니다.\n\nSafari가 열리면 주소창을 길게 터치한 뒤, "붙여놓기 및 이동"를 누르면 정상적으로 이용하실 수 있습니다.');
            location.href = 'x-web-search://?';
        }

        var useragt = navigator.userAgent.toLowerCase();
        var target_url = location.href;

        if (useragt.match(/kakaotalk/i)) {
            location.href = 'kakaotalk://web/openExternal?url=' + encodeURIComponent(target_url);
        } else if (useragt.match(/line/i)) {
            if (target_url.indexOf('?') !== -1) {
                location.href = target_url + '&openExternalBrowser=1';
            } else {
                location.href = target_url + '?openExternalBrowser=1';
            }
        } else if (useragt.match(/inapp|naver|snapchat|wirtschaftswoche|thunderbird|instagram|everytimeapp|whatsApp|electron|wadiz|aliapp|zumapp|iphone(.*)whale|android(.*)whale|kakaostory|band|twitter|DaumApps|DaumDevice\/mobile|FB_IAB|FB4A|FBAN|FBIOS|FBSS|trill|SamsungBrowser\/[^1]/i)) {
            if (useragt.match(/iphone|ipad|ipod/i)) {
                var mobile = document.createElement('meta');
                mobile.name = 'viewport';
                mobile.content = "width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui";
                document.getElementsByTagName('head')[0].appendChild(mobile);
                var fonts = document.createElement('link');
                fonts.href = 'https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap';
                document.getElementsByTagName('head')[0].appendChild(fonts);
                document.body.innerHTML = "<style>body{margin:0;padding:0;font-family: 'Noto Sans KR', sans-serif;overflow: hidden;height: 100%;}</style><h2 style='padding-top:50px; text-align:center;font-family: 'Noto Sans KR', sans-serif;'>인앱브라우저 호환문제로 인해<br />Safari로 접속해야합니다.</h2><article style='text-align:center; font-size:17px; word-break:keep-all;color:#999;'>아래 버튼을 눌러 Safari를 실행해주세요<br />Safari가 열리면, 주소창을 길게 터치한 뒤,<br />'붙여놓기 및 이동'을 누르면<br />정상적으로 이용할 수 있습니다.<br /><br /><button onclick='inappbrowserout();' style='min-width:180px;margin-top:10px;height:54px;font-weight: 700;background-color:#31408E;color:#fff;border-radius: 4px;font-size:17px;border:0;'>Safari로 열기</button></article><img style='width:70%;margin:50px 15% 0 15%' src='https://tistory3.daumcdn.net/tistory/1893869/skin/images/inappbrowserout.jpeg' />";
            } else {
                location.href = 'intent://' + target_url.replace(/https?:\/\//i, '') + '#Intent;scheme=http;package=com.android.chrome;end';
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>
