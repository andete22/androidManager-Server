<?php
include '../security.php';
include '../securityDisp.php';
include '../conecta.php';



$r = mysql_query("SELECT name FROM dispositivos WHERE id=".$_GET['id']);
$f = mysql_fetch_array($r);
$nombre = $f['name'];
$_SESSION['disp'] = $nombre;
$_SESSION['dispId'] = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
<link rel="icon" type="image/png" href="../imgs/001.png" />
	<meta charset="UTF-8">
	<title>AndroManager</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Patrick+Hand+SC" rel="stylesheet">
	<link rel="stylesheet" href="../styles.css" />
	<script src="scripts.js"></script>
</head>
<body onload="javascript:run()">

	<nav class="nav-extended indigo">
		<div class="nav-wrapper">
			<a href="#" class="brand-logo center"><img width="260px" src="../imgs/003.png"></a>
			<ul id="slide-out" class="side-nav">
				<li>
					<a id="usuario" class="subheader center">
						<?php
						echo $_SESSION["user"];
						?>	
					</a>
				</li>
				<li>
					<a href="../index.php" class="blue waves-effect waves-light btn">Logout</a>
				</li>
				<li><a href="../dispositivos/index.php">Dispositivos</a></li>
				<li><a href="../screen/index.php?id=<?php echo $_SESSION['dispId']?>">Screen Mirroring</a></li>
				<li class="active"><a href="../apps/index.php?id=<?php echo $_SESSION['dispId']?>">Aplicaciones</a></li>
				<li><a href="../files/index.php?id=<?php echo $_SESSION['dispId']?>">Archivos</a></li>
				<li><a href="../datas/index.php?id=<?php echo $_SESSION['dispId']?>">Datos</a></li>
				<li><a href="../keys/index.php?id=<?php echo $_SESSION['dispId']?>">Teclado</a></li>
				<li><a href="../shell/index.php?id=<?php echo $_SESSION['dispId']?>">Shell</a></li>
			</ul>
			<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li>
					<?php
					echo $_SESSION["user"];
					?>
				</li>
				<li>
					<a href="../index.php" class="blue waves-effect waves-light btn">Logout</a>
				</li>
			</ul>
		</div>
		<div class="nav-content row">
			<h5><div id="disp_name" class="col s12 center"><?php echo $_SESSION['disp']; ?></div></h5><div class="row"><div class="col s12 center" id="ultimaFecha"></div></div>
			<div id="dispId" style="display: none" ><?php echo $_SESSION['dispId']; ?></div>
		</div>
		<ul class="row hide-on-med-and-down">
			<li class="col"><a href="../dispositivos/index.php" >Dispositivos</a></li>
			<li class="col"><a href="../screen/index.php?id=<?php echo $_SESSION['dispId']?>" >Screen Mirroring</a></li>
			<li class="active col"><a href="../apps/index.php?id=<?php echo $_SESSION['dispId']?>" >Aplicaciones</a></li>
			<li class="col"><a href="../files/index.php?id=<?php echo $_SESSION['dispId']?>" >Archivos</a></li>	
			<li class="col"><a href="../datas/index.php?id=<?php echo $_SESSION['dispId']?>" >Datos</a></li>	
			<li class="col"><a href="../keys/index.php?id=<?php echo $_SESSION['dispId']?>" >Teclado</a></li>
			<li class="col"><a href="../shell/index.php?id=<?php echo $_SESSION['dispId']?>" >Shell</a></li>

		</ul>
	</nav>



	<main class="center">

		<div id="aplicaciones" class="row">
			<div id="apps_list" class="col offset-l3 l6 s12"></div>
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
		

$(document).ready(function(){
	$(".button-collapse").sideNav();
});


	</script>
</body>
</html>