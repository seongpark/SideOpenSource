<?php

include '../db.php';
include '../detectAccount.php';

$idx = me($_GET['idx']);

$sql = mq("SELECT * FROM dday WHERE idx = '$idx'");
$dday = $sql->fetch_assoc();

if ($member["idx"] == $dday["writer"]) {
    $sql = mq("DELETE FROM dday WHERE idx = '$idx'");
    redirect("index.php");
}