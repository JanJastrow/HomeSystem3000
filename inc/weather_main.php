<h1>Wetter</h1>
<div class="weather">
<?php
include('inc/lib/forecast.io.php');
$forecast = new ForecastIO($forecast_api_key);


function converticon($icon = 'wi-day-cloudy') {
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
function windDir($winddir)
// Given the wind direction, return the text label
// for that value.  16 point compass
{
      if (!isset($winddir)) {
        return "---";
      }
    $windlabel = array ("N","NNO", "NO", "ONO", "O", "OSO", "SO", "SSO", "S",
       "SSW","SW", "WSW", "W", "WNW", "NW", "NNW");
    $dir = $windlabel[ fmod((($winddir + 11) / 22.5),16) ];
    return "$dir";
}

/*
 * GET CURRENT CONDITIONS
 */
$condition = $forecast->getCurrentConditions($forecast_latitude, $forecast_longitude, $forecast_units, $forecast_lang);

echo '
<table class="weather">
<tbody>
<tr>
    <td class="weather--icon"><i class="weathericon wi '. converticon( $condition->getIcon() ) .'"></i></td>
    <td class="weather--meta"><p class="weather--temp">'. $condition->getTemperature() .'<i class="wi wi-celsius"></i></p><br /><p class="weather--text">'. $condition->getSummary() .'</p></td>
</tr>
<tr>
    <td class="weather--descr">Luftdruck</td>
    <td class="weather--descr">Luftfeuchtigkeit</td>
</tr>
<tr>
    <td>'. $condition->getPressure() .'mb</td>
    <td>'. ($condition->getHumidity()*100).'%</td>
</tr>
<tr>
    <td class="weather--descr">Windgeschwindigkeit</td>
    <td class="weather--descr">Windrichtung</td>
</tr>
<tr>
    <td>'. $condition->getWindSpeed() .'km/h</td>
    <td>'. windDir($condition->getWindBearing()) .'</td>

</tr>
<tr>
    <td class="weather--descr">Regenwahrsch.</td>
    <td class="weather--descr">Taupunkt</td>
</tr>
<tr>
    <td>'. $condition->getPrecipitationProbability() .'%</td>
    <td>'. $condition->getDewPoint() .'<i class="wi wi-celsius"></i></td>
</tr>
</tbody>
</table>';

/*
 * GET HOURLY CONDITIONS FOR TODAY


$conditions_today = $forecast->getForecastToday($forecast_latitude, $forecast_longitude, $forecast_units, $forecast_lang);
echo '<table class="weather--next-hours"><tbody>';
foreach($conditions_today as $cond) {
    echo "<td>". $cond->getTime('H:i') . "&nbsp;Uhr<br />" . $cond->getTemperature() . "°C</td>";
}
echo '</tbody></table>';
 */

/*
 * GET DAILY CONDITIONS FOR NEXT 7 DAYS
 */
$conditions_week = $forecast->getForecastWeek($forecast_latitude, $forecast_longitude, $forecast_units, $forecast_lang);

echo '<table class="weather weather--next-week"><tbody>';
foreach($conditions_week as $conditions) {
echo "<td>" . $conditions->getTime('D') . "<br /><i class='wi wi-up'></i> " . $conditions->getMaxTemperature() . "°C<br /><i class='wi wi-down'></i> " . $conditions->getMinTemperature() . "°C</td>";
}
echo '</tbody></table>';
?>
</div>
