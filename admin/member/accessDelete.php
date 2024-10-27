<?php

include '../../db.php';
include '../../detectAccount.php';

$idx = me($_GET["idx"]);

if ($member["idx"] !== $idx) {
    if ($member["access"] == "2") {
        mq("UPDATE member SET access = '1' WHERE idx = '$idx'");
        alertRedirect("관리자가 해제되었습니다.", "../member.php");
    }
} else {
    alertRedirect("본인의 권한을 해제할 수 없습니다.", "../member.php");
}