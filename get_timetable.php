<?php
date_default_timezone_set('Asia/Seoul');
include "db.php";

$email = $_COOKIE['email'];
$sql = mq("SELECT * FROM member WHERE email = '$email'");
$checkAccount = $sql->fetch_array();

$ATPT_OFCDC_SC_CODE = 'K10';
$SD_SCHUL_CODE = '7801093';

$GRADE = $checkAccount["grade"];
$CLASS_NM = $checkAccount["class"];
$ALL_TI_YMD = date("Ymd");

$dayOfWeek = date('N'); // 1 (월요일)부터 7 (일요일)까지의 숫자를 반환

$apiUrl = "https://open.neis.go.kr/hub/hisTimetable?ATPT_OFCDC_SC_CODE={$ATPT_OFCDC_SC_CODE}&SD_SCHUL_CODE={$SD_SCHUL_CODE}&GRADE={$GRADE}&CLASS_NM={$CLASS_NM}&ALL_TI_YMD={$ALL_TI_YMD}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);
$xml = new SimpleXMLElement($response);
$rows = $xml->xpath("//row");

$max_period = ($dayOfWeek == 2 || $dayOfWeek == 4) ? 7 : 6; // 화/목은 최대 7교시
$current_period = 1;

if (empty($rows)) {
    echo "<span class='description'>수업이 없는 날입니다.</span>";
} else {
    echo "<div class='timetable-wrapper'>";

    if ($dayOfWeek < 6) { // 평일(월요일~금요일)
        foreach ($rows as $row) {
            $time = (int)$row->PERIO;

            while ($current_period < $time) {
                echo "<div class='time'>
                        <center>
                            <span class='time-table'>{$current_period}</span>
                            <br>
                            <span class='main'>선택과목</span>
                        </center>
                      </div>";
                $current_period++;
            }

            $className = $row->ITRT_CNTNT;
            echo "<div class='time'>
                    <center>
                        <span class='time-table'>{$time}</span>
                        <br>
                        <span class='main'>{$className}</span>
                    </center>
                  </div>";
            $current_period++;
        }

        while ($current_period <= $max_period) {
            echo "<div class='time'>
                    <center>
                        <span class='time-table'>{$current_period}</span>
                        <br>
                        <span class='main'>선택과목</span>
                    </center>
                  </div>";
            $current_period++;
        }
    } else { // 토요일 또는 일요일
        foreach ($rows as $row) {
            $time = (int)$row->PERIO;
            $className = $row->ITRT_CNTNT;
            echo "<div class='time'>
                    <center>
                        <span class='time-table'>{$time}</span>
                        <br>
                        <span class='main'>{$className}</span>
                    </center>
                  </div>";
        }
    }

    echo "</div>";
}
?>

<style>
    .timetable-wrapper {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        flex-wrap: nowrap;
    }

    .time {
        margin: 0 5px;
        width: 150px;
        font-size: 14px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
</style>
