<?php

include '../../db.php';
include '../../detectAccount.php';

if ($member["access"] == "2") {
    $idx = me($_GET["idx"]);

    mq("UPDATE member SET access = '2' WHERE idx = '$idx'");
    alertRedirect("관리자로 설정되었습니다.", "../member.php");
}