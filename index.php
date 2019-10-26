<?php
session_start();
$_SESSION = array();
session_destroy ();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>AndroManager: Gesti&oacute;n remota de dispositivos Android</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="styles.css" />
	<script src="scripts.js"></script>
</head>
<body>
	<header id="header">
		<h1>AndroManager</h1>
		<p>Gesti&oacute;n remota de dispositivos Android.<br /></p>
	</header>	
	<form id="login-form" method="post" action="android/dispositivos.php">
		<input type="email" name="email" required placeholder="Email Address" pattern="[a-z0-9.-_]+@[a-z0-9.-_]+\.[a-z]{2,3}$" />
		<input type="password" name="password" required placeholder="Password" />
		<input type="hidden" value="false" name="esRegistro">
		<input type="submit" value="Entrar" />
	</form>
	<hr width="50%">
	<form id="registro_form" method="post" action="android/dispositivos.php">
		<div id="registro">
			<input type="email" name="email" required placeholder="Email Address" pattern="[a-z0-9.-_]+@[a-z0-9.-_]+\.[a-z]{2,3}$" />
			<input type="password" id="pass" name="password" required placeholder="Password" />
			<input type="password" id="pass2" name="confirmPassword" onchange="comprobar()" id="confirmPassword" required placeholder="Confirm password" />
			<div style="color:red;" id="coincide">El email no coincide.</div>
			<input type="hidden" value="true" name="esRegistro" />
		</div>
		<input type="button" onClick="btnRegistro()" value="Nuevo Registro" />
	</form>
	<footer id="footer">
		<ul class="copyright">
			<li>&copy; 2017</li><li>Antonio Delgado Tello</li><li>Universidad de Extremadura</li>
		</ul>
	</footer>
	<script src="assets/js/main.js"></script>
</body>
</html>