<?php
include "../db.php";
include "../detectAccount.php";

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
                <span style="font-size: 20px; margin-left: 5px;"><b>알림</b></span>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 68px">

    <?php
    $sql = mq("SELECT * FROM alert WHERE writerIdx = '$member[idx]' ORDER BY idx DESC");
    while ($alert = $sql->fetch_array()) {
        ?>
        <div class="alarm" style="margin-top: 20px; cursor: pointer"
             onclick="location.href='<?= htmlentities($alert['link']) ?>'">
            <div class="d-flex justify-content-between" style="color:#B2B9C0; font-size: 13px; margin-bottom: 3px;">
                <div>
                    <?= htmlentities($alert['category']) ?>
                </div>
                <div>
                    <?= htmlentities(timeAgo($alert['date'])) ?>
                </div>
            </div>

            <span style="font-size: 18px;"><?= htmlentities($alert['content']) ?></span>
        </div>
    <?php } ?>

    <div class="fixed-bottom">
        <div class="d-flex flex-row-reverse">
            <div class="write-btn_low_margin" style="cursor: pointer" onclick="location.href='delete.php'">
                <i class="fa-solid fa-trash"></i>
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