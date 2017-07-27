<!DOCTYPE html>
<html>
	<head>
		<title>Diferencia Horaria</title>
		<link rel="stylesheet" type="text/css" href="estilos.css">
	</head>
	<body>
		<h4>Zona Horaria de Argentina</h4>
		<?php 
			require_once('GoogleMapsTimeZone.php');
			//Llamo a la key del api para hacer funcionar la api
			define('API_KEY', 'AIzaSyBrG3fhQcIy01AH5iTf1W1ZnS9r7l5Z-6w');
			//Tiempo en Argentina
			$timezoneDenfinidoObject = new GoogleMapsTimeZone(-32.9522839, -60.7681974, time(), GoogleMapsTimeZone::FORMAT_JSON);

			$timezoneDenfinidoObject->setApiKey(API_KEY);

			$timezoneInfo = $timezoneDenfinidoObject->queryTimeZone();
			date_default_timezone_set($timezoneInfo['timeZoneId']);
			echo $timezoneInfo['timeZoneId'].': '.date('Y-m-d H:i:s');
		?>
		<h4>Realice la diferencia horaria...</h4>
		La diferencia horaria se sacara con la zona horaria de Argentina
		<br>
		Solo se permite escribir numeros!
		<form action = "procesar.php" method="post" name="frm">
			<div class="lat">Latitud: <input type="text" name="latitud"><br></div>
			<div class="lng">Longitud: <input type="text" name="longitud"><br></div>
			<div class="btn"><input type="submit" name="Enviar"></div>
		</form>
	</body>
</html>

