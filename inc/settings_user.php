<h1>Einstellungen</h1>
<table class="settings__user" border="1"><tbody>
<?php

require('settings.inc.php');
require('mysql.inc.php');

if (!empty($_POST) && $debugmode == TRUE) {
    echo '<p class="msg__inline debug">';
    var_dump($_POST);
    echo '</p>';
}

?>
<form action="index.php?site=settings_user" method="POST">
<tr>
    <td colspan="2">Notifications</td>
</tr>
<tr>
    <td>Sensoren Überhitzung</td>
    <td><input type="checkbox" name="sensors__toohigh" value="1"></td>
</tr>
<tr>
    <td>Sensoren Unterkühlung</td>
    <td><input type="checkbox" name="sensors__toolow" value="1"></td>
</tr>
<tr>
    <td>Wetter – Morgen Regen</td>
    <td><input type="checkbox" name="weather_rain" value="1"></td>
</tr>
<tr>
    <td>Wetter – Morgen unter X °C</td>
    <td><input type="checkbox" name="weather_cold" value="1"></td>
</tr>
<tr>
    <td colspan="2"><input type="submit" value="Speichern" /></td>
</tr>
</tbody></table>
