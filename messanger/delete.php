<?php 
    include "../db.php";
    include "../detectAccount.php";

    //
    $idx = me($_GET["idx"]);
    
    $sql = mq("SELECT * FROM please WHERE idx = '$idx'");
    $post = $sql->fetch_array();

    if($post["writer"] !== $member["idx"]) {
        alertRedirect("비정상적인 접근", "../");
    }else{
        $sql = mq("DELETE FROM please WHERE idx = '$idx'");
        $sql = mq("DELETE FROM pleaseUser WHERE postIdx = '$idx'");
        alertRedirect("삭제되었습니다.", "index.php");
    }