<?php

include "../db.php";
include "../detectAccount.php";

//
$idx = me($_GET["idx"]);
$content = me($_POST["answer-content"]);

mq("UPDATE please SET answer='$content' WHERE idx='$idx'");
mq("UPDATE please SET status='4' WHERE idx='$idx'");

redirect('read.php?idx='.$idx);
    