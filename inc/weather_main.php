<h1>Wetter</h1>
<div class="weather">
<?php
include('inc/lib/forecast.io.php');
$forecast = new ForecastIO($forecast_api_key);

/*
 * GET CURRENT CONDITIONS
 */
$condition = $forecast->getCurrentConditions($forecast_latitude, $forecast_longitude, $forecast_units, $forecast_lang);
echo '<p class="weather--now"><i class="wi wi-thermometer"></i>'. $condition->getTemperature() .'°C </p>';
echo '<p class="">'. $condition->getSummary() .'<br />'. $condition->getIcon() .'</p>';
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
$conditions_week = $forecast->getForecastWeek($forecast_latitude, $forecast_longitude);

echo '<table class="weather--next-week"><tbody>';
foreach($conditions_week as $conditions) {
echo "<td>" . $conditions->getTime('D') . "<br /><i class='wi wi-up'></i> " . $conditions->getMaxTemperature() . "°C<br /><i class='wi wi-down'></i> " . $conditions->getMinTemperature() . "°C</td>";
}
echo '</tbody></table>';

/*
 * GET HISTORICAL CONDITIONS
 */
$condition = $forecast->getHistoricalConditions($forecast_latitude, $forecast_longitude, strtotime('2010-10-10T14:00:00-0700'));
// strtotime('2010-10-10T14:00:00-0700') gives timestamp for Pacfic Time... DST shouldn't matter since should be same day
echo "<div>";
echo $condition->getMaxTemperature();
echo "</div>";
?>
</div>
