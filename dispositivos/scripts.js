function loadQR(){
	var name = document.getElementById("nombre_nuevo_disp").value;
	name = name.replace(/ |_/g, '');
	if (name.localeCompare("") != 0){
		var user = document.getElementById("user").value;
		var userName = document.getElementById("userName").value;
		var salida = name + "_" + user + "_" + userName;
		document.getElementById("qr").innerHTML = "<img src='https://api.qrserver.com/v1/create-qr-code/?color=000&bgcolor=FFF&data="+ salida +"&qzone=1&margin=0&size=300x300&ecc=M&format=png&download=0' ><br>Escane&eacute; este codigo QR con la aplicaci&oacute;n AndroManager.";
	}
	
}

var abiertoQR = false;
function abrirQR(){
	var valor = "block";
	var val_i = "remove";

	if (abiertoQR){
		valor = "none";
		val_i = "add";

	}
	document.getElementById("qr_code").style.display = valor;
	document.getElementById("anadirDisp_i").innerHTML = val_i;
	document.getElementById("anadirDisp_a").classList.remove("pulse");
	abiertoQR = !abiertoQR;
	
}
function updateDispList(){
	$.ajax({
		url : 'listaDisp.php',
		data : {id : $("#user").val()},
		type : 'GET',
		dataType : 'html',
		success : function(html){
			$("#listaDisp_btn").html(html);
		} 
	});
}
function borrarDisp(_id){
	addAction("darBaja()", _id);
	$.ajax({
		url : 'delete.php',
		data : {id : _id},
		type : 'GET',
		dataType : 'html',
		success : function(html){
			updateDispList();
		} 
	});
}
function addAction(acction, _id){
	$.ajax({
		url : '../addAction.php',
		data : {id : _id, action : acction},
		type : 'POST',
		dataType : 'html',
		beforeSend: function () {
			
		}
	});
}
