<?php
include 'conecta.php';
$error="";
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirmPassword"])) {
	if (strcmp($_POST["password"],$_POST["confirmPassword"]) == 0){
		$consulta = mysql_query("INSERT INTO users VALUES ('','".$_POST["email"]."','".$_POST["password"]."')");
		?>
		<script type="text/javascript">
			window.location="index.php?info=Nuevo usuario registrado con exito. Ya puedes logearte.";
		</script>
		<?php
	}else {
		session_start();
		$_SESSION["user"] = array();
		$_SESSION["userId"] = array();

		session_destroy();
		$error="Las contraseñas no coinciden.";

	}
}else{
	session_start();
	$_SESSION["user"] = array();
	$_SESSION["userId"] = array();

	session_destroy();
	$error="Faltan datos para hacer el registro.";
}
?>
<script type="text/javascript">
	window.location="index.php?error=<?php echo $error ?>";
</script>