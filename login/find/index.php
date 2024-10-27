<?php
include "../../db.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>사이드</title>
    <link rel="stylesheet" href="../style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body>
<div class="container" style="margin-top: 20px;">
    <form action="" method="POST">
        <h5><b>가입한 이메일을 입력해주세요.</b></h5>
        <input type="email" class="form-control mt-3" name="email" required>
        <button class="btn btn-dark mt-3" style="width: 100%;">완료</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = me($_POST["email"]);
        $code = bin2hex(random_bytes(16 / 2));

        mq("INSERT INTO pwOTP (code, writer) VALUES ('$code', '$email')");
        $body = '<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 찾기</title>
    <link rel="stylesheet" href="../email.css" >
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>비밀번호 재설정 안내</h1>
        </div>
        <div class="content">
            <p>비밀번호 재설정을 요청하셨습니다. 아래 버튼을 클릭하여 새로운 비밀번호를 설정해 주세요.</p>
            <p>이 요청을 본인이 하지 않은 경우, 이 이메일을 무시하셔도 됩니다.</p>
            <a href="https://' . $_SERVER['HTTP_HOST'] . '/login/find/change.php?code=' . $code . '" class="button">비밀번호 재설정</a>
            <p>감사합니다.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 사이드. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
';
        sendEmail($email, "비밀번호 찾기", "[사이드] 비밀번호 재설정 안내", $body, "");

        alertRedirect("비밀번호 찾기 이메일이 발송되었습니다.", "../");
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>