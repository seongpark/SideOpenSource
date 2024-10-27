<?php
include "../db.php";
include "../detectAccount.php";

?>

    <!DOCTYPE html>
    <html lang="ko">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>사이드</title>
        <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
              integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <style>
            @import url(//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css);

            body {
                font-family: 'Spoqa Han Sans Neo', 'sans-serif' !important;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                height: 100vh;
            }

            .top-bar {
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 21.42px;
                padding-top: 16px;
                padding-bottom: 16px;
                border-radius: 0px 0px 20px 20px;
                background-color: #fff;
                position: relative;
            }

            .divide {
                height: 10px;
                width: 100%;
                background-color: #F2F2F2;
            }

            .content-container {
                display: flex;
                flex-direction: column;
                flex-grow: 1;
                overflow: hidden;
            }

            .title {
                height: 50px;
                border: none;
                border-radius: 0;
            }

            .content {
                border: none;
                border-radius: 0;
                flex-grow: 1;
                resize: none;
                overflow: auto;
            }

            .submit {
                padding: 5px;
                padding-left: 10px;
                padding-right: 10px;
                border-radius: 10px;
                background-color: #2e2e2e;
                color: #fff;
                font-size: 15px;
                position: absolute;
                right: 10px;
                border: none;
            }

            .back-arrow {
                position: absolute;
                left: 10px;
            }
        </style>
    </head>

    <body>
    <form action="" method="POST">
        <div class="top-bar">
            <a href="index.php" class="back-arrow" style="color: #000;"><i class="fa-solid fa-chevron-left"></i></a>
            <b>청원하기</b>
            <button type="submit" class="submit">등록</button>
        </div>
        <div class="divide"></div>
        <div class="content-container">
            <div class="mt-3 mb-3 container">
                <h5><b>M신저 청원 안내문</b></h5>
                <span>· 게시일로부터 14일 동안 100명 이상의 동의를 받은 추천 청원에 대해 강릉명륜고 학생자치회가 답하겠습니다.
                    <br>
                    · 비난성, 욕설 등의 부적절한 청원에 대해서 검토 후 내용이 수정되거나 삭제될 수 있으며 청원 동의 조건을 충족하더라도 답변이 거부될 수 있습니다.
                    <br>
                    · 만약 답변 되더라도 청원 내용을 모두 이행할 수 없거나 이행을 거부할 수 있습니다.
                </span>
            </div>
            <div class="divide"></div>
            <input type="text" class="form-control title" placeholder="제목" name="title" required>
            <div class="divide"></div>
            <textarea class="form-control content" placeholder="내용을 입력해주세요." name="content" required
                      style="height: 85vh;"></textarea>
        </div>
    </form>
    </body>

    </html>

<?php
date_default_timezone_set('Asia/Seoul');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = me($_POST['title']);
    $content = me($_POST['content']);
    $writer = $member["idx"];
    $date = date("Y-m-d");

    mq("INSERT INTO please (title, content, date, writer) VALUES ('$title', '$content', '$date', '$writer')");
    redirect("index.php");
}
?>