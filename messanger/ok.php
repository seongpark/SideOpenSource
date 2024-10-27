<?php 
    include "../db.php";
    include "../detectAccount.php";

    $idx = me($_GET["idx"]);
    $writer = $member["idx"];

    //동의 후 동의자수 구하기
    $sql = mq("SELECT * FROM please WHERE idx='$idx'");
    $please = $sql->fetch_array();
    $afterMeToo = $please["metoo"] + 1;

    //철회시
    $deleteMeToo = $please["metoo"] - 1;

    $pleaseSql = mq("SELECT * FROM pleaseUser WHERE writer='$writer' AND postIdx='$idx'");
    $load = false;
    
    //만약 이미 동의했었으면
    while($pleaseUser = $pleaseSql->fetch_array()) {
        $load = true;
        
        mq("UPDATE please SET metoo='$deleteMeToo'");
        mq("DELETE FROM pleaseUser WHERE writer='$writer' AND postIdx='$idx'");
        alertRedirect('동의가 철회되었습니다.', 'read.php?idx='.$idx);
    }

    //처음 동의한다면
    if($load == false) {
        mq("INSERT INTO pleaseUser (writer, postIdx) VALUES ('$writer', '$idx')");
        mq("UPDATE please SET metoo='$afterMeToo' WHERE idx='$idx'");
        alertRedirect('청원에 동의되었습니다.', 'read.php?idx='.$idx);
    }