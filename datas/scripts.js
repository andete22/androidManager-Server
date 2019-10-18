
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
		url : '../getDatos.php',
		data : { id : $("#dispId").html() },
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

function run(){
	horaDispositivos();
	updateDatos();
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

function addAction(acction){
	$.ajax({
		url : '../addAction.php',
		data : {id : $("#dispId").html(), action : acction},
		type : 'POST',
		dataType : 'html',
		beforeSend: function () {
		
		}
	});
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
