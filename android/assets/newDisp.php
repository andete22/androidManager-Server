<?php
$db = new PDO('mysql:host=localhost;dbname=andromanager;charset=utf8mb4', 'root', '');
$insertar = $db->query("INSERT INTO dispositivo VALUES ('".$_GET["id"]."','".$_GET["user"]."','".$_GET["name"]."')");
?>