<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>AndroManager</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
</head>
<body>
	<table class="striped">
			<thead>
				<tr>
					<th>Comando</th>
					<th>Descripci&oacute;n</th>
					<th>Retorno</th>
					<th>Valores de entrada</th>
					<th>Ejemplo</th>
				</tr>
			</thead>
		<tbody>
			<tr>
				<td>
					ls(nombre_directorio)
				</td>
				<td>	
					Lista un directorio específico del almacenamiento del dispositivo.
				</td>
				<td>	
					Retorno: Lista de directorios y archivos, perfectamente identificados con su nombre y tipo (directorio o archivo).
				</td>
				<td>	
					nombre_directorio: nombre del directorio que se va a lista.
				</td>
				<td>	
					ls(/sdcard/)
				</td>
			</tr>
			<tr>	
				<td>
					download(nombre_archivo)
				</td>
				<td>	
					Descarga en el navegador un archivo determinado.
				</td>
				<td>	
					Bits de un fichero determinado.
				</td>
				<td>	
					nombre_archivo: archivo que se va a descargarlo
				</td>
				<td>	
					download(/sdcard/photo.jpg)
				</td>
			</tr>
			<tr>	
				<td>
					touch(coord_x,coord_y,texto)
				</td>
				<td>Marca un punto en la pantalla del usuario en una determinada coodernada x,y, dando una instrucción visual y auditiva.
				</td>
				<td>Nada
				</td>
				<td>coord_x: valor x de la coordenada en la pantalla.
					coord_y: valor y de la coordenada en la pantalla.
					texto: mensaje visual y auditivo que se transmitirá al usuario. Este valor puede quedar vacío, el valor por defecto es “Pulsa aquí”.
				</td>
				<td>
					touch(122,775,pulsando aquí abres whatsapp)
					touch(754,23,)
				</td>
			</tr>
			<tr>	
				<td>
					open(nombre_aplicación)
				</td>
				<td>Ejecuta, en el dispositivo, una aplicación de la lista de aplicaciones del dispositivo.
				</td>
				<td>Nada</td>
				<td>
					nombre_aplicacion: el nombre de la aplicación que va a ser ejecutada.
				</td>
				<td>
					open(Ajustes)
				</td>
			</tr>
			<tr>	
				<td>
					inputText(texto):
				</td>
				<td>Escribe un texto en el dispositivo con el teclado virtual.
				</td>
				<td>Nada</td>
				<td>
					texto: el texto que va a ser escrito en el cuadro de texto donde este el foco de pront.
				</td>
				<td>
					inputText(imágenes de gatos)
				</td>
			</tr>
			<tr>	
				<td>
					mute(numero)</td>
					<td>Pone el nivel de sonido a un determinado valor, entre 0 a 100.
					</td>
					<td>Nada
					</td>
					<td>
						numero: Valor entre 0 a 100 que sera el valor del porcentaje del nivel de volumen de sonido. Siendo 0 mute y 100 el nivel maximo.
					</td>
					<td>
						mute(0)
					</td>
				</tr>
				<tr>	
					<td>
						pressButton(botonTipe)</td>
						<td>Esta función hace una pulsación de uno de los 3 botones de navegación de Android: Menú, atrás, home. Esta función solo es útil dentro de nuestra aplicación Android.
						</td>
						<td> Nada</td>
						<td>
							botonTipe: solo esta implementada la función de los botones menú y atrás. Ya que, al ser solo dentro de nuestra aplicación, no tiene una gran utilidad, solo la de minimizar esta. Por lo tanto, los valores soportados son:
							<ul>
								<li>
									menu
								</li>
								<li>
									atras
								</li>
							</ul>
								</td>
								<td>
									pressButton(atras)
								</td>
							</tr>
						</tbody>	
					</table>
</body>
</html>
		