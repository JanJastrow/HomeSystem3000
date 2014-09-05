<?php

$token      = "qDWFFX4ZQVTcyv9aMTJabwghh";
$cpu_temperature_sensor_id      =       "bV9AxS";
$host       = "home.schwerkraftlabor.de";


//readout i2c ds18b20 sensor data
$dir = '/sys/bus/w1/devices';
$url_path = "http://$host/inc/sensor_values_submit.php";

$timestamp = mktime();
if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && $file != "w1_bus_master1") {
            $filepath = "$dir/$file/w1_slave";
            $myfile = file_get_contents($filepath, FILE_USE_INCLUDE_PATH);

            $temp =  explode("t=", $myfile);
            $temp = $temp['1'] / 1000;
            $temp = round($temp, 2);
            $date = date("d.m.Y - H:m:s", $timestamp);

            fopen("$url_path?token=$token&sensor_id=$file&sensor_value=$temp&timestamp=$timestamp","r");

        }
    }
    closedir($handle);
}

//readout raspi cpu temperature

$cpu_temperature = round(exec("cat /sys/class/thermal/thermal_zone0/temp ") / 1000, 1);

fopen("$url_path?token=$token&sensor_id=$cpu_temperature_sensor_id&sensor_value=$cpu_temperature&timestamp=$timestamp","r");

?>
