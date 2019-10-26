var path;
function loadQR(){
	var d = new Date();
	var time = d.getTime();
	var name = document.getElementById("nombre_nuevo_disp").value;
	name = name.replace(/ |_/g, '');
	if (name.localeCompare("") != 0){
		var user = document.getElementById("user").value;
		var salida = time + "_" + name + "_" + user;
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
function usarDispositivo(btn){
	var nombre = btn.innerHTML;
	document.getElementById("disp_menu").innerHTML = nombre;
	for (var i = 0; i < 10; i++) {
		document.getElementsByClassName("menu")[i].classList.remove("disabled");
	}
	$("#disp_menu").html(btn.innerHTML);
	horaDispositivos();
}
function carpeta(v){
	$.ajax({
		url : 'files/guarda.php?path='+v,
		dataType : 'html',
		success : function(html) {
			$("contenedor_files").html(html);
		}
	});
}
function formatBytes(bytes) {
	if(bytes == 0) return '0 Bytes';
	var k = 1024,
	dm = 2,
	sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
	i = Math.floor(Math.log(bytes) / Math.log(k));
	return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

function updateDatos(){
	$.ajax({
		url : 'assets/getDatas.php',
		data : { id : $("#disp_menu").html() },
		type : 'GET',
		dataType : 'json',
		success : function(json) {
			var datas = JSON.parse(json);
			var bat = datas.bat;
			

			var dir = datas.files;
			var total_int = datas.mem_int.total;
			var total_ext = datas.mem_ext.total;
			var libre_int = datas.mem_int.libre;
			var libre_ext = datas.mem_ext.libre;
			$("#total_int").html("TOTAL: " + formatBytes(total_int));
			$("#total_ext").html("TOTAL: " + formatBytes(total_ext));
			var latitud = datas.coord.latitud;
			var longitud = datas.coord.longitud;
			var ctx = document.getElementById("myChart");
			var ctx2 = document.getElementById("myChart2");
			var data1 = {
				labels: [
				"Libre: " + formatBytes(libre_int),
				"Ocupado: " + formatBytes(total_int-libre_int)
				],
				datasets: [
				{
					data: [libre_int, total_int-libre_int],
					backgroundColor: [
					"#FF6384",
					"#FFCE56"
					],
					hoverBackgroundColor: [
					"#FE2E2E",
					"#F7FE2E"
					]
				}]
			};
			var myPieChart1 = new Chart(ctx,{
				type: 'pie',
				options: {
					animation: {
						duration: 0
					}
				},
				data: data1
			});
			var data2 = {
				labels: [
				"Libre: " + formatBytes(libre_ext),
				"Ocupado: " + formatBytes(total_ext-libre_ext)
				],
				datasets: [
				{
					data: [libre_ext, total_ext-libre_ext],
					backgroundColor: [
					"#FF6384",
					"#FFCE56"
					],
					hoverBackgroundColor: [
					"#FE2E2E",
					"#F7FE2E"
					]
				}]
			};
			var myPieChart2 = new Chart(ctx2,{
				type: 'pie',
				options: {
					animation: {
						duration: 0
					}
				},
				data: data2
			});
			document.getElementById('map').src = "https://maps.googleapis.com/maps/api/staticmap?center="+latitud+","+longitud+"&zoom=15&size=600x300&maptype=roadmap&markers=color:red|"+latitud+","+longitud + "&key=AIzaSyBVHv5HJKHMkhrrrMipYq0SwbXQl_8BkSQ";
			
			document.getElementById('a_map').href = "https://www.google.com/maps?q="+latitud+","+longitud;
			var color = "blue";
			if (bat <= 15) {
				color = "red";
			}else if (bat <= 30) {
				color = "yellow";
			}else {
				color = "blue";
			}
			document.getElementById("bat_numero").innerHTML = bat + " %";
			document.getElementById("bat_nivel").style.backgroundColor = color;
			document.getElementById("bat_nivel").style.width = (1.94*parseInt(bat)) + "px";
			if (datas.sonido == "on"){
				document.getElementById('sonidoSw').checked = true;
			}else{
				document.getElementById('sonidoSw').checked = false;
			}
			
			
			document.getElementById("numeroTelefono").innerHTML = datas.numero;
			document.getElementById("estaCargando").innerHTML = (datas.batChange == "1" ? "<i class='material-icons'>battery_charging_full</i>" : "<i class='material-icons'>battery_std</i>") ;

		}
	});
	setTimeout(function(){
		updateDatos();
	},2000);
}

function updateApps(){
	$.ajax({
		url : 'assets/getDatas.php',
		data : { id : $("#disp_menu").html() },
		type : 'GET',
		dataType : 'json',
		success : function(json) {
			var datas = JSON.parse(json);
			var apps = datas.apps;
			var appsL = "<table class='striped centered'><tr><th colspan='2' >Aplicaci&oacute;n</th><th>Abrir</th></tr>";
			for (i = 0; i < apps.length; i++) {
				var icon = apps[i].appicon.replace(/_/g, '/').replace(/-/g, '+').replace(/,/g, '=');
				appsL += "<tr><td><img width='40px' src='data:image/png;base64, " + icon + "'></td><td>" + apps[i].appname + "</td><td><a href='#!' onclick=\"abrirPrograma('"+ apps[i].appname +"')\" ><i class='material-icons blue-text'>open_in_new</i></a></td></tr>";
			}
			appsL += "</table>";
			document.getElementById('apps_list').innerHTML = appsL;
		}
	});
	setTimeout(function(){
		updateDispList();
	},5000);
}

function updateDispList(){
	$.ajax({
		url : 'assets/updateDispList.php',
		data : {id : $("#user").val()},
		type : 'GET',
		dataType : 'html',
		success : function(html){
			$("#listaDisp_btn").html(html);
		} 
	});
	setTimeout(function(){
		updateDispList();
	},500);
}


function updateGlobal(){
	var url = location.href;
	var urlw = url.split("/");
	url = urlw[urlw.length-1];
	if(url != "dispositivos.php"){
		$.ajax({
			url : 'assets/getDatas.php',
			data : { id : $("#disp_menu").html() },
			type : 'GET',
			dataType : 'json',
			success : function(json) {
				
				var salidaFecha = "Ahora";
				var datas = JSON.parse(json);
				var ultFe = parseInt(datas.fecha);
				var ahora = new Date();
				if ((ahora.getTime() - ultFe) > 10000){
					var fech = new Date(ultFe);
					salidaFecha = fech.getDate() + "-" + (fech.getMonth()+1) + "-" + fech.getFullYear() + " " + fech.getHours() + ":" + fech.getMinutes() + ":" + fech.getSeconds();
				}
				document.getElementById("ultimaFecha").innerHTML = "Visto por ultima vez: " + salidaFecha;
			}
		});
		setTimeout(function(){
			updateGlobal();
		},1000);
	}
}
updateGlobal();


function horaDispositivos(){
	$.ajax({
			url : 'assets/getDatas.php',
			data : { id : $("#disp_menu").html() },
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
			updateGlobal();
		},1000);
}

function abrirPrograma(name){
	var salida = "open("+name+")";
	addAction(salida);
}

function updateFiles(){
	
	$.ajax({
		url : 'assets/getFiles.php',
		data : {id : $("#disp_menu").html()},
		type : 'GET',
		dataType : 'html',
		success : function(html){
			$("#gestor_archivos").html(html);
		} 
	});

	$.ajax({
		url : 'assets/getDatas.php',
		data : { id : $("#disp_menu").html() },
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


function updatePantalla(){

	$.ajax({
		url : 'assets/getScreen.php',
		data : {id : $("#disp_menu").html()},
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
		url : 'assets/addAction.php',
		data : {id : $("#disp_menu").html(), action : acction},
		type : 'POST',
		dataType : 'html',
		beforeSend: function () {
			$("#resultado").html("Procesando, espere por favor...");
		},
	});
}

function descargaFichero(name){
	if(path == "/"){
		path="";
	}
	var salida = "download(" + path + "/" + name + ")";
	addAction(salida);
	var r = confirm("¿Realmente quieres descargar el fichero " + name + "?");
	location.href = "assets/recogerFichero.php?file=" + name + "&descargar=" + (r ? "true" : "false");
}



$(document).ready(function(){
	$(".button-collapse").sideNav();
});


function abrirPestana(donde){
	var form = document.createElement("form");
	form.action = donde;
	form.method = 'POST';
	form.style.display = 'none';
	
	var input = document.createElement("input");
	input.type = "text";
	input.name = "dispositivo";
	input.value = $("#disp_menu").html();
	form.appendChild(input);
	
	var input2 = document.createElement("input");
	input2.type = "text";
	input2.name = "email";
	input2.value = $("#usuario").html();
	form.appendChild(input2);
	
	document.body.appendChild(form);
	form.submit();
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


function mute_unmute() {
	var salida = "";
	if (document.getElementById('sonidoSw').checked){
		salida = "mute(100)";
	}else{
		salida = "mute(0)";
	}
	addAction(salida);
}
function pulsoMenu(){
	addAction("pressBoton(atras)");
}

function borrarDispositivo(disp_){
	$.ajax({
		url : 'assets/addAction.php',
		data : {id : disp_, action : "darBaja(0)"},
		type : 'POST',
		dataType : 'html',
		beforeSend: function () {
			$("#resultado").html("Procesando, espere por favor...");
		},
	});

	$.ajax({
		url : 'assets/removeDisp.php',
		data : {nombre : disp_},
		type : 'POST',
		dataType : 'html',
		beforeSend: function () {
			$("#resultado").html("Procesando, espere por favor...");
		},
	});


}