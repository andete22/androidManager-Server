<?php
$db = new PDO('mysql:host=localhost;dbname=andromanager;charset=utf8mb4', 'root', '');
$insertar = $db->query("DELETE FROM dispositivo WHERE nombre = '".$_POST["nombre"]."'");
?>