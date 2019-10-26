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
<body onload="javascript:updateFiles()">
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

  <div id="modal1" class="modal">
    <div class="modal-content">
      <p>Cargando por favor espere ...</p>
    </div>
  </div>


	<main class="center">
	
		<div id="archivos" class="row">
			<div id="barra_archivos" class="nav-wrapper indigo col offset-l3 l6 s12">
				<a href="#" class="breadcrumb">/</a>
			</div>
			<div id="gestor_archivos" class="contenedor_files col offset-l3 l6 s12">

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