<h1>Sensorverwaltung</h1>
<table class="sensors">
<?


require('settings.inc.php');
require('mysql.inc.php');

$result = mysqli_query($con,"SELECT sensor_id, name, status FROM sensors");
$sensors_num = mysqli_num_rows($result);

while($row = mysqli_fetch_array($result)) {

    $sensor_status      =       $row['status'];
    $sensor_name        =       $row['name'];
    $sensor_id          =       $row['sensor_id'];

    if($sensor_status == "1")
    {
        $sensor_indicator   =   "fa fa-circle sensors--status__green";
    }
    elseif($sensor_status == "0")
    {
        $sensor_indicator   =   "fa fa-circle-o sensors--status__red";
    }

?>
<tr>
    <td class="sensors--status"><i class="<? echo $sensor_indicator ?>"></i></td>
    <td class="sensors--name"><? echo $sensor_name ?></td>
    <td class="sensors--edit">
        <a href="?site=edit_sensor_settings&sensor_id=<? echo $sensor_id ?>"><i class="fa fa-pencil-square-o fa-2x"></i></a>
        <a href="?site=reset_sensor&sensor_id=<? echo $sensor_id ?>"><i class="fa fa-refresh fa-2x"></i></a>
        <a href="?site=deactivate_sensor&sensor_id=<? echo $sensor_id ?>"><i class="fa fa-power-off fa-2x"></i></a>
        <a href="?site=remove_sensor&sensor_id=<? echo $sensor_id ?>"><i class="fa fa-remove fa-2x"></i></a>
    </td>
</tr>
<?
}
?>
</table>
<div class="sensors--add">
<p>
    <a href="?site=add_sensor"><i class="fa fa-plus-square"></i>neuen Sensor erstellen</a>
</p>
</div>
