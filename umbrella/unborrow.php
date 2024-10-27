<?php
date_default_timezone_set('Asia/Seoul');

include "../db.php";
include "../detectAccount.php";

$writerIdx = $member["idx"];

mq("DELETE FROM umbrella WHERE writerIdx = '$writerIdx'");
alertRedirect("우산 대여 신청이 취소되었습니다.", "../");