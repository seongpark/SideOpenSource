<?php 
    include "../db.php";
    include "../detectAccount.php";

    $idx = me($_GET["idx"]);
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
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

    <style>
    body {
        background-color: #fff !important;
    }

    .wrap {
        padding: 10px;
        background-color: #F0F2F8;
        border-radius: 10px;
        padding-left: 15px;
    }

    .progress {
        height: 10px;
        border-radius: 50px;
    }

    .progress-bar {
        background-color: #222222;
    }
    </style>
</head>

<body>
    <?php 
        $pleaseSql = mq("SELECT * FROM please WHERE idx='$idx'");
        $please = $pleaseSql->fetch_array();
    ?>
    <div class="read-top-bar fixed-top container" style="background-color: #fff;">
        <div class="d-flex justify-content-between" style="align-items: center;" `>
            <div class="d-flex flex-row" style="align-items: center;">
                <div>
                    <span class="description" onclick="history.back();" style="cursor:pointer;">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
                </div>

                <div>
                    <span style="font-size: 20px; margin-left: 5px;"><b>청원</b></span>
                </div>
            </div>
            <?php 
                if($please["writer"] == $member["idx"]) {
            ?>
            <div class="dropdown">
                <a class="description" href="#" style="font-size: 20px;" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"> </i>
                </a>
                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="delete.php?idx=<?= $please["idx"]; ?>"><i
                                class="fa-solid fa-trash-can"></i> &nbsp;글
                            삭제</a></li>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php 

        /*status
            1 - 진행중
            2 - 답변 대기중
            3 - 만료됨
            4 - 답변 완료
        */
        $endDate = (new DateTime($please["date"]))->modify('+14 days')->format('Y-m-d');

        if($please["status"] !== "4") {
            if($please["metoo"] >= 100) {
                mq("UPDATE please SET status='2' WHERE idx='$idx'");
            }
            if($please["metoo"] < 100) {
                mq("UPDATE please SET status='1' WHERE idx='$idx'");
            }
    
            if($endDate < date('Y-m-d')) {
                mq("UPDATE please SET status='3' WHERE idx='$idx'");
            }
        }
    ?>
    <div class="container" style="margin-top: 66px;">
        <h4><?= htmlentities($please["title"]); ?></h4>

        <div class="wrap mt-3 mb-2"><b>동의기간</b></div>
        <span><?= htmlentities($please["date"]); ?> -
            <span><b><?php echo $endDate; ?></b></span>
        </span><br>
        <span class="description">(청원 등록 후 14일 이내)</span>

        <div class="wrap mt-3 mb-2"><b>동의수</b></div>
        <span><i class="fa-solid fa-user"></i>
            &nbsp;<?= htmlentities($please["metoo"]); ?>명 / 100명
            (<?= $percentage = ($please["metoo"] / 100) * 100; ?>%)
        </span>
        <div class="progress mt-2" role="progressbar">
            <div class="progress-bar" style="width: <?= $percentage = ($please["metoo"] / 100) * 100; ?>%">
            </div>
        </div>

        <div class="wrap mt-3 mb-2"><b>청원 내용</b></div>
        <?= nl2br($please["content"]); ?>

        <?php 
        if($please["status"] == "4") {
        ?>
        <div class="wrap mt-3 mb-2"><b>답변</b></div>
        <?= nl2br($please["answer"]); ?>
        <?php } ?>

        <br>
        <?php 
        if($please["status"] == "1" || $please["status"] == "2") {
        ?>
        <a type="button" class="btn btn-dark mt-3" style="width: 100%;"
            href="ok.php?idx=<?= htmlentities($please["idx"]); ?>"><i class="fa-solid fa-user-check"></i>
            &nbsp;동의하기</a>
        <?php } 
        
        if($please["status"] == "3") {
        ?>
        <a type="button" class="btn btn-dark mt-3 disabled" style="width: 100%;"><i class="fa-solid fa-user-check"></i>
            &nbsp;종료된 청원입니다.</a>
        <?php } 
        
        if($member["access"] == "2") {
            if($please["status"] !== "2") {
        ?>
        <a type="button" class="btn btn-dark mt-3" style="width: 100%;" data-bs-toggle="modal"
            data-bs-target="#exampleModal"><i class="fa-solid fa-pencil"></i>
            &nbsp;답변 등록하기</a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">답변 등록하기</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="answer.php?idx=<?= $idx; ?>">
                            <textarea name="answer-content" class="form-control" placeholder="내용 입력..."></textarea>
                            <button type="submit" class="btn btn-dark mt-3" style="width: 100%;">
                                &nbsp;등록하기</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>

    <div style="height:100px;"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>