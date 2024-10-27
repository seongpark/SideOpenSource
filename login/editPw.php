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
                    <a href="edit.php" class="description">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </span>
                <b>&nbsp;비밀번호 변경</b>
            </h2>

            <label for="exampleInputEmail1" class="form-label mt-2">새 비밀번호 입력</label>
            <input type="password" class="form-control" name="pw" minlength="8" placeholder="8자 이상">
            <button class="btn btn-dark mt-3" style="width: 100%;">완료</button>
        </form>

        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pw = me($_POST["pw"]);
            $hash_pw = password_hash($pw, PASSWORD_DEFAULT);
            $idx = $member["idx"];
        
            mq("UPDATE member SET pw='$hash_pw' WHERE idx='$idx'");
            alertRedirect("변경되었습니다.", "logout.php");
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>