var abiertoRegistro = false;
function btnRegistro(){
	if (abiertoRegistro){
			// va a registro
			if (document.getElementById("pass").value.localeCompare(document.getElementById("pass2").value) == 0){
				document.getElementById("registro_form").submit();
			}		
		}else{
			abiertoRegistro = true;
			document.getElementById("registro").style.display = "block";
		}
	}
	function comprobar(){
		if (document.getElementById("pass").value.localeCompare(document.getElementById("pass2").value) != 0){
			document.getElementById("coincide").style.display = "block";
			document.getElementById("pass2").value = "";

		}else{
			document.getElementById("coincide").style.display = "none";
		}
	}