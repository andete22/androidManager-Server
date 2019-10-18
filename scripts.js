var abiertoRegistro = false;
function btnRegistro(){
	if (abiertoRegistro){
		// va a registro
		if (document.getElementById("registro_form").validate() != ""){
		if (document.getElementById("pass").value.localeCompare(document.getElementById("pass2").value) == 0){
			
				document.getElementById("registro_form").submit();
			}
		}		
	}else{
		abiertoRegistro = true;
		document.getElementById("registro").style.display = "block";
	}
}