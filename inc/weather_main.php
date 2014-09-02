<h1>Wetter</h1>
<div class="weather">
<?php
include('inc/lib/forecast.io.php');
$forecast = new ForecastIO($forecast_api_key);


function converticon($icon = 'wi-day-cloudy')
{
    switch ($icon) {
    case "clear-day":
        return "wi-day-sunny";
        break;
    case "clear-night":
        return "wi-night-clear";
        break;
    case "rain":
        return "wi-rain";
        break;
    case "snow":
        return "wi-snow";
        break;
    case "sleet":
        return "wi-rain-mix";
        break;
    case "wind":
        return "wi-strong-wind";
        break;
    case "fog":
        return "wi-fig";
        break;
    case "cloudy":
        return "wi-cloudy";
        break;
    case "partly-cloudy-day":
        return "wi-day-cloudy";
        break;
    case "partly-cloudy-night":
        return "wi-night-partly-cloudy";
        break;
    }
    return false;
}

/*
 * GET CURRENT CONDITIONS
 */
$condition = $forecast->getCurrentConditions($forecast_latitude, $forecast_longitude, $forecast_units, $forecast_lang);
echo '<p class="weather--now"><i class="weathericon wi '. converticon( $condition->getIcon() ) .'"></i></p>';
echo '<p class=""><i class="wi wi-thermometer"></i>'. $condition->getTemperature() .'°C </p>';
echo '<p class="">'. $condition->getSummary() .'</p>';
echo '<p class="">Gefühlte Temperatur: '. $condition->getApparentTemperature().'</p>';
echo '<p class="">Druck: '. $condition->getPressure() .' mb</p>';
echo '<p class="">Feuchtigkeit: '. ($condition->getHumidity()*100).'%<br />Windgeschwindigkeit: '. $condition->getWindSpeed() .'</p>';

/*
 * GET HOURLY CONDITIONS FOR TODAY
 */
$conditions_today = $forecast->getForecastToday($forecast_latitude, $forecast_longitude, $forecast_units, $forecast_lang);
echo '<table class="weather--next-hours"><tbody>';
foreach($conditions_today as $cond) {
    echo "<td>". $cond->getTime('H:i') . " Uhr<br />" . $cond->getTemperature() . "°C</td>";
}
echo '</tbody></table>';

/*
 * GET DAILY CONDITIONS FOR NEXT 7 DAYS
 */
$conditions_week = $forecast->getForecastWeek($forecast_latitude, $forecast_longitude, $forecast_units, $forecast_lang);

echo '<table class="weather--next-week"><tbody>';
foreach($conditions_week as $conditions) {
echo "<td>" . $conditions->getTime('D') . "<br /><i class='wi wi-up'></i> " . $conditions->getMaxTemperature() . "°C<br /><i class='wi wi-down'></i> " . $conditions->getMinTemperature() . "°C</td>";
}
echo '</tbody></table>';
?>
</div>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
