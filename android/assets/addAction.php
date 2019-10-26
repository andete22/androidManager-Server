<?php
$fp = fopen("../actions/".$_POST["id"], 'a');
fwrite($fp, $_POST["action"]."\n");
fclose($fp);
?>