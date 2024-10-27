<?php

include "../db.php";

$code = me($_GET["code"]);

mq("UPDATE member SET active=1 WHERE pw='$code'");
alertRedirect("이메일 인증이 완료되었습니다. 지금부터 로그인 가능합니다.", "../");