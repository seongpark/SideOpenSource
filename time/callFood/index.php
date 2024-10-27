<?php
include '../../db.php';
?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>사이드 급식 호출</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h2><b>사이드 급식 호출</b></h2>
    <p><span style="color: red"><b>해당 링크가 외부로 유출되지 않도록 유의</b></span>하시기 바랍니다.</p>

    <form action="" method="POST">
        <span class="mt-4">학년</span>
        <input class="form-control form-control-lg mt-2 mb-3" type="number" placeholder="학년" name="grade">

        <span class="mt-4">반</span>
        <input class="form-control form-control-lg mt-2" type="number" placeholder="반" name="class">

        <button type="submit" class="btn btn-primary btn-lg mt-3" style="width: 100%">호출하기</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $grade = me($_POST["grade"]);
        $class = me($_POST["class"]);
        $date = date('Y-m-d');

        $sql = "INSERT INTO foodClass (grade, class, date) VALUES ('$grade', '$class', '$date')";
        if ($db->query($sql) === TRUE) {
            echo "<script>alert('호출되었습니다.');</script>";
        } else {
            echo "<script>alert('다시 시도해주세요.');</script>";
        }
    }
    ?>
</div>


</body>
</html>