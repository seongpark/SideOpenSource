<?php

include '../../db.php';
include '../../detectAccount.php';

if ($member["access"] == "2") {
    $idx = me($_GET["idx"]);

    mq("DELETE FROM umbrella WHERE idx = '$idx'");

    mq("UPDATE umbrellaList SET status = 'active', writerIdx = NULL WHERE writerIdx = '{$member['idx']}'");

    alertRedirect("반납 처리되었습니다.", "../umb.php");
}
