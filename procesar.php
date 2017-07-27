<?php

//Tomo los valores de los textbox
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];

//Llamo a la libreria de Google
require_once('GoogleMapsTimeZone.php');

//Llamo a la key del api para hacer funcionar la api
define('API_KEY', 'AIzaSyBrG3fhQcIy01AH5iTf1W1ZnS9r7l5Z-6w');

//Zona horaria que quiero buscar
//Le asigno al objeto time zone, una latitud, una longitud , un time stamp y el formato de la respuesta que es json
$timezone_object = new GoogleMapsTimeZone($latitud, $longitud, time(), GoogleMapsTimeZone::FORMAT_JSON);

//Le asigno al objeto time zone_object la api
$timezone_object->setApiKey(API_KEY);
$timezone_data = $timezone_object->queryTimeZone();

//Zona horaria de Argentina
$timezoneDenfinidoObject = new GoogleMapsTimeZone(-32.9522839, -60.7681974, time(), GoogleMapsTimeZone::FORMAT_JSON);
$timezoneDenfinidoObject->setApiKey(API_KEY);
$timezoneInfo = $timezoneDenfinidoObject->queryTimeZone();

//Muestra la fecha y hora de Argentina
date_default_timezone_set($timezoneInfo['timeZoneId']);
echo 'Zona Horaria definida:<br />'.$timezoneInfo['timeZoneId'].'; '.date('Y-m-d H:i:s'). '<br />'. '<br />';

//Guardo en una variable la hora de Argentina
$tiempoDefinido = date('Y-m-d H:i:s');

//Muestra la fecha y hora de la latitud y longitud ingresada
date_default_timezone_set($timezone_data['timeZoneId']);
echo 'Zona Horaria  en la latitud y longitud ingresada:<br />'.$timezone_data['timeZoneId'].'; '.date('Y-m-d H:i:s'). '<br />'. '<br />';

//Guardo en una variable la hora 
$tiempoBuscado = date('Y-m-d H:i:s');

//Hago la diferencia horaria
$ts1 = strtotime(str_replace('/', '-', $tiempoDefinido));
$ts2 = strtotime(str_replace('/', '-', $tiempoBuscado));
$diff = abs($ts1 - $ts2) / 3600;

//Mensaje de respuesta:
echo 'La hora de '.$timezoneInfo['timeZoneId'].' es: '.$diff.' en comparacion a la latitud: '.$latitud.' y la longitud: '.$longitud.' ('.$timezone_data['timeZoneId'].')'.' ingresada';
?>