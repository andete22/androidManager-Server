<?php
session_start();
if (empty($_SESSION["activeSessionON"])){
	?>
	<script type="text/javascript">
		window.location="../index.php";
	</script>
	<?php
}
if(empty($_POST["dispositivo"])){
	?>
	<script type="text/javascript">
		window.location="../index.php";
	</script>
	<?php	
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
<body onload="javascript:updateDatos()">
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
				<li><a onclick="javascript:abrirPestana('screen.php')">Screen Mirroring</a></li>
				<li><a onclick="javascript:abrirPestana('aplicaciones.php')">Aplicaciones</a></li>
				<li><a onclick="javascript:abrirPestana('archivos.php')">Archivos</a></li>
				<li><a onclick="javascript:abrirPestana('datos.php')">Datos</a></li>
				<li><a onclick="javascript:abrirPestana('shell.php')">Teclado</a></li>
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
			<h5><div id="disp_menu" class="col s12 center"><?php echo $_POST["dispositivo"]?></div></h5><div class="row"><div class="col s12 center" id="ultimaFecha"></div></div>
		</div>
		<div class="nav-content row center hide-on-med-and-down">
			<div class="col m2"><a class="btn indigo darken-4" onclick="javascript:abrirPestana('dispositivos.php')">Dispositivos</a></div>
			<div class="col m2"><a class="btn indigo darken-4" onclick="javascript:abrirPestana('screen.php')">Screen Mirroring</a></div>
			<div class="col m2"><a class="btn indigo darken-4" onclick="javascript:abrirPestana('aplicaciones.php')">Aplicaciones</a></div>
			<div class="col m2"><a class="btn indigo darken-4" onclick="javascript:abrirPestana('archivos.php')">Archivos</a></div>	
			<div class="col m2"><a class="btn indigo darken-4" onclick="javascript:abrirPestana('datos.php')">Datos</a></div>	
			<div class="col m2"><a class="btn indigo darken-4" onclick="javascript:abrirPestana('shell.php')">Teclado</a></div>	
		</div>
	</nav>



	<main class="center">
		<div class="row">
		<label for="sonidoSw">Sonido</label>
			<div class="switch">
				<label>
					Off
					<input type="checkbox" onchange="mute_unmute()" id="sonidoSw">
					<span class="lever"></span>
					On
				</label>
			</div>
		</div>
		<div id="datos" class="col s12">
			<h4><div id="numeroTelefono"></div></h4>
			<div id="bateria">
				<h4><span id="estaCargando"></span> Nivel de bater&iacute;a</h4>
				<div id="bat_cuerpo">
					<div id="bat_nivel">
						<div id="bat_numero">
							100 %
						</div>
						
					</div>
				</div>
			</div>
			<div id="memoria">
				<h4>Memoria interna</h4>
				<div id="total_int"></div>
				<div>
					<canvas id="myChart"></canvas>
				</div>
				<h4>Memoria externa</h4>
				<div id="total_ext"></div>
				<div>
					<canvas id="myChart2"></canvas>
				</div>
			</div>
			<h4>Ultima posici&oacute;n GPS</h4>
			<div id="gps">
				<a id="a_map" target="_blank" href="">
					<img id="map" class="imgs" src="https://maps.googleapis.com/maps/api/staticmap?center=0,0&zoom=15&size=300x300&maptype=roadmap&key=AIzaSyBVHv5HJKHMkhrrrMipYq0SwbXQl_8BkSQ" alt="">
				</a>
			</div>
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
</body>
</html>