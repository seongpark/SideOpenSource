<?php
include "db.php";
date_default_timezone_set('Asia/Seoul');

if (@$_COOKIE["email"] == "" || @$_COOKIE["pw"] == "") {
    redirect("login");
}

$email = me($_COOKIE['email']);
$pw = $_COOKIE['pw'];

$sql = mq("SELECT * FROM member WHERE email = '$email'");
$checkAccount = $sql->fetch_array();
if ($checkAccount === null || $checkAccount["pw"] !== $pw) {
    redirect("login/logout.php");
} else {
    // 멤버 정보 가져오기
    $member = $checkAccount;

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
        <link rel="stylesheet" href="assets/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
              integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <meta name="description" content="당신의 학교 생활을 더 지혜롭게">
        <meta property="og:title" content="사이드">
        <meta property="og:type" content="website">
        <meta property="og:image" content="https://i.ibb.co/Qnf5Lmq/maskable-icon.png">
        <meta property="og:description" content="당신의 학교 생활을 더 지혜롭게">

        <link rel="manifest" href="manifest.json">
        <link rel="apple-touch-icon" href="favicon.ico"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>

        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="사이드"/>

        <!-- splash -->
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
              href="assets/splash_screens/iPhone_15_Pro_Max__iPhone_15_Plus__iPhone_14_Pro_Max_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
              href="assets/splash_screens/iPhone_15_Pro__iPhone_15__iPhone_14_Pro_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
              href="assets/splash_screens/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
              href="assets/splash_screens/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
              href="assets/splash_screens/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
              href="assets/splash_screens/iPhone_11_Pro_Max__iPhone_XS_Max_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/iPhone_11__iPhone_XR_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
              href="assets/splash_screens/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/4__iPhone_SE__iPod_touch_5th_generation_and_later_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 1032px) and (device-height: 1376px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/13__iPad_Pro_M4_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/12.9__iPad_Pro_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 834px) and (device-height: 1210px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/11__iPad_Pro_M4_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/11__iPad_Pro__10.5__iPad_Pro_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/10.9__iPad_Air_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/10.5__iPad_Air_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/10.2__iPad_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
              href="assets/splash_screens/8.3__iPad_Mini_landscape.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
              href="assets/splash_screens/iPhone_15_Pro_Max__iPhone_15_Plus__iPhone_14_Pro_Max_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
              href="assets/splash_screens/iPhone_15_Pro__iPhone_15__iPhone_14_Pro_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
              href="assets/splash_screens/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
              href="assets/splash_screens/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
              href="assets/splash_screens/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
              href="assets/splash_screens/iPhone_11_Pro_Max__iPhone_XS_Max_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/iPhone_11__iPhone_XR_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
              href="assets/splash_screens/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/4__iPhone_SE__iPod_touch_5th_generation_and_later_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 1032px) and (device-height: 1376px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/13__iPad_Pro_M4_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/12.9__iPad_Pro_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 834px) and (device-height: 1210px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/11__iPad_Pro_M4_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/11__iPad_Pro__10.5__iPad_Pro_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/10.9__iPad_Air_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/10.5__iPad_Air_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/10.2__iPad_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_portrait.png">
        <link rel="apple-touch-startup-image"
              media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
              href="assets/splash_screens/8.3__iPad_Mini_portrait.png">
    </head>

    <body>

    <div class="top-bar fixed-top">
        <div class="d-flex justify-content-between container">
            <div>
                <img src="assets/image/side_logo_b.svg" height="18px" alt="" style="margin-bottom:5px;">
            </div>

            <div class="notification-icon" onclick="location.href='alert'">
                <i class="fa-solid fa-bell" style="font-size: 24px; color: #B2B9C0;"></i>

                <?php
                if ($member["alertRead"] == "1") {
                    ?>
                    <!-- 빨간 점 (알림 표시) -->
                    <span class="badgeNew"></span>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>

    <div class="container" style="margin-top:67px">

        <div class="card">
            <div class="card-body" style="padding: 8px;">
                <b>공지</b> &nbsp;
                <?php
                $rss_url = "https://notice.sideapp.kr/rss";
                $rss_content = file_get_contents($rss_url);

                if ($rss_content === FALSE) {
                    echo "RSS 피드를 불러올 수 없습니다.";
                    exit;
                }

                $rss_xml = simplexml_load_string($rss_content);

                if ($rss_xml === FALSE) {
                    echo "RSS 피드를 파싱할 수 없습니다.";
                    exit;
                }

                // 가장 최근 항목만 출력
                $latest_item = $rss_xml->channel->item[0];
                echo '<a href="' . $latest_item->link . '" class="black" style="text-decoration: none;">' . $latest_item->title . '</a><br>';
                ?>
            </div>
        </div>

        <div class="card" onclick="load(); location.href='dday'" style="cursor: pointer">
            <div class="card-body" style="padding: 8px;">
                <?php
                function calculateDday($date, $plus)
                {
                    $today = new DateTime();
                    $targetDate = new DateTime($date);
                    $interval = $today->diff($targetDate);

                    $days = $interval->days;

                    if ($plus == 1) {
                        $days += 1;
                    }

                    if ($interval->invert == 1) {
                        return "+" . $days;
                    } else {
                        return "-" . $days;
                    }
                }

                $load = false;
                $sql = mq("SELECT * FROM dday WHERE writer = '$member[idx]'");
                $total = $sql->num_rows; // 전체 항목 수를 계산
                $count = 0;

                while ($dday = $sql->fetch_assoc()) {
                    $count++;
                    $load = true;
                    ?>

                    <div class="d-flex justify-content-between">
                <span>
                    <img src="assets/image/cal.png" alt="" height="24px"> &nbsp;
                    <b>
                        <?= htmlentities($dday['title']) ?>
                    </b>
                    &nbsp;<span class="description"><?= htmlentities($dday['date']) ?></span>
                </span>

                        <span><b>D<?= calculateDday($dday['date'], $dday['plus']); ?></b></span>
                    </div>

                    <?php if ($count < $total) { ?>
                        <hr>
                    <?php } ?>

                <?php } ?>

                <?php
                if (!$load) {
                    echo "나만의 디데이를 추가해보세요!";
                }
                ?>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <h5>
                    <div class="d-flex justify-content-between">
                        <span><b>급식</b></span>
                        <span>
                        <a href="time/food.php" class="black"><i class="fa-solid fa-chevron-right"></i></a>
                    </span>
                </h5>
                <div style="height:5px;"></div>
                <span id="lunch-info" class="description">로딩 중...</span>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>
                    <div class="d-flex justify-content-between">
                        <span><b>시간표</b></span>
                        <span>
                        <a href="time/index.php" class="black"><i class="fa-solid fa-chevron-right"></i></a>
                        </span>
                    </div>
                </h5>
                <div style="height:5px;"></div>
                <div id="timetable-info" class="description">로딩 중...</div>
                <p class="description" style="font-size:12px; margin-bottom: 0; margin-top: 12px;">
                    <i class="fa-solid fa-circle-info"></i> &nbsp;선택 과목 등 일부 과목은 표시되지 않을 수
                    있습니다.
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div style="flex: 1;">
                        <center onclick="location.href='student?e_url=home'" style="cursor: pointer;">
                            <span class="tool-tip" style="color: #FA5858;">
                                <i class="fa-solid fa-id-card"></i>
                            </span>
                            <br>
                            <p style="margin-bottom: 0; font-size: 12px;">
                                <b>모바일 학생증</b>
                            </p>
                        </center>
                    </div>
                    <div style="flex: 1;">
                        <center onclick="location.href='notice?e_url=home'" style="cursor: pointer;">
                            <span class="tool-tip" style="color: #2E9AFE;">
                                <i class="fa-solid fa-bell"></i>
                            </span>
                            <br>
                            <p style="margin-bottom: 0; font-size: 12px;">
                                <b>명륜알림판</b>
                            </p>
                        </center>
                    </div>
                    <div style="flex: 1;">
                        <center onclick="location.href='https://grmr.gwe.hs.kr/main.do'" style="cursor: pointer;">
                            <span class="tool-tip" style="color: #04B486;">
                                <i class="fa-solid fa-earth-americas"></i>
                            </span>
                            <br>
                            <p style="margin-bottom: 0; font-size: 12px;">
                                <b>홈페이지</b>
                            </p>
                        </center>
                    </div>
                    <div style="flex: 1;">
                        <center onclick="location.href='umbrella'" style="cursor: pointer;">
                            <span class="tool-tip" style="color: #FE9A2E;">
                                <i class="fa-solid fa-umbrella"></i>
                            </span>
                            <br>
                            <p style="margin-bottom: 0; font-size: 12px;">
                                <b>우산대여</b>
                            </p>
                        </center>
                    </div>
                </div>
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
                    <center onclick="location.href='index.php'" style="cursor:pointer;">
                        <i class="icon active fa-solid fa-house"></i>
                        <br>
                        <span class="active description">홈</span>
                    </center>

                    <center onclick="load(); location.href='time'" style="cursor:pointer;">
                        <i class="icon fa-solid fa-utensils"></i>
                        <br>
                        <span class="description">시간/급식</span>
                    </center>

                    <center onclick="load(); location.href='messanger'" style="cursor:pointer;">
                        <i class="icon fa-solid fa-envelope-open"></i>
                        <br>
                        <span class="description">M신저</span>
                    </center>

                    <center onclick="load(); location.href='menu'" style="cursor:pointer;">
                        <i class="icon fa-solid fa-bars"></i>
                        <br>
                        <span class="description">메뉴</span>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <div class="tooltip-container">
        <div class="floating-box">
            <b>우산이 없어도 </b>걱정하지 말고 <b>우산대여제</b>!
        </div>
    </div>

    <div style="height: 150px;"></div>

    <div class="overlay">
        <div class="container">
            <div class="pwa-app">
                <div class="container">
                    <img src="favicon.ico" height="60px"
                         style="border-radius: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">

                    <h5 class="mt-4">홈화면에 <b>사이드 앱</b>을 추가하고<br>
                        더욱 편리하게 사용해보세요.</h5>

                    <a type="button" class="btn btn-dark btn-lg mt-3" href="pwa-install.html"
                       style="width: 100%; border-radius: 50px!important; box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px; font-size: 18px; padding: 15px">
                        <b>설치 없이 </b> 앱으로 열기
                    </a>

                    <div style="height:12px;"></div>
                    <a href="" class="description" style="font-size: 13px;" id="hideButton">24시간 동안 웹으로 사용하기</a>
                </div>
            </div>
        </div>
    </div>

    <!--
        <div class="adContainer">
            <div class="fixed-bottom ad_fixed_bottom">
                <div class="container d-flex flex-row-reverse">
                    <i class="fa-solid fa-xmark"
                       style="color: #fff; font-size: 30px; margin-bottom: 10px; margin-right: 15px;"></i>
                </div>
                <div class="ad container">
                </div>
                <div class="ad-off container">
                    <center>
                        <span><b>자세히 보기</b></span>
                    </center>
                </div>
            </div>
            -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
    <script src="assets/script.js"></script>
    <script type='text/javascript' charset='UTF-8' src="assets/outKakaoBroswer.js"></script>

    <!-- pwa -->
    <script src="pwabuilder-sw.js" type="module"></script>
    <script type="module">
        import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

        const el = document.createElement('pwa-update');
        document.body.appendChild(el);

        //서비스워커
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('pwabuilder-sw.js')
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
        let deferredPrompt

        window.addEventListener("beforeinstallprompt", event => {
            event.preventDefault()
            deferredPrompt = event
        })

        function load() {
            const div = document.querySelector('.loading-overlay');
            div.style.display = 'flex';
        }
    </script>


    </body>

    </html>
<?php } ?>