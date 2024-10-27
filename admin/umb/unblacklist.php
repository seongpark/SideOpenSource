<?php
date_default_timezone_set('Asia/Seoul');

include "../../db.php";
include "../../detectAccount.php";

if ($member["access"] == "2") {
    $idx = me($_GET["idx"]);

    mq("DELETE FROM umbrellaBlack WHERE writerIdx = '$idx'");

    alertRedirect("블랙리스트가 해제되었습니다.", "../umb.php");
}