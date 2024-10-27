<?php
include "../db.php";
include "../detectAccount.php";

//상품 총갯수 넘는거 방지
$query = "SHOW COLUMNS FROM lucky";
$result = $db->query($query);
$columnCount = $result->num_rows;
if ($columnCount > 30) {
    alertRedirect("종료된 이벤트입니다.", "../");
}

//재참여 방지
$loadLucky = mq("SELECT * FROM lucky WHERE member='$member[idx]'");
$loadLuckyOk = false;
while ($lucky = $loadLucky->fetch_assoc()) {
    $loadLuckyOk = true;
}

if ($loadLuckyOk == true) {
    alertRedirect("이미 참여한 이벤트 입니다.", "../");
} else {
    function win()
    {
        global $member;
        sendWebhook("사이드 이벤트 - 당첨되었습니다.\n$member[grade] 학년 $member[class] 반 $member[name]");
        alertSend("이벤트", $member["idx"], "당첨되셨습니다. 학생자치회실로 방문하여 상품을 수령해주세요.", "../");
    }

//신규회원 구분하여 확률 높히기
    if ($member["idx"] > 141) {
        //신규회원
        $randomNumber = rand(1, 4);
        if ($randomNumber == 3) {
            $lucky = true;
            win();
            mq("INSERT INTO lucky (member, result) VALUES ('$member[idx]', '1')");
        } else {
            $lucky = false;
            mq("INSERT INTO lucky (member, result) VALUES ('$member[idx]', '2')");
        }
    } else {
        //기존회원
        $newMember = false;
        $randomNumber = rand(1, 5);
        if ($randomNumber == 3) {
            $lucky = true;
            win();
            mq("INSERT INTO lucky (member, result) VALUES ('$member[idx]', '1')");
        } else {
            $lucky = false;
            mq("INSERT INTO lucky (member, result) VALUES ('$member[idx]', '2')");
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="ko">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>사이드</title>
        <link rel="stylesheet" href="../assets/style.css">
        <link rel="stylesheet" href="lucky.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
              integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

        <meta name="description" content="당신의 학교 생활을 더 지혜롭게">
        <meta property="og:title" content="사이드">
        <meta property="og:type" content="website">
        <meta property="og:image" content="https://i.ibb.co/Qnf5Lmq/maskable-icon.png">
        <meta property="og:description" content="당신의 학교 생활을 더 지혜롭게">

        <style>
            body {
                background-color: #fff !important;
            }

            a {
                text-decoration: none;
                color: black;
            }

            .nav {
                background-color: #fff;
            }
        </style>
    </head>
    <body>

    <center>
        <div class="container" style="margin-top: 124px">
            <div id="slotMachine">
                <div id="slot1">🎰</div>
                <div id="slot2">🎰</div>
                <div id="slot3">🎰</div>
            </div>
            <div id="result">3개의 그림이 같으면 당첨이에요!</div>
        </div>

        <div class="fixed-bottom bottom-btn container">
            <button type="button" class="btn btn-primary btn-lg mt-4 mb-2" id="lets" style="width: 100%;"
                    onclick="spin()">
                지금 상품 뽑기
            </button>
            <span id="warning" style="color: gray; font-size: 10px;">만약 여기서 나간다면 <b>이벤트 참여를 포기한 것으로 간주</b>되고 다시 참여할 수 없어요.</span>
        </div>
    </center>

    <?php
    //당첨/미당첨 js
    if (!$lucky) {
        echo '<script src="spinl.js"></script>';
    } else {
        echo '<script src="spinw.js"></script>';
    }
    ?>
    </body>
    </html>
<?php } ?>