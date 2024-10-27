<?php
include "../db.php";
include "../detectAccount.php";
date_default_timezone_set('Asia/Seoul');

$ATPT_OFCDC_SC_CODE = 'K10';
$SD_SCHUL_CODE = '7801093';
$API_KEY = 'c2a4b8fcdab24f92aaea45e7a1fa4512';

header('Content-Type: application/json');

function fetchMeals($date)
{
    global $ATPT_OFCDC_SC_CODE;
    global $SD_SCHUL_CODE;
    global $API_KEY;

    $apiUrl = "https://open.neis.go.kr/hub/mealServiceDietInfo?ATPT_OFCDC_SC_CODE=$ATPT_OFCDC_SC_CODE&SD_SCHUL_CODE=$SD_SCHUL_CODE&MLSV_YMD=$date&KEY=$API_KEY";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    $xml = new SimpleXMLElement($response);
    $rows = $xml->xpath("//row");

    $meals = [];
    foreach ($rows as $row) {
        $mealName = (string)$row->DDISH_NM;
        $mealName = preg_replace('/[^\p{Hangul}<>br]+/u', '', $mealName);
        $meals[] = $mealName;
    }

    return $meals;
}

$date = $_GET['date'] ?? date('Ymd');
$meals = fetchMeals($date);

echo json_encode($meals);
