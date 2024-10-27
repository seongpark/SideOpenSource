<?php
date_default_timezone_set('Asia/Seoul');

include "../db.php";
include "../detectAccount.php";

$writerIdx = $member["idx"];

mq("DELETE FROM alert WHERE writerIdx = '$writerIdx'");
mq("UPDATE member SET alertRead = '0' WHERE idx = '$writerIdx'");

alertRedirect("모든 알림이 삭제되었습니다.", "index.php");