<?php
include '../conecta.php';
$re = mysql_query("SELECT * FROM dispositivos WHERE id=".$_GET['id']." AND idUser=".$_SESSION['userId']);
if (!(mysql_num_rows($re) == 1)){
	?>
	<script type="text/javascript">
			window.location="../dispositivos/index.php";
	</script>
	<?php
}
?>