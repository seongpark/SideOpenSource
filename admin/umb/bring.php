<?php

include '../../db.php';
include '../../detectAccount.php';

if ($member["access"] == "2") {
    $idx = me($_GET["idx"]);

    mq("UPDATE umbrella SET status = 'bring' WHERE idx = '$idx'");

    $randomActiveRow = mq("SELECT idx FROM umbrellaList WHERE status = 'active' ORDER BY RAND() LIMIT 1");

    if ($randomActiveRow && mysqli_num_rows($randomActiveRow) > 0) {
        $row = mysqli_fetch_assoc($randomActiveRow);
        $umbrellaListIdx = $row['idx'];

        mq("UPDATE umbrellaList SET writerIdx = '{$member['idx']}', status = 'bring' WHERE idx = '$umbrellaListIdx'");
    }

    alertRedirect("수령 처리되었습니다.", "../umb.php");
}
