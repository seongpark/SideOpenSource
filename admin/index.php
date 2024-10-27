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
            <div class="container-fluid">

                <h2><b>안녕하세요,
                        <?= htmlentities($member["name"]) ?>님</b></h2>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <b>  <?php
                                $sql = "SELECT COUNT(*) as total FROM member";
                                $result = $db->query($sql);

                                // 결과 확인
                                if ($result->num_rows > 0) {
                                    // 결과를 배열로 변환
                                    $row = $result->fetch_assoc();
                                    echo $row['total'];
                                }
                                ?>명</b>

                        </h5>
                        <p class="card-text">현재 회원 수</p>
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