
function horaDispositivos(){
	$.ajax({
			url : '../getDatos.php',
			data : { id : $("#dispId").html() },
			type : 'GET',
			dataType : 'json',
			success : function(json) {
				
				var salidaFecha = "Ahora";
				var datas = JSON.parse(json);
				var ultFe = parseInt(datas.fecha);
				var ahora = new Date();
				if ((ahora.getTime() - ultFe) > 60000){
					var fech = new Date(ultFe);
					salidaFecha = fech.getDate() + "-" + (fech.getMonth()+1) + "-" + fech.getFullYear() + " " + fech.getHours() + ":" + fech.getMinutes() + ":" + fech.getSeconds();
				}
				document.getElementById("ultimaFecha").innerHTML = "Visto por ultima vez: " + salidaFecha;
			}
		});
		setTimeout(function(){
			horaDispositivos();
		},1000);
}

function addAction(acction){
	$.ajax({
		url : '../addAction.php',
		data : {id : $("#dispId").html(), action : acction},
		type : 'POST',
		dataType : 'html',
		beforeSend: function () {
			$("#resultado").html("Procesando, espere por favor...");
		},
	});
}

function escribirTexto(){
	var texto = $("#texto_enviar").val();
	$("#texto_enviar").val("");
	var salida = "inputText(" + texto + ")";
	addAction(salida);
}