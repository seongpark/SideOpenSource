<?php
date_default_timezone_set('Asia/Seoul');

include "../../db.php";
include "../../detectAccount.php";

if ($member["access"] == "2") {
    $idx = me($_GET["idx"]);

    mq("UPDATE umbrellaList SET status = 'active' WHERE idx = '$idx'");

    alertRedirect("처리되었습니다.", "../umb.php");
}