<?php

include '../../db.php';
include '../../detectAccount.php';

if ($member["access"] == "2") {
    $idx = me($_GET["idx"]);
    mq("DELETE FROM please WHERE idx = '$idx'");
    alertRedirect("삭제되었습니다.", "../please.php");
}