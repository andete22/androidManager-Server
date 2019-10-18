<?php
include '../security.php';
include '../conecta.php';
$_SESSION['disp'] = array();
$_SESSION['dispId'] = array();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>AndroManager</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Patrick+Hand+SC" rel="stylesheet">
	<link rel="stylesheet" href="../styles.css" />
	<script src="scripts.js"></script>
</head>
<body onload="javascript:updateDispList()">
	<div id="modal1" class="modal blue lighten-3">
		<div class="modal-content">
			<h4><i class='material-icons'>info</i> Info</h4>
			<?php echo $_GET['i']; ?>
		</div>
		<div class="modal-footer">
			<a href="index.php" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
		</div>
	</div>
	<nav class="nav-extended indigo">
		<div class="nav-wrapper">
			<a href="#!" class="brand-logo center"><img width="260px" src="../imgs/003.png"></a>
			<ul id="slide-out" class="side-nav">
				<li>
					<a id="usuario" href="#!" class="subheader center">
						<?php
						echo $_SESSION["user"];
						?>
					</a>
				</li>
				<li>
					<a href="../index.php" class="blue waves-effect waves-light btn">Logout</a>
				</li>
			</ul>
			<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li>
					<?php
					echo $_SESSION["user"];
					?>
				</li>
				<li>
					<a href="../index.php">Logout</a>
				</li>
			</ul>
		</div>
		<div class="nav-content row">
			<h5><div id="disp_menu" class="col s12 center"></div></h5><div class="row"><div class="col s12 center" id="ultimaFecha"></div></div>
		</div>
	</nav>
	<main class="center">
		<div id="dispositivos" class="row">	
			<ul class="col offset-m4 m4 s12 collapsible popout" id="listaDisp_btn" data-collapsible="accordion">
			</ul>
		</div>
		<div class="col offset-m4 m4 s12">
			<a href="#!" onclick="updateDispList()"><i class="material-icons">refresh</i> Actualizar lista</a>
			
		</div>
		<div class="row">
			<a class="btn tooltipped btn-floating btn-large pulse" data-position="left" id="anadirDisp_a" onclick="javascript:abrirQR()" data-delay="50" data-tooltip="A&ntilde;adir nuevo dispositivo"><i class="material-icons" id="anadirDisp_i">add</i></a>
			<div class="row" style="display: none" id="qr_code">
				<div class="input-field col offset-l4 l4 s12">
					<input class="center" onkeyup="javascript:loadQR()" placeholder="Nombre del dispositivo" id="nombre_nuevo_disp" type="text">
					<label for="nombre_nuevo_disp">Nombre del nuevo dispositivo</label>
					<input type="hidden" name="user" id="user" value="<?php echo $_SESSION["userId"] ?>">
					<input type="hidden" name="userName" id="userName" value="<?php echo $_SESSION["user"] ?>">

				</div>
				<div class="row">
					<div class="col s12" id="qr"></div>
				</div>
				<div class="row">
					<a class="btn btn-floating" href="../andromanager.apk"><i class="material-icons">system_update</i></a>
				</div>
				<div class="row">
					Descargue la aplicaci&oacute;n aqu&iacute;.
				</div>
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
	<script type="text/javascript">
		$('.modal').modal();
		<?php if (!empty($_GET['i'])){?>
			$('#modal1').modal('open');
			<?php } ?>
		</script>
	</body>
	</html>