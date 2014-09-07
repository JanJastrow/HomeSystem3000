<?
$site_function      =       $_GET['function'];

require('settings.inc.php');
require('mysql.inc.php');

if(empty($site_function))
{
    $sensor_id      =       $_GET['sensor_id'];
?>
<script type="text/javascript" src="/js/jscolor.js"></script>
<h1>Sensoreinstellungen</h1>
<form method="POST" action="index.php?site=sensor_edit&function=save_settings&sensor_id=<?php echo $sensor_id ?>">
    <table class="sensors">
        <tbody>
        <?php

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
            <?php
                echo $sensor_name;
            ?>
            </th>
        </tr>
        <tr>
            <td>Status:</td>
            <td>
                <select name="sensor_status">
                    <option value="1" <?php if($sensor_status=="1") { echo "selected"; } ?>>Aktiv</option>
                    <option value="0" <?php if($sensor_status=="0") { echo "selected"; } ?>>Inaktiv</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Einheit:</td>
            <td><input name="sensor_unit" type="text" value="<?php echo $sensor_unit ?>" /></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input name="sensor_name" type="text" value="<?php echo $sensor_name ?>" /></td>
        </tr>
        <tr>
            <td>Hardware-ID:</td>
            <td><input name="sensor_hardware_id" type="text" value="<?php echo $sensor_hardware_id ?>" /></td>
        </tr>
        <tr>
            <td>Beschreibung:</td>
            <td><input name="sensor_description" type="text" value="<?php echo $sensor_description ?>" /></td>
        </tr>
        <tr>
            <td>Gruppe:</td>
            <td>
                <select name="sensor_group_id">
                    <?php
                    $group_result = mysqli_query($con,"select sensor_group_id, group_name from sensor_groups where status = '1'");

                    while($group_row = mysqli_fetch_array($group_result)) {

                        $sensor_group_num       =       $group_row['sensor_group_id'];
                        $sensor_group_name      =       $group_row['group_name'];

                     ?><option value="<?php echo $sensor_group_id ?>"<?php if($sensor_group_id == $sensor_group_num) { echo "selected"; } ?>><?php echo $sensor_group_name ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Linien-Farbe:</td>
            <td><input name="sensor_html_color" type="text" value="<?php echo $sensor_html_color  ?>" class="colorpicker"/></td>
        </tr>
        <tr>
            <td>Symbol:</td>
            <td>
                <select name="sensor_symbol">
                    <option value="circle" <?php if($sensor_symbol == "circle") { echo "selected"; } ?>>Kreis</option>
                    <option value="cross" <?php if($sensor_symbol == "cross") { echo "selected"; } ?>>Kreuz</option>
                    <option value="triangle" <?php if($sensor_symbol == "triangle") { echo "selected"; } ?>>Dreieck</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>maximum Wert:</td>
            <td><input name="sensor_max_value" type="number" value="<?php echo $sensor_max_value ?>" /></td>
        </tr>
        <tr>
            <td>Warnungs-Wert:</td>
            <td><input name="sensor_warning_value" type="number" value="<?php echo $sensor_warning_value ?>" /></td>
        </tr>
        <tr>
            <td>minimum Wert:</td>
            <td><input name="sensor_min_value" type="number" value="<?php echo $sensor_min_value ?>" /></td>
        </tr>
        <tr>
            <td>Benachrichtigungen:</td>
            <td>
                <select name="sensor_notification_status">
                <option value="1" <?php if($sensor_notification == "1") { echo "selected"; } ?>>Aktiv</option>
                <option value="0" <?php if($sensor_notification == "0") { echo "selected"; } ?>>Inaktiv</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Speichern"/></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</form>
<?php
}
elseif($site_function == "save_settings")
{
    //get new values from the form
    $sensor_id              =       $_GET['sensor_id'];
    $sensor_unit            =       $_POST['sensor_unit'];
    $sensor_name            =       $_POST['sensor_name'];
    $sensor_hardware_id     =       $_POST['sensor_hardware_id'];
    $sensor_description     =       $_POST['sensor_description'];
    $sensor_status          =       $_POST['sensor_status'];
    $sensor_group_id        =       $_POST['sensor_group_id'];
    $sensor_html_color      =       $_POST['sensor_html_color'];
    $sensor_symbol          =       $_POST['sensor_symbol'];
    $sensor_max_value       =       $_POST['sensor_max_value'];
    $sensor_min_value       =       $_POST['sensor_min_value'];
    $sensor_warning_value   =       $_POST['sensor_warning_value'];
    $sensor_notification    =       $_POST['sensor_notification_status'];

    //validation of the values and sql escape
    //comes later...

    //sql qry
    $update_qry             =
    "update sensors s
    inner join sensor_notifications sn on
    s.sensor_id = sn.sensor_id
    set
    s.sensor_unit = '$sensor_unit',
    s.name = '$sensor_name',
    s.sensor_hardware_id = '$sensor_hardware_id',
    s.description = '$sensor_description',
    s.status = '$sensor_status',
    s.sensor_group_id = '$sensor_group_id',
    s.sensor_html_color = '$sensor_html_color',
    s.sensor_symbol = '$sensor_symbol',
    sn.max_value = '$sensor_max_value',
    sn.min_value = '$sensor_min_value',
    sn.warning_value = '$sensor_warning_value',
    sn.notification_status = '$sensor_notification'
    where s.sensor_id = '$sensor_id' and sn.sensor_id = '$sensor_id'";

    mysqli_query($con,$update_qry);

    mysqli_close($con);
?>
<h1>Daten wurden gespeichert.</h1>

<p>
    <a href="?site=management_sensors">Zurück zur Sensorenverwaltung</a>
</p>
<?
}
elseif($site_function == "reset_data")
{
    $sensor_id          =       $_GET['sensor_id'];

    //sql query to delete all sensor data from sensor_values
    $delete_qry         =
    "DELETE FROM sensor_values WHERE 'sensor_id' = $sensor_id ";

    mysqli_query($con,$delete_qry);

    mysqli_close($con);
?>
<h1>Alle Sensormesswerte wurden gelöscht.</h1>

<p>
    <a href="?site=management_sensors">Zurück zur Sensorenverwaltung</a>
</p>
<?
}
elseif($site_function == "change_status")
{
    $sensor_id          =       $_GET['sensor_id'];
    $sensor_status      =       $_GET['sensor_status'];

    if($sensor_status == "1")
    {
        $sensor_new_status  =   "0";
        $sensor_mode_changed    =   "deaktiviert";
    }
    elseif($sensor_status == "0")
    {
        $sensor_new_status  =   "1";
        $sensor_mode_changed    =   "aktiviert";
    }

    //sql query to change status of the sensor
    $change_qry         =
    "update sensors set status = '$sensor_new_status' where sensor_id = '$sensor_id'";

    mysqli_query($con,$change_qry);

    mysqli_close($con);
?>
<h1>Der Sensor wurde <?php echo $sensor_mode_changed ?>.</h1>

<p>
    <a href="?site=management_sensors">Zurück zur Sensorenverwaltung</a>
</p>
<?
}
elseif($site_function == "delete")
{
    $sensor_id          =       $_GET['sensor_id'];

    //sql query to delete the sensor
    $delete_qry         =       "delete from sensors where sensor_id = '$sensor_id'";
    mysqli_query($con,$delete_qry);

    //sql query to delete the sensor
    $delete_qry         =       "delete from sensors_notifications where sensor_id = '$sensor_id'";
    mysqli_query($con,$delete_qry);

    //sql query to delete the sensor
    $delete_qry         =       "delete from sensors_values where sensor_id = '$sensor_id'";
    mysqli_query($con,$delete_qry);

    //mysqli_close($con);
?>
<h1>Der Sensor wurde erfolgreich gelöscht.</h1>

<p>
    <a href="?site=management_sensors">Zurück zur Sensorenverwaltung</a>
</p>
<?
}
elseif($site_function == "create")
{
?>

<script type="text/javascript" src="/js/jscolor.js"></script>
<h1>Sensor erstellen</h1>
<form method="POST" action="?site=sensor_edit&function=create_sensor">
    <table class="sensors">
        <tbody>
        <tr>
            <td>Status:</td>
            <td>
                <select name="sensor_status">
                    <option value="1" selected="selcted">Aktiv</option>
                    <option value="0">Inaktiv</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Einheit:</td>
            <td><input name="sensor_unit" type="text" value="°C" /></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input name="sensor_name" type="text" value="" /></td>
        </tr>
        <tr>
            <td>Hardware-ID:</td>
            <td><input name="sensor_hardware_id" type="text" value="" /></td>
        </tr>
        <tr>
            <td>Beschreibung:</td>
            <td><input name="sensor_description" type="text" value="" /></td>
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

                     ?><option value="<?php echo $sensor_group_num ?>"><?php echo $sensor_group_name ?></option>
                    <?
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Linien-Farbe:</td>
            <td><input name="sensor_html_color" type="text" value="" class="colorpicker"/></td>
        </tr>
        <tr>
            <td>Symbol:</td>
            <td>
                <select name="sensor_symbol">
                    <option value="circle">Kreis</option>
                    <option value="cross">Kreuz</option>
                    <option value="triangle">Dreieck</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>maximum Wert:</td>
            <td><input name="sensor_max_value" type="number" value="" /></td>
        </tr>
        <tr>
            <td>Warnungs-Wert:</td>
            <td><input name="sensor_warning_value" type="number" value="" /></td>
        </tr>
        <tr>
            <td>minimum Wert:</td>
            <td><input name="sensor_min_value" type="number" value="" /></td>
        </tr>
        <tr>
            <td>Benachrichtigungen:</td>
            <td>
                <select name="sensor_notification_status">
                <option value="1" selected="selected">Aktiv</option>
                <option value="0">Inaktiv</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Sensor erstellen"/></td>
        </tr>
        </tbody>
    </table>
</form>
<?
}
elseif($site_function == "create_sensor")
{
    //get new values from the form
    $sensor_unit            =       $_POST['sensor_unit'];
    $sensor_name            =       $_POST['sensor_name'];
    $sensor_hardware_id     =       $_POST['sensor_hardware_id'];
    $sensor_description     =       $_POST['sensor_description'];
    $sensor_status          =       $_POST['sensor_status'];
    $sensor_group_id        =       $_POST['sensor_group_id'];
    $sensor_html_color      =       $_POST['sensor_html_color'];
    $sensor_symbol          =       $_POST['sensor_symbol'];
    $sensor_max_value       =       $_POST['sensor_max_value'];
    $sensor_min_value       =       $_POST['sensor_min_value'];
    $sensor_warning_value   =       $_POST['sensor_warning_value'];
    $sensor_notification    =       $_POST['sensor_notification_status'];

    //validation of the values and sql escape
    //comes later...

    //sql qry
    $insert_qry             =       "
    INSERT INTO sensors
    (
         `sensor_id`,
         `sensor_unit`,
         `name`,
         `sensor_hardware_id`,
         `description`,
         `status`,
         `sensor_group_id`,
         `sensor_html_color`,
         `sensor_symbol`
    )
        VALUES
    (
        NULL,
        '$sensor_unit',
        '$sensor_name',
        '$sensor_hardware_id',
        '$sensor_description',
        '$sensor_status',
        '$sensor_group_id',
        '$sensor_html_color',
        '$sensor_symbol'
    );";

    $qry            =       mysqli_query($con,$insert_qry);

    //get ai id from qry back
    $sensor_id      =       mysqli_insert_id($con);

    //sql qry
    $insert_qry             =       "
    INSERT INTO sensor_notifications
    (
         `sensor_id`,
         `max_value`,
         `min_value`,
         `warning_value`,
         `notification_status`
    )
        VALUES
    (
        '$sensor_id',
        '$sensor_max_value',
        '$sensor_min_value',
        '$sensor_warning_value',
        '$sensor_notification'
    );";


    //insert second part of data
    $qry       =       mysqli_query($con,$insert_qry);


    mysqli_close($con);
?>
<h1>Der Sensor wurde erfolgreich erstellt.</h1>

<p>
    <a href="?site=management_sensors">Zurück zur Sensorenverwaltung</a>
</p>
<?
}
?>
