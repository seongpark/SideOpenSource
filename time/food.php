<?php
include "../db.php";
include "../detectAccount.php";

$ATPT_OFCDC_SC_CODE = 'K10';
$SD_SCHUL_CODE = '7801093';
$API_KEY = 'c2a4b8fcdab24f92aaea45e7a1fa4512';
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

    <link rel="manifest" href="../manifest.json">
    <link rel="apple-touch-icon" href="../favicon.ico"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="사이드"/>
</head>

<body>

<div class="gradient-top fixed-top"></div>

<nav class="nav nav-pills nav-justified" style="margin-top:2px;">
    <a class="nav-link disable" aria-current="page" href="index.php">시간표</a>
    <a class="nav-link active" href="food.php">급식표</a>
</nav>

<div class="container" style="margin-top:18px;">
    <?php
    if (@$_GET['date'] == '') {
        $loadDate = date('Ymd');
    } else {
        $loadDate = $_GET['date'];
    }
    ?>
    <div class="d-flex justify-content-between" style="margin-bottom:21px;">
        <a href="?date=<?= date('Ymd', strtotime('-1 day', strtotime($loadDate))); ?>" class="black"><i
                    class="fa-solid fa-chevron-left"></i></a>
        <div>
            <?php
            echo str_replace(
                array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
                array('월', '화', '수', '목', '금', '토', '일'),
                DateTime::createFromFormat('Ymd', $loadDate)->format('n월 j일 (l)')
            );
            ?>

            <a class="black" type="button" data-bs-toggle="collapse"
               data-bs-target="#collapseWidthExample" aria-expanded="false"
               aria-controls="collapseWidthExample">
                <i class="fa-solid fa-chevron-down"></i>
            </a>
            <div class="collapse collapse-horizontal" id="collapseWidthExample">
                <div class="card card-body mt-2" style="width: 300px;">
                    <form method="get" action="">
                        <input type="date" name="date" class="form-control"
                               value="<?= isset($_GET['date']) ? htmlspecialchars($_GET['date']) : ''; ?>" required>
                        <input type="hidden" name="formatted_date">
                        <button class="btn btn-primary mt-2" type="submit" style="width: 100%;">조회</button>
                    </form>
                </div>
            </div>
        </div>
        <a href="?date=<?= date('Ymd', strtotime('+1 day', strtotime($loadDate))); ?>"" class=" black"><i
                class="fa-solid fa-chevron-right"></i></a>
    </div>
    <div class="card card-low-padding">
        <div class="card-body" id="meal-content">
            로딩 중...
        </div>
    </div>

    <div class="card card-low-padding">
        <div class="card-body">
            <h5><b>급식 순서</b></h5>
            <div style="height:5px;"></div>
            3 <i class="fa-solid fa-arrow-right"></i> 2 <i class="fa-solid fa-arrow-right"></i> 1학년 <br>
            7 <i class="fa-solid fa-arrow-right"></i> 6 <i class="fa-solid fa-arrow-right"></i> 5 <i
                    class="fa-solid fa-arrow-right"></i> 4 <i class="fa-solid fa-arrow-right"></i> 3 <i
                    class="fa-solid fa-arrow-right"></i> 2 <i class="fa-solid fa-arrow-right"></i> 1반
            <div style="height:5px;"></div>
            <p class="description" style="margin-bottom: 0; font-size: 10px;"><i class="fa-solid fa-circle-info"></i>
                &nbsp;2024.10 업데이트</p>
        </div>
    </div>

</div>


<div style="height:100px;"></div>

<div class="loading-overlay">
    <div class="spinner"></div>
</div>

<div class="fixed-bottom">
    <div class="menu">
        <div class="container">
            <div class="d-flex justify-content-around">
                <center onclick="location.href='../index.php'" style="cursor:pointer;">
                    <i class="icon fa-solid fa-house"></i>
                    <br>
                    <span class="description">홈</span>
                </center>
                <center onclick="location.href='../time'" style="cursor:pointer;">
                    <i class="icon active fa-solid fa-utensils"></i>
                    <br>
                    <span class="active description">시간/급식</span>
                </center>

                <center onclick="location.href='../messanger'" style="cursor:pointer;">
                    <i class="icon fa-solid fa-envelope-open"></i>
                    <br>
                    <span class="description">M신저</span>
                </center>

                <center onclick="location.href='../menu'" style="cursor:pointer;">
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
    function convertDateFormat(event) {
        event.preventDefault();

        const dateInput = document.querySelector('input[name="date"]');
        const dateValue = dateInput.value;

        if (dateValue) {
            const [year, month, day] = dateValue.split('-');
            const formattedDate = `${year}${month}${day}`;

            const url = new URL(window.location.href);
            url.searchParams.set('date', formattedDate);

            window.location.href = url.toString();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form');
        form.addEventListener('submit', convertDateFormat);
    });

    document.addEventListener('DOMContentLoaded', () => {
        const date = new URLSearchParams(window.location.search).get('date') || '<?= $loadDate ?>';
        fetch(`foodApi.php?date=${date}`)
            .then(response => response.json())
            .then(data => {
                const contentDiv = document.getElementById('meal-content');
                if (data.length === 0) {
                    contentDiv.innerHTML = "등록된 급식 정보가 없습니다.";
                } else {
                    contentDiv.innerHTML = `
                        <b>중식</b><br>
                        ${data.filter((_, index) => index % 2 === 0).join('<br>')}
                        <hr>
                                <b>석식</b><br>
                                ${data.filter((_, index) => index % 2 !== 0).join('<br>')}

                    `;
                }
            })
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>