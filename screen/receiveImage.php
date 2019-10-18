<?php
$fp = fopen("screens/".$_POST["name"], 'w');
fwrite($fp, strtr($_POST["image"], '-_,', '+/='));
fclose($fp);
?>