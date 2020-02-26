<?php
require "vendor/autoload.php";
use App\apimeteo\OpenWeather;
use App\currencyconverter\CurrencyConverter;
use App\GeoUser;

var_dump((new GeoUser())->get_data_user());


var_dump((new CurrencyConverter())->getCurrency('USD'));






$meteo =  new OpenWeather();
$m = $meteo->getToDay('Porto-Novo', 'bj');







?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Call Api </title>
</head>
<body>
<h1>Weather</h1>

<div class="row">
    <div class="ms-3 result">
        <ul style="list-style-type: none">
            <li class="first"><ion-icon name="pin"></ion-icon> <strong> <?=$m->city?></strong></li>
            <li class="second"><?=$meteo->dateFr($m->date)->date.' '.$meteo->dateFr($m->date)->hour."<br/> Ciel ".$m->description.' '.ceil($m->temp)?>°C</li>
            <li class="last"><img src="http://openweathermap.org/img/wn/<?=$m->image?>@2x.png"></li>
        </ul>
    </div>

    <div class="ms-3 ml-3">
        <form method="post" action="">
            <select class="form-control form-control-lg" id="select">
                <option value="">Select your city</option>
                <option value="Porto-Novo,bj">Porto-Novo</option>
                <option value="Paris,fr">Paris</option>
                <option value="Kiev,ua">Kiev</option>
                <option value="London,uk">London</option>
                <option value="Dakar,sn">Dakar</option>
                <option value="Dnipro,ua">Dnepr</option>
            </select>
        </form>
        
    </div>
</div>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"/>
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $(function () {
        $('#select').change(function () {

           let array       =  $(this).val().split(',');
           let city        = array[0];
           let countryCode = array[1];

           if(city !== ""){
               $.ajax({
                   url: 'App/apimeteo/request.php',
                   dataType: 'json',
                   method: 'POST',
                   async: true,
                   cache: false,
                   data: {city:city,countryCode:countryCode},
                   success: function (response) {
                       $('.result .first strong').html(response.city);
                       $('.result .second').html(response.transf_date + ' ' + response.transf_hour + '<br/> Ciel ' + response.description + ' ' + response.round_temp + ' °C');
                       $('.result .last img').attr('src', "http://openweathermap.org/img/wn/"+ response.image +"@2x.png");
                   },
                   error: function (resp, status, error) {
                       $('.result').html(error);
                       //console.log(resp);
                   }

               });
           }

        });
    })
</script>

</body>
</html>
