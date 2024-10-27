<?php
    include "../db.php";
    include "password.php";
    include "../detectAccount.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>사이드</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container" style="margin-top: 20px;">
        <form action="" method="POST">

            <h2 style="align-items: center;">
                <span class="description" style="font-size: 20px;">
                    <a href="../menu" class="description">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </span>
                <b>&nbsp;계정 정보 변경</b>
            </h2>

            <label for="exampleInputEmail1" class="form-label mt-2">이메일 주소</label>
            <input type="email" class="form-control" value="<?= htmlentities($member["email"]); ?>" name="email">

            <label for="exampleInputEmail1" class="form-label mt-3">이름</label>
            <input type="text" class="form-control" value="<?= htmlentities($member["name"]); ?>" name="name">

            <label for="exampleInputEmail1" class="form-label mt-3">학년</label>
            <input type="number" class="form-control" value="<?= htmlentities($member["grade"]); ?>" name="grade">

            <label for="exampleInputEmail1" class="form-label mt-3">반</label>
            <input type="number" class="form-control" value="<?= htmlentities($member["class"]); ?>" name="class">

            <label for="exampleInputEmail1" class="form-label mt-3">번호</label>
            <input type="number" class="form-control" value="<?= htmlentities($member["number"]); ?>" name="number">

            <button class="btn btn-dark mt-3" style="width: 100%;">완료</button>

            <a class="btn btn-dark mt-3" style="width: 100%;" href="editPw.php">비밀번호 변경</a>
        </form>

        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = me($_POST["email"]);
            $name = me($_POST["name"]);
            $class = me($_POST["class"]);
            $grade = me($_POST["grade"]);
            $number = me($_POST["number"]);
            $idx = $member["idx"];
        
            mq("UPDATE member SET email='$email', name='$name', class='$class', grade='$grade', number='$number' WHERE idx='$idx'");
            alertRedirect("변경되었습니다.", "logout.php");
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>