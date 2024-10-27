<?php
include "../db.php";
include "../detectAccount.php";

$memberIdx = $member["idx"];
$sql_barcode = mq("SELECT * FROM student WHERE writer='$memberIdx'");
$load = false;

while ($barcode = $sql_barcode->fetch_array()) {
    $load = true;
    $barcodeMember = $barcode["barcode"];
}

if ($load == false) {
    redirect("index.php");
}
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
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

    <meta name="description" content="당신의 학교 생활을 더 지혜롭게">
    <meta property="og:title" content="사이드">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://i.ibb.co/Qnf5Lmq/maskable-icon.png">
    <meta property="og:description" content="당신의 학교 생활을 더 지혜롭게">

    <style>
        body {
            background-color: #fff !important;
        }

        .card {
            background-color: #F0F2F8;
        }

        .barcode-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70px;
        }
    </style>
</head>

<body>
<div class="read-top-bar fixed-top container" style="background-color: #fff;">
    <div class="d-flex justify-content-between" style="align-items: center;" `>
        <div class="d-flex flex-row" style="align-items: center;">
            <div>
                    <span class="description" onclick="location.href='<?= $_GET["back"]; ?>'" style="cursor:pointer;">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
            </div>

            <div>
                <span style="font-size: 20px; margin-left: 5px;"><b>모바일 학생증</b></span>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h3><b><?= htmlentities($member["name"]); ?></b></h3>
            <span>강릉명륜고등학교 <?= htmlentities($member["grade"]); ?>학년 <?= htmlentities($member["class"]); ?>반</span>

            <center>
                <div id="bcTarget2" style="margin-top:30px; margin-bottom:30px;"></div>
            </center>

            <p style="font-size: 14px; margin-bottom: 0">ⓒ 강릉명륜고등학교 학생자치회</p>
        </div>
    </div>

    <span class="description" style="font-size: 13px;">
        위변조 방지를 위해 오직 학생증 바코드를 잘못 입력한 경우에만 수정을 허용하고 있습니다. 만약 잘못 입력하였다면 <a href="https://open.kakao.com/me/sidehelp"
                                                                          class="description">사이드 운영지원</a>으로 문의하시기 바랍니다.
    </span>
</div>
<div style="height:100px;"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="jquery-barcode.js"></script>

<script>
    $("#bcTarget2").barcode("<?php echo htmlentities($barcodeMember); ?>", "code128", {
        barWidth: 3,
        barHeight: 70,
        showHRI: true,
        bgColor: "#F0F2F8"
    });
</script>
</body>

</html>