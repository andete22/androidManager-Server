<?php
$nombre_fichero = "../d/".$_GET["id"];
$datos = fopen($nombre_fichero, "r");
$contenido = fread($datos, filesize($nombre_fichero));
$json = json_decode(utf8_encode($contenido));
$array = $json->{'files'};
foreach ($array as &$valor) {
	$funcion = "nuevaRutaFicheros";
	if ($valor->{'type'} == "file"){
		$funcion = "descargaFichero";

	}
	echo "<div class='file'><a href='#!' onClick='javascript:".$funcion."(\"".$valor->{'name'}."\");' ><img class='icon' src='imgs/".$valor->{'type'}.".png'><div class='name'>".$valor->{'name'}."</div></div>";
}
?>