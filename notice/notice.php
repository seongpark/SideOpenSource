<?php
include "../db.php";
include "../detectAccount.php";

$enterUrl = "../";

if (@$_GET["e_url"] == "") {
    $enterUrl = "../";
} else {
    if ($_GET["e_url"] == "menu") {
        $enterUrl = "../menu";
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
                    <span class="description" onclick="location.href='<?= $enterUrl ?>'" style="cursor:pointer;">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
            </div>

            <div>
                <span style="font-size: 20px; margin-left: 5px;"><b>명륜알림판</b></span>
            </div>
        </div>
    </div>
</div>

<nav class="nav nav-pills nav-justified fixed-top" style="margin-top: 50px;">
    <a class="nav-link disable" aria-current="page" href="index.php?e_url=<?= $_GET["e_url"] ?>">가정통신문</a>
    <a class="nav-link active" href="notice.php?e_url=<?= $_GET["e_url"] ?>">공지사항</a>
</nav>
<div class="container" style="margin-top: 124px">
    <?php
    $rssUrl = 'https://grmr.gwe.hs.kr/grmr/0202/board/20560/rss.do';
    $rss = simplexml_load_file($rssUrl);

    foreach ($rss->channel->item as $item) {
        echo '<a href="' . $item->link . '">' . $item->title . '</a><hr>';
    }
    ?>
</div>


</div>
<div style="height:30px;"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>