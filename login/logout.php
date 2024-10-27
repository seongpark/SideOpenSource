<?php

include "../db.php";

setcookie("email", "", time() - 3600, "/");
setcookie("pw", "", time() - 3600, "/");

redirect("index.php");