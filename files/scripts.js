var path = "/";

function updateFiles(){
	
	$.ajax({
		url : 'getFiles.php',
		data : {id : $("#dispId").html()},
		type : 'GET',
		dataType : 'html',
		success : function(html){
			$("#gestor_archivos").html(html);
		} 
	});

	$.ajax({
		url : '../getDatos.php',
		data : { id : $("#dispId").html() },
		type : 'GET',
		dataType : 'json',
		success : function(json) {
			var datas = JSON.parse(json);
			path = datas.path;
			var ruta = "<a href='#!' onclick='addAction(\"ls(/)\")' class='breadcrumb'>/</a>";
			var ruta_anterior = "/";
			var partesPath = path.split("/");
			for (var i = 0; i < partesPath.length; i++) {
				if (partesPath[i] != ""){
					ruta_anterior += partesPath[i] + "/";
					ruta += "<a href='#!' onclick='retornoFichero(\""+i+"\")' class='breadcrumb'>"+partesPath[i]+"</a>";
				}
			}
			document.getElementById("barra_archivos").innerHTML = ruta;
		} 
	});
	setTimeout(function(){
		updateFiles();
	},2000);
}
function run(){
	horaDispositivos();
	updateFiles();
}

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


function nuevaRutaFicheros(r){
	if(r == "/"){
		r="";
	}
	if(path == "/"){
		path="";
	}
	var a = "ls(" + path + "/" + r + ")";
	addAction(a);
}

function retornoFichero(lugar){
	var partes = path.split("/");
	var salida = "";
	for (var i = 0; i < lugar; i++) {
		salida += partes[i]+"/";
	}
	salida += partes[lugar];
	var a = "ls(" + salida + ")";
	addAction(a);
}

function addAction(acction){
	$.ajax({
		url : '../addAction.php',
		data : {id : $("#dispId").html(), action : acction},
		type : 'POST',
		dataType : 'html',
		beforeSend: function () {
			$("#resultado").html("Procesando, espere por favor...");
		}
	});
}
function descargaFichero(name){
	if(path == "/"){
		path="";
	}
	var salida = "download(" + path + "/" + name + ")";
	addAction(salida);
	var r = confirm("¿Realmente quieres descargar el fichero " + name + "?");
	location.href = "recogerFichero.php?file=" + name + "&descargar=" + (r ? "true" : "false");
}
