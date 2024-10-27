<?php
date_default_timezone_set('Asia/Seoul');

include "../../db.php";
include "../../detectAccount.php";

if ($member["access"] == "2") {
    $idx = me($_GET["idx"]);

    mq("INSERT INTO umbrellaBlack (writerIdx) VALUES ('$idx')");

    alertRedirect("블랙리스트로 설정되었습니다.", "../umb.php");
}