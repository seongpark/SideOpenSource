<?php
include '../db.php';
include '../detectAccount.php';

if ($member["access"] == "2") {

    // 검색 파라미터 설정
    $searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';
    $searchStatus = isset($_GET['searchStatus']) ? $_GET['searchStatus'] : '';

    $perPage = 30;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $perPage;

    // 총 카운트 계산 (검색 필터 적용)
    $sqlCount = "SELECT COUNT(*) as cnt FROM umbrella u 
                 LEFT JOIN member m ON u.writerIdx = m.idx 
                 WHERE 1=1";

    if ($searchName != '') {
        $sqlCount .= " AND m.name LIKE '%$searchName%'";
    }

    if ($searchStatus != '') {
        $sqlCount .= " AND u.status = '$searchStatus'";
    }

    $totalResult = mq($sqlCount);
    $totalRow = $totalResult->fetch_array();
    $totalCount = $totalRow['cnt'];
    $totalPages = ceil($totalCount / $perPage);

    // 실제 데이터 조회 쿼리
    $sql = "SELECT u.*, m.name, m.grade, m.class FROM umbrella u 
            LEFT JOIN member m ON u.writerIdx = m.idx 
            WHERE 1=1";

    if ($searchName != '') {
        $sql .= " AND m.name LIKE '%$searchName%'";
    }

    if ($searchStatus != '') {
        $sql .= " AND u.status = '$searchStatus'";
    }

    $sql .= " LIMIT $offset, $perPage";
    $sqlResult = mq($sql);
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
                            <h5 class="card-title fw-semibold mb-4">우산대여제 관리</h5>


                            <div class="alert alert-primary mt-3" role="alert">
                                <b>남은 우산 수량</b>
                                <?php
                                $sql = mq("SELECT COUNT(*) as total_count FROM umbrellaList WHERE status != 'bring' AND status != 'broken'");
                                $totalResult = $sql->fetch_assoc();
                                echo $totalResult["total_count"];
                                ?>개

                                (대여중 :
                                <?php
                                $sql = mq("SELECT COUNT(*) as total_count FROM umbrellaList WHERE status = 'bring'");
                                $totalResult = $sql->fetch_assoc();
                                echo $totalResult["total_count"];
                                ?>개 |

                                사용 불가 :
                                <?php
                                $sql = mq("SELECT COUNT(*) as total_count FROM umbrellaList WHERE status = 'broken'");
                                $totalResult = $sql->fetch_assoc();
                                echo $totalResult["total_count"];
                                ?>개)
                            </div>

                            <?php
                            $sqlUmbOpen = mq("SELECT * FROM umbrellaOpen");
                            $loadUmbOpen = false;

                            while ($umbOpen = $sqlUmbOpen->fetch_array()) {
                                $loadUmbOpen = true;
                            }

                            if (!$loadUmbOpen) {
                                echo '<a href="umb/start.php" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">우산대여제 접수시작</a>';
                            } else {
                                echo '<a href="umb/stop.php" class="btn btn-dark"  data-bs-toggle="modal" data-bs-target="#end">우산대여제 접수종료</a>';
                            }
                            ?>
                            &nbsp;
                            <!-- Button trigger modal -->
                            <a type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#listumb">
                                우산 관리
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="listumb" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">우산 관리</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">번호</th>
                                                    <th scope="col">파손</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $sql = mq("SELECT * FROM umbrellaList");
                                                while ($umb = $sql->fetch_assoc()) {
                                                    ?>

                                                    <tr>
                                                        <th scope="row"><?= htmlentities($umb["num"]); ?></th>
                                                        <td>
                                                            <?php
                                                            $sqlBroken = mq("SELECT * FROM umbrellaList WHERE idx='$umb[idx]'");
                                                            $broken = $sqlBroken->fetch_assoc();
                                                            if ($broken["status"] == "broken") {
                                                                ?>
                                                                <a href="umb/unbroken.php?idx=<?= $broken["idx"] ?>">해제</a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="umb/broken.php?idx=<?= $broken["idx"] ?>">설정</a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 모달들 -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">우산대여제 시작하기</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            우산대여 신청 접수를 시작합니다.
                                        </div>
                                        <div class="modal-footer">
                                            <a href="umb/start.php" type="button" class="btn btn-danger"
                                               style="width: 100%;">시작하기</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="end" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">우산대여제 종료하기</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            우산대여 신청 접수를 마감합니다.
                                        </div>
                                        <div class="modal-footer">
                                            <a href="umb/stop.php" type="button" class="btn btn-danger"
                                               style="width: 100%;">종료하기</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- 검색 폼 -->
                            <form method="GET" class="mb-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" name="searchName" class="form-control" placeholder="이름 검색"
                                               value="<?= htmlentities($searchName) ?>">
                                    </div>
                                    <div class="col-auto">
                                        <select name="searchStatus" class="form-select">
                                            <option value="">상태 선택</option>
                                            <option value="new" <?= $searchStatus == 'new' ? 'selected' : '' ?>>
                                                신청(미수령)
                                            </option>
                                            <option value="bring" <?= $searchStatus == 'bring' ? 'selected' : '' ?>>
                                                대여중(수령)
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-auto" style="width: 100px;">
                                        <button type="submit" class="btn btn-primary">검색</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <!-- 테이블 -->
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">번호</th>
                                    <th scope="col">대여자</th>
                                    <th scope="col">상태</th>
                                    <th scope="col">대여일</th>
                                    <th scope="col">우산</th>
                                    <th scope="col">수령</th>
                                    <th scope="col">대여제한</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($please = $sqlResult->fetch_array()) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= htmlentities($please["idx"]) ?></th>
                                        <td><?php
                                            $writerName = htmlentities($please["name"]);
                                            $writerGrade = htmlentities($please["grade"]);
                                            $writerClass = htmlentities($please["class"]);
                                            echo "$writerName" . " (" . $writerGrade . "학년 " . $writerClass . "반)";
                                            ?></td>
                                        <td><?php
                                            if ($please["status"] == "new") {
                                                echo "신청(미수령)";
                                            } else if ($please["status"] == "bring") {
                                                echo "대여중(수령)";
                                            }
                                            ?></td>
                                        <td><?= htmlentities($please["date"]) ?></td>
                                        <td>
                                            <?php
                                            $loadUmbListOk = false;
                                            $loadUmbList = mq("SELECT * FROM umbrellaList WHERE writerIdx = '$please[writerIdx]'");
                                            while ($umbList = $loadUmbList->fetch_assoc()) {
                                                echo $umbList["num"];
                                                $loadUmbListOk = true;
                                            }

                                            if (!$loadUmbListOk) {
                                                echo "미배정";
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            $bringLoad = false;

                                            $idx = $please['writerIdx'];
                                            $sqlLoadbatch = mq("SELECT * FROM umbrella WHERE writerIdx = '$idx' AND status='bring'");

                                            while ($bringLd = $sqlLoadbatch->fetch_assoc()) {
                                                $bringLoad = true;
                                            }

                                            if (!$bringLoad) {
                                                ?>
                                                <a href="umb/bring.php?idx=<?= htmlentities($please['idx']) ?>">자동배정</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="umb/delete.php?idx=<?= htmlentities($please['idx']) ?>">반납</a>
                                                <?php
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            $blackLoad = false;
                                            $sqlBlock = mq("SELECT * FROM umbrellaBlack WHERE writerIdx = '$member[idx]'");
                                            while ($black = $sqlBlock->fetch_assoc()) {
                                                $blackLoad = true;
                                            }

                                            if (!$blackLoad) {
                                                ?>
                                                <a class="del"
                                                   href="umb/blacklist.php?idx=<?= htmlentities($please["writerIdx"]) ?>">설정</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="del"
                                                   href="umb/unblacklist.php?idx=<?= htmlentities($please["writerIdx"]) ?>">해제</a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($page < $totalPages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
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
