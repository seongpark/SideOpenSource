<?php
header('Content-Type: application/json');
include "../db.php";
include "../detectAccount.php";
date_default_timezone_set('Asia/Seoul');

$ATPT_OFCDC_SC_CODE = 'K10';
$SD_SCHUL_CODE = '7801093';
$API_KEY = 'c2a4b8fcdab24f92aaea45e7a1fa4512';

function fetchTimetable($date)
{
    global $member;
    global $ATPT_OFCDC_SC_CODE;
    global $SD_SCHUL_CODE;
    global $API_KEY;

    $GRADE = $member["grade"];
    $CLASS_NM = $member["class"];
    $ALL_TI_YMD = $date;

    $dayOfWeek = date('N', strtotime($date));

    $apiUrl = "https://open.neis.go.kr/hub/hisTimetable?ATPT_OFCDC_SC_CODE={$ATPT_OFCDC_SC_CODE}&SD_SCHUL_CODE={$SD_SCHUL_CODE}&GRADE={$GRADE}&CLASS_NM={$CLASS_NM}&ALL_TI_YMD={$ALL_TI_YMD}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $xml = new SimpleXMLElement($response);
    $rows = $xml->xpath("//row");

    $data = [];

    if ($dayOfWeek < 6) {
        $max_period = ($dayOfWeek == 2 || $dayOfWeek == 4) ? 7 : 6; // 화/목은 7교시, 나머지는 6교시
        $current_period = 1;

        foreach ($rows as $row) {
            $time = (int)$row->PERIO;

            while ($current_period < $time) {
                $data[] = [
                    'time' => $current_period,
                    'className' => '선택과목(탐구/교양/고전/기하)'
                ];
                $current_period++;
            }

            $data[] = [
                'time' => $time,
                'className' => (string)$row->ITRT_CNTNT
            ];
            $current_period++;
        }

        while ($current_period <= $max_period) {
            $data[] = [
                'time' => $current_period,
                'className' => '선택과목(탐구/교양/고전/기하)'
            ];
            $current_period++;
        }
    } else {
        foreach ($rows as $row) {
            $data[] = [
                'time' => (string)$row->PERIO,
                'className' => (string)$row->ITRT_CNTNT
            ];
        }
    }

    return $data;
}

$date = $_GET['date'] ?? date('Ymd');
$timetable = fetchTimetable($date);
echo json_encode($timetable);
?>
