<?php
if(empty($_GET["id"])){
	echo "<h5>Ningun dispositivo</h5>";
}else{

$ficheros = array();
$n=1;
$dir = "../datas/";
if (is_dir($dir)) {
	if ($dh = opendir($dir)) {
		while (($file = readdir($dh)) !== false) {
			if ($file != "." and $file != ".."){
				array_push ($ficheros, $file);
			}
		}
		closedir($dh);
	}
}


$db = new PDO('mysql:host=localhost;dbname=andromanager;charset=utf8mb4', 'root', '');
$dispositivos = $db->prepare("SELECT * FROM dispositivo WHERE idUsuario='".$_GET["id"]."'");
$dispositivos->execute();
$listDispositvos = $dispositivos->fetchAll(PDO::FETCH_ASSOC);

foreach ($listDispositvos as &$disp) {
	$disabled = "disabled";
	if (in_array($disp["nombre"],$ficheros)){
		$disabled = "";
	}
	echo "<li><a href='#?' onclick='javascript:usarDispositivo(this);' class='btn ". $disabled ."'>".$disp["nombre"]."</a><a onclick=\"borrarDispositivo('".$disp["nombre"]."')\" class='btn grey lighten-1'><i class='material-icons'>delete</i></a></li>";
}
}
?>