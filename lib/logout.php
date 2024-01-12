<?php

session_unset("telah-login");
session_unset("dunlop_username");
session_unset("dunlop_password");
session_unset("dunlop_id");
session_unset("dunlop_level");
echo "<meta http-equiv=Refresh content=0;url=../login.php>";

?>