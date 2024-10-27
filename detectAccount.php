<?php
//preload
date_default_timezone_set('Asia/Seoul');

$nowUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (@$_COOKIE["email"] == "" || @$_COOKIE["pw"] == "") {
    redirect("/login?url=" . $nowUrl);
}

$email = me($_COOKIE['email']);
$pw = $_COOKIE['pw'];

$sql = mq("SELECT * FROM member WHERE email = '$email'");
$checkAccount = $sql->fetch_array();

if ($checkAccount === null || $checkAccount["pw"] !== $pw) {
    redirect("../login/logout.php");
}

$member = $checkAccount;

$divide = $member["grade"] . "g" . $member["class"];

function sendWebhook($message)
{
    $webhook_url = "";

    $data = json_encode([
        "content" => $message
    ]);

    $ch = curl_init($webhook_url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_close($ch);

    $response = curl_exec($ch);
}

function alertSend($category, $writerIdx, $content, $link)
{
    $date = date("Y-m-d H:i:s");
    mq("INSERT INTO alert (category, writerIdx, content, link, date) VALUES ('$category', '$writerIdx', '$content', '$link', '$date')");
    mq("UPDATE member SET alertRead = '1' WHERE idx = '$writerIdx'");
}

function timeAgo($dateTime)
{
    $timestamp = strtotime($dateTime);
    $currentTime = time();
    $timeDifference = $currentTime - $timestamp;

    $secondsInMinute = 60;
    $secondsInHour = 60 * $secondsInMinute;
    $secondsInDay = 24 * $secondsInHour;
    $secondsInWeek = 7 * $secondsInDay;
    $secondsInMonth = 30 * $secondsInDay;
    $secondsInYear = 365 * $secondsInDay;

    if ($timeDifference < $secondsInMinute) {
        return '방금 전';
    } elseif ($timeDifference < $secondsInHour) {
        $minutes = floor($timeDifference / $secondsInMinute);
        return $minutes . '분 전';
    } elseif ($timeDifference < $secondsInDay) {
        $hours = floor($timeDifference / $secondsInHour);
        return $hours . '시간 전';
    } elseif ($timeDifference < $secondsInWeek) {
        $days = floor($timeDifference / $secondsInDay);
        return $days . '일 전';
    } elseif ($timeDifference < $secondsInMonth) {
        $weeks = floor($timeDifference / $secondsInWeek);
        return $weeks . '주 전';
    } elseif ($timeDifference < $secondsInYear) {
        $months = floor($timeDifference / $secondsInMonth);
        return $months . '달 전';
    } else {
        $years = floor($timeDifference / $secondsInYear);
        return $years . '년 전';
    }
}

?>