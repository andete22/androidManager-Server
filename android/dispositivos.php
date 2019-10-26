<?php
session_start();
if (empty($_POST) && empty($_SESSION["activeSessionON"])){
	?>
	<script type="text/javascript">
		window.location="../index.php";
	</script>
	<?php
}

if (!empty($_POST["password"])){

	$listDispositvos = array();
	$file = "ejemplo";
	$db = new PDO('mysql:host=localhost;dbname=andromanager;charset=utf8mb4', 'root', '');
	if ($_POST["esRegistro"] == "true"){
		$fecha = date_create();
		date_timestamp_get($fecha);
		$insertar = $db->query("INSERT INTO usuario VALUES ('".date_timestamp_get($fecha).$_POST["email"]."','".$_POST["password"]."','".$_POST["email"]."')");
	}
	$credenciales = $db->prepare("SELECT * FROM usuario WHERE usuario='".$_POST["email"]."' and password='".$_POST["password"]."'");
	$credenciales->execute();
	$numCredenciales = $credenciales->rowCount();

	if ($numCredenciales > 0) {
		$credencial= $credenciales->fetchAll(PDO::FETCH_ASSOC)[0];
		$_SESSION["activeSessionON"]=$credencial["id"];
		$dispositivos = $db->prepare("SELECT * FROM dispositivo WHERE idUsuario='".$credencial["id"]."'");
		$dispositivos->execute();
		$listDispositvos = $dispositivos->fetchAll(PDO::FETCH_ASSOC);
		if (!empty($listDispositvos)){
			$file = $listDispositvos[0]["nombre"];
		}
	}else {
			?>
	<script type="text/javascript">
		window.location="../index.php";
	</script>
	<?php
	}
}



?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>AndroManager</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Patrick+Hand+SC" rel="stylesheet">
	<link rel="stylesheet" href="styles.css" />
	<script src="scripts.js"></script>
</head>
<body onload="javascript:updateDispList()">
	<nav class="nav-extended indigo">
		<div class="nav-wrapper">
			<a href="#" class="brand-logo center">AndroManager</a>
			<ul id="slide-out" class="side-nav">
				<li>
					<a id="usuario" class="subheader center">
						<?php
						if (!empty($_POST["email"])) echo $_POST["email"];
						?>	
					</a>
				</li>
				<li>
					<a href="../index.php" class="blue waves-effect waves-light btn">Logout</a>
					</li>
				<li><a onclick="javascript:abrirPestana('dispositivos.php')">Dispositivos</a></li>
				<li><a class="disabled menu" onclick="javascript:abrirPestana('screen.php')">Screen Mirroring</a></li>
				<li><a class="disabled menu" onclick="javascript:abrirPestana('aplicaciones.php')">Aplicaciones</a></li>
				<li><a class="disabled menu" onclick="javascript:abrirPestana('archivos.php')">Archivos</a></li>
				<li><a class="disabled menu" onclick="javascript:abrirPestana('datos.php')">Datos</a></li>
				<li><a class="disabled menu" onclick="javascript:abrirPestana('shell.php')">Teclado</a></li>
			</ul>
			<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li>
					<?php
					if (!empty($_POST["email"])) echo $_POST["email"];
					?>
				</li>
				<li>
					<a href="../index.php" class="blue waves-effect waves-light btn">Logout</a>
				</li>
			</ul>
		</div>
		<div class="nav-content row">
			<h5><div id="disp_menu" class="col s12 center"></div></h5><div class="row"><div class="col s12 center" id="ultimaFecha"></div></div>
		</div>
		<div class="nav-content row center hide-on-med-and-down">
			<div class="col m2"><a class="btn indigo darken-4" onclick="javascript:abrirPestana('dispositivos.php')">Dispositivos</a></div>
			<div class="col m2"><a class="disabled menu btn indigo darken-4" onclick="javascript:abrirPestana('screen.php')">Screen Mirroring</a></div>
			<div class="col m2"><a class="disabled menu btn indigo darken-4" onclick="javascript:abrirPestana('aplicaciones.php')">Aplicaciones</a></div>
			<div class="col m2"><a class="disabled menu btn indigo darken-4" onclick="javascript:abrirPestana('archivos.php')">Archivos</a></div>	
			<div class="col m2"><a class="disabled menu btn indigo darken-4" onclick="javascript:abrirPestana('datos.php')">Datos</a></div>	
			<div class="col m2"><a class="disabled menu btn indigo darken-4" onclick="javascript:abrirPestana('shell.php')">Teclado</a></div>	
		</div>
	</nav>



	<main class="center">
		<div id="dispositivos" class="col s12">
			<ul class="lista">
				<span id="listaDisp_btn">
					<?php
					foreach ($listDispositvos as &$disp) {
						echo "<li><a href='#?' onclick='javascript:usarDispositivo(this);' class='btn disabled'>".$disp["nombre"]."<div class='chip'></a><i class='material-icons'>delete</i></div></li>";
					}
					?>
				</span>
				<li>
					<a class="btn tooltipped btn-floating btn-large pulse" data-position="left" id="anadirDisp_a" onclick="javascript:abrirQR()" data-delay="50" data-tooltip="A&ntilde;adir nuevo dispositivo"><i class="material-icons" id="anadirDisp_i">add</i></a>
					<div class="row" id="qr_code">
						<div class="input-field col offset-l4 l4 s12">
							<input class="center" onkeyup="javascript:loadQR()" placeholder="Nombre del dispositivo" id="nombre_nuevo_disp" type="text">
							<label for="nombre_nuevo_disp">Nombre del nuevo dispositivo</label>
							<input type="hidden" name="user" id="user" value="<?php echo $_SESSION["activeSessionON"] ?>">
						</div>
						<div class="row">
							<div class="col s12" id="qr"></div>
						</div>
						<div class="row">
							<a class="btn col s12 m6 offset-m3"><i class="material-icons">system_update</i> Descargue la aplicaci&oacute;n aqu&iacute;</a>
						</div>
						
					</div>

				</li>
			</ul>

		</div>
	</main>
	<footer class="page-footer indigo">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">AndroManager</h5>
					<p class="grey-text text-lighten-4">Gesti&oacute;n remota de dispositivos Android.</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="white-text">Proyecto de Fin de Grado de la Universidad de Extremadura</h5>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				© 2017 Copyright · Antonio Delgado Tello
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
	<script src="scripts.js"></script>

</body>
</html>