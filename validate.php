<?php
include 'conecta.php';
$error="";
if (isset($_POST["email"]) && isset($_POST["password"])) {
	$consulta = mysql_query("SELECT * FROM users WHERE email='".$_POST["email"]."' and pass='".$_POST["password"]."'");
	if (mysql_num_rows($consulta)>0) {
		session_start();
		$_SESSION["user"]=$_POST["email"];
		$fila = mysql_fetch_array($consulta);
		$_SESSION["userId"]=$fila["id"];

		?>
		<script type="text/javascript">
			window.location="dispositivos/";
		</script>
		<?php
	}else {
		session_start();
		$_SESSION["user"] = array();
		session_destroy();
		$error="Usuario o contraseña no coinciden.";

	}
}else{
	session_start();
	$_SESSION["user"] = array();
	session_destroy();
	$error="Faltan datos para hacer el loging.";
}
?>
<script type="text/javascript">
	window.location="index.php?error=<?php echo $error ?>";
</script>