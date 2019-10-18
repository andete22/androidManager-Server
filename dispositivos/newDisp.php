<?php
include '../conecta.php';
$r = mysql_query("INSERT INTO dispositivos VALUES ('','".$_GET["user"]."','".$_GET["name"]."')");
echo mysql_insert_id();
?>