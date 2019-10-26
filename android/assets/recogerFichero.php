<?php
$fichero = "../files/".$_GET['file'];

if (file_exists($fichero)) {
	if ($_GET['descargar'] == "true"){
		header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.basename($fichero).'"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($fichero));
	    readfile($fichero);	
	}
    unlink($fichero);
}
?>