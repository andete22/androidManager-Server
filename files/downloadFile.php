<?php
$ifp = fopen("download/".$_POST['name'] , "wb"); 
fwrite($ifp, base64_decode(strtr($_POST["file"], '-_,', '+/='))); 
fclose($ifp);
?>