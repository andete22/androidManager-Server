function horaDispositivos(){
	$.ajax({
			url : '../getDatos.php',
			data : {id : $("#dispId").html()},
			type : 'GET',
			dataType : 'json',
			success : function(json) {
				var salidaFecha = "Ahora";
				var datas = JSON.parse(json);
				var ultFe = parseInt(datas.fecha);
				var ahora = new Date();
				if ((ahora.getTime() - ultFe) > 30000){
					var fech = new Date(ultFe);
					salidaFecha = fech.getDate() + "-" + (fech.getMonth()+1) + "-" + fech.getFullYear() + " " + fech.getHours() + ":" + fech.getMinutes() + ":" + fech.getSeconds();
				}
				$("#ultimaFecha").html("Visto por ultima vez: " + salidaFecha);
			}
		});
		setTimeout(function(){
			horaDispositivos();
		},1000);
}

function updatePantalla(){

	$.ajax({
		url : 'getScreen.php',
		data : {id : $("#dispId").html()},
		type : 'GET',
		dataType : 'html',
		success : function(html){
			$("#screen").html(html);
		} 
	});
	setTimeout(function(){
		updatePantalla();
	},100);
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



function coordenadasScreen(event){
	var mensaje = $("#mensajePantalla").val();
	pos_x = event.offsetX?(event.offsetX):event.pageX-document.getElementById("screen").offsetLeft;
	pos_y = event.offsetY?(event.offsetY):event.pageY-document.getElementById("screen").offsetTop;
	//alert(pos_x*4 +","+ pos_y*4);
	var salida = "touch("+(pos_x*4) + ","+(pos_y*4)+"," + mensaje +")";
	addAction(salida);
}
function escribirTexto(){
	var texto = $("#texto_enviar").val();
	$("#texto_enviar").val("");
	var salida = "inputText(" + texto + ")";
	addAction(salida);
}

function pulsoMenu(){
	addAction("pressBoton(atras)");
}

function run(){
	horaDispositivos();
updatePantalla();	
}

