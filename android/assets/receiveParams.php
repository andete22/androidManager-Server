<?php
$fp = fopen("../datas/".$_POST["name"], 'w');
fwrite($fp, $_POST["datas"]);
fclose($fp);
echo (file_get_contents("../actions/".$_POST["name"]));
$fp2 = fopen("../actions/".$_POST["name"], 'w');
fclose($fp2);
?>