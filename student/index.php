<?php
include "../db.php";
include "../detectAccount.php";

$enterUrl = "../";
if (@$_GET["e_url"] == "") {
    $enterUrl = "../";
} else {
    if ($_GET["e_url"] == "menu") {
        $enterUrl = "../menu";
    }
}

$memberIdx = $member["idx"];
$sql_barcode = mq("SELECT * FROM student WHERE writer='$memberIdx'");
$load = false;

while ($barcode = $sql_barcode->fetch_array()) {
    $load = true;
}

if ($load == true) {
    redirect("barcode.php?back=$enterUrl");
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
    </style>
</head>

<body>
<div class="read-top-bar fixed-top container" style="background-color: #fff;">
    <div class="d-flex justify-content-between" style="align-items: center;" `>
        <div class="d-flex flex-row" style="align-items: center;">
            <div>
                    <span class="description" onclick="location.href='<?= $enterUrl; ?>'" style="cursor:pointer;">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
            </div>

            <div>
                <span style="font-size: 20px; margin-left: 5px;"><b>모바일 학생증</b></span>
            </div>
        </div>
    </div>

    <h4 class="mt-3 mb-3">새 학생증을 등록합니다.</h4>
    <p>학생증 바코드 아래 적혀있는 7자리 코드를 입력해주세요.</p>
    <img src="../assets/image/student_exam.png" width="100%">

    <form action="" method="POST">
        <input type="text" class="form-control mt-3" placeholder="바코드 입력" name="barcode">
        <button type="submit" style="width:100%" class="btn btn-dark mt-3">완료</button>
    </form>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $barcode = $_POST["barcode"];
    mq("INSERT INTO student (barcode, writer) VALUES ('$barcode', '$memberIdx')");
    redirect("barcode.php");
}
?>
<div style="height:100px;"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>