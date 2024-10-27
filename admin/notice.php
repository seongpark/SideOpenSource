<?php
include '../db.php';
include '../detectAccount.php';

if ($member["access"] == "2") {

    ?>
    <!DOCTYPE html>
    <html lang="ko">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>사이드 for Professional</title>
        <link
                rel="shortcut icon"
                type="image/png"
                href="../favicon.ico"
        />
        <link rel="stylesheet" href="assets/css/styles.min.css"/>
    </head>

    <body>
    <!--  Body Wrapper -->
    <div
            class="page-wrapper"
            id="main-wrapper"
            data-layout="vertical"
            data-navbarbg="skin6"
            data-sidebartype="full"
            data-sidebar-position="fixed"
            data-header-position="fixed"
    >
        <?php
        include "includeMenu.php";
        ?>
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->

            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">공지사항 쓰기</h5>
                            <p>공지사항을 작성하려면 <a href="https://notice.sideapp.kr">사이드 공지사항 티스토리
                                    블로그</a>의 글쓰기 권한을 받아야 합니다.
                            </p>
                            <a href="https://lifepluse2222.tistory.com/manage/newpost/?type=post&returnURL=%2Fmanage%2Fposts%2F"
                               class="btn btn-primary m-1">글쓰기</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="assets/js/dashboard.js"></script>
    </body>
    </html>


<?php } ?>
