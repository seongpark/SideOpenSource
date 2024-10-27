<?php
include "../db.php";
include "../detectAccount.php";

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

    <meta name="apple-mobile-web-app-status-bar-style" content="white">

    <style>
        body {
            background-color: #fff !important;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .nav {
            background-color: #fff;
        }
    </style>
</head>

<body>
<div class="read-top-bar fixed-top container" style="background-color: #fff;">
    <div class="d-flex justify-content-between" style="align-items: center;" `>
        <div class="d-flex flex-row" style="align-items: center;">
            <div>
                    <span class="description" onclick="location.href='index.php'" style="cursor:pointer;">
                        <i class="fa-solid fa-chevron-left"></i>
                    </span>
            </div>

            <div>
                <span style="font-size: 20px; margin-left: 5px;"><b>디데이 추가</b></span>
            </div>
        </div>
    </div>
</div>

<div style="margin-top: 62px">
    <form action="" method="post">
        <div class="container">
            <label for="exampleInputEmail1" class="form-label">디데이 제목</label>
        </div>
        <input class="form-control form-control-lg form-radius-0" type="text" placeholder="디데이 제목을 입력해주세요."
               name="title">

        <div class="container">
            <label for="exampleInputEmail1" class="form-label mt-3" name="date">날짜</label>
        </div>
        <input class="form-control form-control-lg form-radius-0" type="date" name="date">

        <div class="container mt-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="plus1">
                <label class="form-check-label" for="flexSwitchCheckDefault">설정일로부터 1일로 세기</label>
            </div>
        </div>

        <div class="container">
            <button type="submit" class="btn btn-dark mt-3 btn-lg" style="width: 100%;">완료</button>
        </div>
    </form>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = me($_POST["title"]);
    $date = me($_POST["date"]);

    if (isset($_POST['plus1'])) {
        $plus = "1";
    } else {
        $plus = "0";
    }

    mq("INSERT INTO dday (title, date, writer, plus) VALUES ('$title', '$date', '$member[idx]', $plus)");
    redirect("index.php");
}
?>
<div style="height:30px;"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>

</html>