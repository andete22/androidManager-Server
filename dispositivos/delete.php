<?php
include '../security.php';
include '../conecta.php';
if(!empty($_GET['id'])){
	$borrarDisp = "DELETE FROM dispositivos WHERE id=".$_GET['id'];
	mysql_query($borrarDisp);
}
?>
<script type="text/javascript">
	window.location="index.php?i=Se ha borrado el dispositivo con id <?php echo $_GET['id'] ?>";
</script>