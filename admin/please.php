<?php
include '../db.php';
include '../detectAccount.php';

if ($member["access"] == "2") {

    $perPage = 30;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $perPage;

    $totalResult = mq("SELECT COUNT(*) as cnt FROM please");
    $totalRow = $totalResult->fetch_array();
    $totalCount = $totalRow['cnt'];
    $totalPages = ceil($totalCount / $perPage);

    $sql = mq("SELECT * FROM please LIMIT $offset, $perPage");
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
                            <h5 class="card-title fw-semibold mb-4">청원 관리</h5>
                            <div class="alert alert-primary mt-4" role="alert">
                                <i class="fa-solid fa-triangle-exclamation"></i> &nbsp;삭제를 누르는 즉시 실행되며 절대 취소할 수 없습니다.
                            </div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">번호</th>
                                    <th scope="col">제목</th>
                                    <th scope="col">작성일</th>
                                    <th scope="col">작성자</th>
                                    <th scope="col">동의수</th>
                                    <th scope="col">상태</th>
                                    <th scope="col">보기</th>
                                    <th scope="col">삭제</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($please = $sql->fetch_array()) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= htmlentities($please["idx"]) ?></th>
                                        <td><?= htmlentities($please["title"]) ?></td>
                                        <td><?= htmlentities($please["date"]) ?></td>
                                        <td><?php
                                            $writerSql = mq("SELECT * FROM member WHERE idx = '$please[writer]'");
                                            $writer = $writerSql->fetch_array();

                                            if (@$writer["name"] == "") {
                                                echo "계정이 없는 회원";
                                            } else {
                                                echo htmlentities($writer["name"]);
                                            }
                                            ?></td>
                                        <td><?= htmlentities($please["metoo"]) ?></td>
                                        <td><?php
                                            if (@$please["status"] == "1") {
                                                echo "진행중";
                                            }
                                            if (@$please["status"] == "2") {
                                                echo "답변 대기중";
                                            }
                                            if (@$please["status"] == "3") {
                                                echo "만료됨";
                                            }
                                            if (@$please["status"] == "4") {
                                                echo "답변 완료";
                                            }
                                            ?></td>
                                        <td>
                                            <a href="../messanger/read.php?idx=<?= htmlentities($please["idx"]) ?>">보기</a>
                                        </td>
                                        <td><a class="del"
                                               href="class/delete_messanger.php?idx=<?= htmlentities($please["idx"]) ?>">삭제</a>
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
