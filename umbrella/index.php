<?php
include "../db.php";
include "../detectAccount.php";
date_default_timezone_set('Asia/Seoul');

$sql = mq("SELECT * FROM umbrellaBlack WHERE writerIdx = $member[idx]");
$loadBlock = false;
while ($black = $sql->fetch_array()) {
    $loadBlock = true;
}


$sqlUmbOpen = mq("SELECT * FROM umbrellaOpen");
$loadUmbOpen = false;
while ($umbOpen = $sqlUmbOpen->fetch_array()) {
    $loadUmbOpen = true;
}

if ($loadUmbOpen == true) {
    if ($loadBlock == true) {
        alertRedirect("대여가 제한되었습니다.", "../");
    } else {
        $sql = mq("SELECT * FROM umbrella WHERE writerIdx = '$member[idx]'");
        $umbrella = $sql->fetch_assoc();

        if (@$umbrella["status"] == "new") {
            redirect("wait.php");
        }
        if (@$umbrella["status"] == "bring") {
            redirect("bring.php");
        }
    }
} else {
    alertRedirect("현재 우산대여제 접수를 받지 않습니다.", "../");
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>사이드</title>
    <link rel="stylesheet" href="../assets/style.css?v=0828">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

    <meta name="description" content="당신의 학교 생활을 더 지혜롭게">
    <meta property="og:title" content="사이드">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://i.ibb.co/Qnf5Lmq/maskable-icon.png">
    <meta property="og:description" content="당신의 학교 생활을 더 지혜롭게">

    <meta name="apple-mobile-web-app-status-bar-style" content="white">
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
<div class="read-top-bar fixed-top container" style="background-color: #fff;">
    <div class="d-flex justify-content-between" style="align-items: center;" `>
        <div class="d-flex flex-row" style="align-items: center;">
            <div>
                    <span class="description" onclick="location.href='../'" style="cursor:pointer;">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
            </div>

            <div>
                <span style="font-size: 20px; margin-left: 5px;"><b>우산 대여</b></span>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 68px">

    <h2><b>비 올때 우산이 없어도 <br>
            걱정하지 말고 대여해보세요.</b></h2>
    <br>
    <center>
        <img src="icons.webp" alt="" width="250px;">
    </center>
    <br>
    <span class="description" style="font-size: 13px">· 우산대여제는 비가 내리는 날에만 진행됩니다.
    <br>· 만약 우산을 반납하지 않는다면 미반납 횟수만큼 우산 대여 횟수가 제한됩니다. </span>

    <div class="fixed-bottom bottom-btn container">
        <button type="button" class="btn btn-primary btn-lg mt-4" style="width: 100%;" data-bs-toggle="modal"
                data-bs-target="#exampleModal">대여하기
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">정말 우산을 대여하시겠습니까?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <a href="borrow.php" type="button" class="btn btn-primary" style="width: 100%;">신청하기</a>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width: 100%;">취소
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<div style="height:30px;"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>