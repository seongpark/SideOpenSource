<?php
date_default_timezone_set('Asia/Seoul');

include "../db.php";
include "../detectAccount.php";

// 우산 대여 가능 여부 확인
$umbrellaStatusCheck = mq("SELECT COUNT(*) as count FROM umbrellaList WHERE status = 'active'");
$umbrellaStatus = $umbrellaStatusCheck->fetch_assoc();

if ($umbrellaStatus['count'] > 0) {
    // 우산이 남아있을 경우 대여 처리
    $writerIdx = $member["idx"];
    $date = date("Y-m-d");

    mq("INSERT INTO umbrella (writerIdx, date) VALUES ('$writerIdx', '$date')");

    alertRedirect("우산 대여 신청이 완료되었습니다. 방과후 학생자치회실에 방문하여 우산을 수령하시기 바랍니다.", "wait.php");
    alertSend("우산대여제", $member["idx"], "방과후 15분 내로 학생자치회실에 방문하여 우산을 수령해주세요.", "../umbrella");

    // 웹훅 메시지 전송
    $webhookMessage = "우산 대여를 신청했습니다.\n신청자 : " . htmlentities($member["name"]) . " (" . $member["grade"] . "학년 " . $member["class"] . "반)";
    sendWebhook($webhookMessage);
} else {
    // 우산이 없을 경우
    alertRedirect("우산 대여가 마감되었습니다. 다음 기회에 이용해 주세요.", "index.php");
}
?>
