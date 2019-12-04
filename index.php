<?php
require "vendor/autoload.php";
use App\apimeteo\OpenWeather;



$meteo =  new OpenWeather('60ea8053e2377090969762659f2d5029');
//var_dump($meteo->getForeCast('Paris'));
 $m = $meteo->getToDay('Paris');
 var_dump($m); die();

echo "<ul><li><strong>{$m['city']}</strong></li></li><li>{$m['date']}   Ciel {$m['description']} {$m['temp']}°C</li></ul>";

echo "<hr/>";

$p = $meteo->getForeCast('Kiev');
var_dump($p);
