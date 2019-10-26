<?php
$nombre_fichero = "../screens/".$_GET["id"];
$gestor = fopen($nombre_fichero, "r");
$contenido = fread($gestor, filesize($nombre_fichero));
fclose($gestor);
echo "<img src='data:image/jpeg;base64, ".$contenido."' />";
?>