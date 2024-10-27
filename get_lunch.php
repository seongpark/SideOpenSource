<?php
include "db.php";
date_default_timezone_set('Asia/Seoul');

$ATPT_OFCDC_SC_CODE = 'K10';
$SD_SCHUL_CODE = '7801093';
$API_KEY = 'c2a4b8fcdab24f92aaea45e7a1fa4512';

function lunchExport($date)
{
    global $ATPT_OFCDC_SC_CODE;
    global $SD_SCHUL_CODE;
    global $API_KEY;

    $apiUrl = "https://open.neis.go.kr/hub/mealServiceDietInfo?ATPT_OFCDC_SC_CODE={$ATPT_OFCDC_SC_CODE}&SD_SCHUL_CODE={$SD_SCHUL_CODE}&MLSV_YMD={$date}&KEY={$API_KEY}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    $xml = new SimpleXMLElement($response);
    $rows = $xml->xpath("//row");

    if (count($rows) === 0) {
        $mealName = "등록된 급식 정보가 없습니다.";
    } else {
        $mealNames = [];
        foreach ($rows as $row) {
            $mealName = (string)$row->DDISH_NM;
            $mealName = preg_replace('/[^\p{Hangul}<>br]+/u', '', $mealName);
            $mealNames[] = $mealName;
        }

        @$mealName = "<div style='display: flex; gap: 0;'>
                        <div style='flex: 1;'><b>중식</b><br>" . $mealNames[0] . "</div>
                        <div style='flex: 1;'><b>석식</b><br>" . $mealNames[1] . "</div>
                     </div>";
    }

    return $mealName;
}

echo lunchExport(date('Ymd'));
?>
