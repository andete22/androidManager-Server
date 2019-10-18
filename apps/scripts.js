function run(){
	horaDispositivos();
	updateApps();
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


function updateApps(){
	$.ajax({
		url : '../getDatos.php',
		data : { id : $("#dispId").html() },
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
			$('#apps_list').html(appsL);
		}
	});
	setTimeout(function(){
		updateApps();
	},5000);
}

function abrirPrograma(name){
	var salida = "open("+name+")";
	addAction(salida);
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

