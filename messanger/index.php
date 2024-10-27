<?php
include "../db.php";
include "../detectAccount.php";

$pageProgress = isset($_GET['page_progress']) ? (int)$_GET['page_progress'] : 1;
$pagePending = isset($_GET['page_pending']) ? (int)$_GET['page_pending'] : 1;
$pageAnswered = isset($_GET['page_answered']) ? (int)$_GET['page_answered'] : 1;

$perPage = 5;
$offsetProgress = ($pageProgress - 1) * $perPage;
$offsetPending = ($pagePending - 1) * $perPage;
$offsetAnswered = ($pageAnswered - 1) * $perPage;

if (@$_GET["status"] == "") {
    $status = "processing";
} else {
    $status = $_GET["status"];
}

if ($status == "processing") {
    $loadStatus = "1";
}
if ($status == "waiting") {
    $loadStatus = "2";
}
if ($status == "end") {
    $loadStatus = "4";
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>사이드</title>
    <link rel="stylesheet" href="../assets/style.css?ver=0929">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
</head>

<body>

<nav class="nav nav-pills nav-justified" style="margin-top: 2px;">
    <a class="nav-link <?php if ($status == "processing") {
        echo "active";
    } else {
        echo "disable";
    } ?>" aria-current="page" href="index.php?status=processing">진행중</a>
    <a class="nav-link <?php if ($status == "waiting") {
        echo "active";
    } else {
        echo "disable";
    } ?>" href="index.php?status=waiting">대기중</a>
    <a class="nav-link <?php if ($status == "end") {
        echo "active";
    } else {
        echo "disable";
    } ?>" href="index.php?status=end">완료됨</a>
</nav>

<div class="container mt-3">

    <?php
    $totalSqlProgress = mq("SELECT COUNT(*) as total FROM please WHERE status='$loadStatus'");
    $totalResultProgress = $totalSqlProgress->fetch_assoc();
    $totalItemsProgress = $totalResultProgress['total'];
    $totalPagesProgress = ceil($totalItemsProgress / $perPage);

    $pleaseSqlProgress = mq("SELECT * FROM please WHERE status='$loadStatus' ORDER BY metoo DESC LIMIT $offsetProgress, $perPage");
    $loadpleaseSqlProgress = false;

    while ($please = $pleaseSqlProgress->fetch_array()) {
        $loadpleaseSqlProgress = true;
        ?>
        <div class="card card-low-padding"
             onclick="location.href='read.php?idx=<?= htmlentities($please['idx']); ?>'">
            <div class="card-body">
                <h6><?= htmlentities($please["title"]); ?></h6>

                <div class="d-flex justify-content-between">
                    <p style="margin-bottom:0; font-size:14px;"><i class="fa-solid fa-user"></i>
                        &nbsp;<?= htmlentities($please["metoo"]); ?>명
                        (<?= $percentage = ($please["metoo"] / 100) * 100; ?>%)
                    </p>
                    <p style="margin-bottom:0; font-size:14px;"><i class="fa-solid fa-calendar"></i>
                        &nbsp;D-<?= ceil((strtotime($please["date"] . ' +13 days') - time()) / 86400); ?></p>
                </div>
                <div class="progress" role="progressbar" style="margin-top:6px;">
                    <div class="progress-bar" style="width: <?= $percentage = ($please["metoo"] / 100) * 100; ?>%">
                    </div>
                </div>
            </div>
        </div>
        <div style="height:6px;"></div>

    <?php }
    if ($loadpleaseSqlProgress == false) {
        ?>
        <center>
            <div style="height:30px;"></div>
            <span class="description">
            불러올 청원이 없습니다.
        </span>
        </center>
        <?php
    }
    ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php if ($pageProgress > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page_progress=<?= $pageProgress - 1 ?>&status=<?= $status; ?>"
                       aria-label="Previous">
                        <span aria-hidden="true"><i class="fa-solid fa-angles-left"></i></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php
            $start = max(1, $pageProgress - 1);
            $end = min($totalPagesProgress, $pageProgress + 1);

            if ($start > 1):
                ?>
                <li class="page-item">
                    <a class="page-link" href="?page_progress=1&status=<?= $status; ?>">1</a>
                </li>
                <?php if ($start > 2): ?>
                <li class="page-item">
                    <span class="page-link">...</span>
                </li>
            <?php endif; endif; ?>

            <?php for ($i = $start; $i <= $end; $i++): ?>
                <li class="page-item <?= ($i == $pageProgress) ? 'active' : '' ?>">
                    <a class="page-link" href="?page_progress=<?= $i ?>&status=<?= $status; ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($end < $totalPagesProgress):
                if ($end < $totalPagesProgress - 1): ?>
                    <li class="page-item">
                        <span class="page-link">...</span>
                    </li>
                <?php endif; ?>
                <li class="page-item">
                    <a class="page-link"
                       href="?page_progress=<?= $totalPagesProgress ?>&status=<?= $status; ?>"><?= $totalPagesProgress ?></a>
                </li>
            <?php endif; ?>

            <?php if ($pageProgress < $totalPagesProgress): ?>
                <li class="page-item">
                    <a class="page-link" href="?page_progress=<?= $pageProgress + 1 ?>&status=<?= $status; ?>"
                       aria-label="Next">
                        <span aria-hidden="true"><i class="fa-solid fa-angles-right"></i></span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<div style="height:100px;"></div>

<div class="fixed-bottom">
    <div class="d-flex flex-row-reverse">
        <div class="write-btn" style="cursor: pointer" onclick="location.href='write.php'">
            <i class="fa-solid fa-plus"></i>
        </div>
    </div>
</div>

<div class="loading-overlay">
    <div class="spinner"></div>
</div>

<div class="fixed-bottom">
    <div class="menu">
        <div class="container">
            <div class="d-flex justify-content-around">
                <center onclick="load(); location.href='../index.php'" style="cursor:pointer;">
                    <i class="icon fa-solid fa-house"></i>
                    <br>
                    <span class="description">홈</span>
                </center>

                <center onclick="load(); location.href='../time'" style="cursor:pointer;">
                    <i class="icon fa-solid fa-utensils"></i>
                    <br>
                    <span class="description">시간/급식</span>
                </center>

                <center onclick="load(); location.href='../messanger'" style="cursor:pointer;">
                    <i class="icon active fa-solid fa-envelope-open"></i>
                    <br>
                    <span class="description active">M신저</span>
                </center>

                <center onclick="load(); location.href='../menu'" style="cursor:pointer;">
                    <i class="icon fa-solid fa-bars"></i>
                    <br>
                    <span class="description">메뉴</span>
                </center>
            </div>
        </div>
    </div>
</div>

<!-- pwa -->
<script src="../pwabuilder-sw.js" type="module"></script>
<script type="module">
    import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

    const el = document.createElement('pwa-update');
    document.body.appendChild(el);

    //서비스워커
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('../pwabuilder-sw.js')
                .then(registration => {
                    console.log('Service Worker registered with scope:', registration.scope);
                })
                .catch(error => {
                    console.log('Service Worker registration failed:', error);
                });
        });
    }
</script>

<script>
    function load() {
        const div = document.querySelector('.loading-overlay');
        div.style.display = 'flex';
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-8E9jSC40eGOCQxLzFCHJtsHe6pAQYH/tndNYs2Jwktz/B01TcbJwFCSFJLU6gOBr" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
        integrity="sha512-ozqNYbBgl3+aSBixQ3tEXW1lzF9Io4axX9Dmd30EE0Owm3Nf3OnCOFhGzt8FD9QkCwhFb7LKmUM2zzLr4gDRLw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>