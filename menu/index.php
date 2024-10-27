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
    <link rel="stylesheet" href="../assets/style.css?ver=0929">
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
        .list-menu {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .list-icon {
            height: 40px;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background-color: #222222;
            border-radius: 10px;
            margin-right: 10px;
            text-align: center;
        }

        .info {
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 18px;
            padding-right: 18px;
            background-color: #fff;
            border-radius: 15px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="container" style="margin-top:25px;">
    <div class="d-flex flex-row mb-2" style="align-items: center;">
        <div>
                <span style="font-size: 25px;">
                    <b><?= htmlentities($member["name"]); ?></b>
                </span>
            <br>
            <p class="description" style="margin-bottom: 0; font-size: 15px;">
                <?= htmlentities($member["email"]); ?>
            </p>
        </div>

    </div>

    <div class="info mt-4 mb-3" onclick="location.href='../login/edit.php'">
        <div class="d-flex justify-content-between" style="align-items: center;">
            <div>
                <b>강릉명륜고등학교</b><br>
                <?= htmlentities($member["grade"]); ?>학년 <?= htmlentities($member["class"]); ?>반
                <?= htmlentities($member["number"]); ?>번
            </div>

            <div>
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </div>
    </div>


    <div class="list-menu d-flex justify-content-between" onclick="load(); location.href='../student?e_url=menu'"
         style="align-items: center;">
        <div class="d-flex" style="align-items: center; cursor:pointer;">
            <div class="list-icon">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                <span>모바일 학생증</span>
            </div>
        </div>
        <div>
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>

    <div class="list-menu d-flex justify-content-between" style="align-items: center; cursor:pointer;"
         onclick="load(); location.href='../time'">
        <div class="d-flex" style="align-items: center; cursor:pointer;">
            <div class="list-icon">
                <i class="fa-solid fa-utensils"></i>
            </div>
            <span>시간/급식</span>
        </div>
        <i class="fa-solid fa-chevron-right"></i>
    </div>

    <div class="list-menu d-flex justify-content-between" style="align-items: center; cursor:pointer;"
         onclick="load(); location.href='../messanger'">
        <div class="d-flex" style="align-items: center; cursor:pointer;">
            <div class="list-icon">
                <i class="fa-solid fa-envelope-open"></i>
            </div>
            <span>M신저</span>
        </div>
        <i class="fa-solid fa-chevron-right"></i>
    </div>

    <div class="list-menu d-flex justify-content-between" style="align-items: center; cursor:pointer;"
         onclick="load(); location.href='../notice?e_url=menu'">
        <div class="d-flex" style="align-items: center; cursor:pointer;">
            <div class="list-icon">
                <i class="fa-solid fa-bell"></i>
            </div>
            <span>명륜알림판</span>
        </div>
        <i class="fa-solid fa-chevron-right"></i>
    </div>

    <center>
        <hr>
    </center>

    <?php
    if ($member["access"] == "2") {
        ?>
        <div class="list-menu d-flex justify-content-between" style="align-items: center; cursor:pointer;"
             onclick="load(); location.href='../admin'">
            <div class="d-flex" style="align-items: center; cursor:pointer;">
                <div class="list-icon">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
                <span>관리</span>
            </div>
            <i class="fa-solid fa-chevron-right"></i>
        </div>
        <?php
    }
    ?>

    <div class="list-menu d-flex justify-content-between" style="align-items: center; cursor:pointer;"
         onclick="location.href='https://oopseong.notion.site/70381dc19ebb4f35bc069e452d654e1d'">
        <div class="d-flex" style="align-items: center; cursor:pointer;">
            <div class="list-icon">
                <i class="fa-solid fa-headset"></i>
            </div>
            <span>사이드 운영지원센터</span>
        </div>
        <i class="fa-solid fa-chevron-right"></i>
    </div>

    <div class="list-menu d-flex justify-content-between" style="align-items: center; cursor:pointer;"
         onclick="location.href='../term/privacy.html'">
        <div class="d-flex" style="align-items: center; cursor:pointer;">
            <div class="list-icon">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <span>개인정보처리방침</span>
        </div>
        <i class="fa-solid fa-chevron-right"></i>
    </div>

    <div class="list-menu d-flex justify-content-between" style="align-items: center; cursor:pointer;"
         onclick="location.href='../term/term.html'">
        <div class="d-flex" style="align-items: center; cursor:pointer;">
            <div class="list-icon">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <span>이용약관</span>
        </div>
        <i class="fa-solid fa-chevron-right"></i>
    </div>
</div>

<center class="mt-4">
    <a class="description" style="text-decoration:none;" href="../login/logout.php">
        로그아웃
    </a>
</center>

<div style="height:30px;" onclick="location.href='https://www.youtube.com/@QWER_Band_official'"></div>
<div style="height:100px;"></div>

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
                    <span class=" description">시간/급식</span>
                </center>

                <center onclick="load(); location.href='../messanger'" style="cursor:pointer;">
                    <i class="icon fa-solid fa-envelope-open"></i>
                    <br>
                    <span class="description">M신저</span>
                </center>

                <center onclick="load(); location.href='../menu'" style="cursor:pointer;">
                    <i class="icon active fa-solid fa-bars"></i>
                    <br>
                    <span class="description active">메뉴</span>
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
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>