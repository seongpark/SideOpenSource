<?php
date_default_timezone_set('Asia/Seoul');

include "../../db.php";
include "../../detectAccount.php";

if ($member["access"] == "2") {
    mq("DELETE FROM umbrellaOpen");
    $webhookMessage = "우산대여제가 종료되었습니다.\n일자 : " . date("Y-m-d H:i:s");
    sendWebhook($webhookMessage);
    alertRedirect("우산대여제가 종료되었습니다.", "../umb.php");
}