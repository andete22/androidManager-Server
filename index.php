<?php
session_start();
$_SESSION["user"] = array();
$_SESSION["userId"] = array();
$_SESSION['disp'] = array();
$_SESSION['dispId'] = array();
session_destroy();
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="icon" type="image/png" href="../imgs/001.png" />
	<link rel="icon" type="image/png" href="imgs/001.png" />
	<title>AndroManager: Gesti&oacute;n remota de dispositivos Android</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css"  media="screen,projection"/>
	<link rel="stylesheet" href="inicio.css" />
	<script src="scripts.js"></script>
</head>
<body>
<div id="modal1" class="modal <?php if(empty($_GET['error'])){echo 'blue lighten-3';}else{ echo 'pink lighten-1';}?>">
	<div class="modal-content">
		<h4><?php if(!empty($_GET['error'])){ echo "<i class='material-icons'>warning</i> Error"; }else{ echo "<i class='material-icons'>info</i> Info"; } ?></h4>
		<?php if(!empty($_GET['error'])){ echo $_GET['error']; }else{ echo $_GET['info']; } ?>
	</div>
	<div class="modal-footer">
		<a href="index.php" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
	</div>
</div>
	<header id="header">
		<h1><img src="imgs/003.png" width="400px"></h1>
		<p>Gesti&oacute;n remota de dispositivos Android.<br/></p>
	</header>	
	<form id="login-form" method="post" action="validate.php">
		<input type="email" name="email" required placeholder="Email Address" pattern="[a-z0-9.-_]+@[a-z0-9.-_]+\.[a-z]{2,3}$" />
		<input type="password" name="password" required placeholder="Password" />
		<input type="submit" value="Entrar" />
	</form>
	<hr width="50%">
	<form id="registro_form" method="post" action="register.php">
		<div id="registro">
			<input type="email" name="email" required placeholder="Email Address" pattern="[a-z0-9.-_]+@[a-z0-9.-_]+\.[a-z]{2,3}$" />
			<input type="password" id="pass" name="password" required placeholder="Password" />
			<input type="password" id="pass2" name="confirmPassword" required placeholder="Confirm password" />
		</div>
		<input type="submit" onClick="btnRegistro()" value="Nuevo Registro" />
	</form>
	<footer id="footer">
		<ul class="copyright">
			<li>&copy; 2017</li><li>Antonio Delgado Tello</li><li>Universidad de Extremadura</li>
		</ul>
	</footer>
	<script src="assets/js/main.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
	<script type="text/javascript">
		$('.modal').modal();
		<?php if (!empty($_GET['error']) || !empty($_GET['info'])){?>
		$('#modal1').modal('open');
		<?php } ?>
	</script>
</body>
</html>