<h1>Sensoreinstellungen</h1>
<table class="sensors">
<tbody>
<?php

$sensor_id      =       $_GET['sensor_id'];

require('settings.inc.php');
require('mysql.inc.php');

$result = mysqli_query($con,"SELECT s.sensor_id, sensor_unit, name, sensor_hardware_id, description, status, sensor_group_id, sensor_html_color, sensor_symbol, sn.max_value, sn.min_value, sn.warning_value, sn.notification_status FROM sensors s join sensor_notifications sn on s.sensor_id = sn.sensor_id where s.sensor_id = '$sensor_id'");

while($row = mysqli_fetch_array($result)) {

    $sensor_id              =       $row['sensor_id'];
    $sensor_unit            =       $row['sensor_unit'];
    $sensor_name            =       $row['name'];
    $sensor_hardware_id     =       $row['sensor_hardware_id'];
    $sensor_description     =       $row['description'];
    $sensor_status          =       $row['status'];
    $sensor_group_id        =       $row['sensor_group_id'];
    $sensor_html_color      =       $row['sensor_html_color'];
    $sensor_symbol          =       $row['sensor_symbol'];
    $sensor_max_value       =       $row['max_value'];
    $sensor_min_value       =       $row['min_value'];
    $sensor_warning_value   =       $row['warning_value'];
    $sensor_notification    =       $row['notification_status'];

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
    <th colspan="2">
    <?
        echo $sensor_name;
    ?>
    </th>
</tr>
<tr>
    <td>Status:</td>
    <td>
        <select name="status">
        <option value="1" <? if($sensor_status=="1") { echo "selected"; } ?>>Aktiv</option>
        <option value="0" <? if($sensor_status=="0") { echo "selected"; } ?>>Inaktiv</option>
        </select>
    </td>
</tr>
<tr>
    <td>Einheit:</td>
    <td><input type="text" value="<? echo $sensor_unit ?>" /></td>
</tr>
<tr>
    <td>Name:</td>
    <td><input type="text" value="<? echo $sensor_name ?>" /></td>
</tr>
<tr>
    <td>Hardware-ID:</td>
    <td><input type="text" value="<? echo $sensor_hardware_id ?>" /></td>
</tr>
<tr>
    <td>Beschreibung:</td>
    <td><input type="text" value="<? echo $sensor_description ?>" /></td>
</tr>
<tr>
    <td>Gruppe:</td>
    <td>
        <select name="sensor_group_id">
            <?
            $group_result = mysqli_query($con,"select sensor_group_id, group_name from sensor_groups where status = '1'");
            
            while($group_row = mysqli_fetch_array($group_result)) {  
                
                $sensor_group_num       =       $group_row['sensor_group_id'];
                $sensor_group_name      =       $group_row['group_name'];
                
             ?><option value="<? echo $sensor_group_id ?>"<? if($sensor_group_id == $sensor_group_num) { echo "selected"; } ?>><? echo $sensor_group_name ?></option>  
            <?
            }
            ?>
        </select>
    </td>
</tr>
<?php
}
?>
</tbody>
</table>

</div>
