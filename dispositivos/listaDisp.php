<?php
include '../security.php';
include '../conecta.php';

$n = 0;
$resultado = mysql_query("SELECT * FROM dispositivos WHERE idUser='".$_SESSION["userId"]."'");
if (mysql_num_rows($resultado) > 0){

	while ($fila = mysql_fetch_array($resultado)){
		$id = $fila["id"];
		$nombre_fichero = "../d/".$id;
		$salidaFecha = "Sin determinar";
		if (file_exists($nombre_fichero)){
			$gestor = fopen($nombre_fichero, "r");
			$contenido = fread($gestor, filesize($nombre_fichero));
			fclose($gestor);
			$json = json_decode(utf8_encode($contenido));
			$salidaFecha = "Ahora";
			$ultFe = $json->fecha;
			$ahora = round(microtime(true) * 1000);
			if (($ahora - $ultFe) > 30000){
				$salidaFecha = date('d-m-Y H:i:s', round($ultFe/1000));
			}	
		}
		
		$color = "indigo";
		if ($n % 2 == 0){
			$color = "";
		}
		echo "<li><div class='".$color." lighten-2 collapsible-header'><i class='material-icons'>phone_android</i>".$fila['name']."</div><div class='indigo lighten-4 collapsible-body row'><div class='row'>Visto por ultima vez: ".$salidaFecha."</div><div class='row'><a href='../screen/index.php?id=".$fila['id']."' class='col offset-s1 s4'><i class='material-icons'>power_settings_new</i></a><a class='col offset-s2 s4' href='#!' onclick='javascript:borrarDisp(".$fila['id'].")'><i class='red-text material-icons'>delete</i></a></div></div></li>";
		$n++;
	}



}else{
	echo "<h5>Ning&uacute;n dispositivo</h5>";
}
?>