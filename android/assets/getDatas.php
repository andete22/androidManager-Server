<?php
	$id = $_GET["id"];
	$nombre_fichero = "../datas/".$id;
	$gestor = fopen($nombre_fichero, "r");
	$contenido = fread($gestor, filesize($nombre_fichero));
	fclose($gestor);
	$json = json_encode(utf8_encode($contenido));
	echo $json;
?>