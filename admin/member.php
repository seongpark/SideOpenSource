<?php
include '../db.php';
include '../detectAccount.php';

if ($member["access"] == "2") {

    $perPage = 30;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $perPage;

    $totalResult = mq("SELECT COUNT(*) as cnt FROM member");
    $totalRow = $totalResult->fetch_array();
    $totalCount = $totalRow['cnt'];
    $totalPages = ceil($totalCount / $perPage);

    $sql = mq("SELECT * FROM member LIMIT $offset, $perPage");
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
                            <h5 class="card-title fw-semibold mb-4">권한 관리</h5>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">번호</th>
                                    <th scope="col">이름</th>
                                    <th scope="col">학년</th>
                                    <th scope="col">반</th>
                                    <th scope="col">번</th>
                                    <th scope="col">권한</th>
                                    <th scope="col">관리자 설정</th>
                                    <th scope="col">관리자 해제</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($please = $sql->fetch_array()) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?= htmlentities($please["idx"]) ?></th>
                                        <td><?= htmlentities($please["name"]) ?></td>
                                        <td><?= htmlentities($please["grade"]) ?></td>
                                        <td><?= htmlentities($please["class"]) ?></td>
                                        <td><?= htmlentities($please["number"]) ?></td>
                                        <td><?php
                                            if (@$please["access"] == "1") {
                                                echo "학생";
                                            }
                                            if (@$please["access"] == "2") {
                                                echo "관리자";
                                            }
                                            ?></td>
                                        <td><a href="member/accessOk.php?idx=<?= htmlentities($please["idx"]) ?>">설정</a>
                                        </td>
                                        <td><a class="del"
                                               href="member/accessDelete.php?idx=<?= htmlentities($please["idx"]) ?>">해제</a>
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
