<?php

//include settings file
require 'settings.inc.php';

//get the given token
$token          =       $_GET['token'];

//check if given token matches with defined token (for secruity)
if($token == $sec_token)
{

//define some other vars
$sensor_value   =       $_GET['sensor_value'];
$sensor_id      =       $_GET['sensor_id'];
$timestamp      =       $_GET['timestamp'];

//establish sql connection
require('mysql.inc.php');

//get sensor_id via hardware_id
$sensor_id_qry  =       "";

//fetch sensor_id
$result = mysqli_query($con,"SELECT * from sensors join sensor_notifications on sensors.sensor_id = sensor_notifications.sensor_id where sensor_hardware_id = '$sensor_id'");
while($row = mysqli_fetch_array($result)) {

    $sensor_id              =       $row['sensor_id'];
    $sensor_name            =       $row['name'];
    $sensor_unit            =       $row['sensor_unit'];
    $sensor_max_value       =       $row['max_value'];
    $sensor_min_value       =       $row['min_value'];
    $sensor_warning_value   =       $row['warning_value'];
    $notification_status    =       $row['notification_status'];   

    //define the sql qry
    $qry                    =       "INSERT INTO sensor_values (value, sensor_id, timestamp) VALUES ('$sensor_value', '$sensor_id','$timestamp')";

    
    //send pushover request
    if($notification_status = '1')
    {
        require('lib/pushover.php');
        
        //send push notification if value is under defined warning value
        if($sensor_value < $sensor_min_value)
        {
            $push = new Pushover();
            
            $push->setToken($pushover['appkey']);
            $push->setUser($pushover['userkey']);
            
            $push->setTitle("$project_title Temperatur zu niedrig");
            $push->setMessage("$sensor_name hat den minimalen Temperaturwert unterschritten! Aktueller Wert: $sensor_value $sensor_unit");
            $push->setUrl('http://home.mysash.de/index.php?site=sensor_show_data');
            $push->setUrlTitle('Sensorenübersicht');
            
            $push->setDevice('');
            $push->setPriority(1);
            $push->setRetry(60); 
            $push->setExpire(3600); 
            $push->setCallback('http://home.mysash.de/');
            $push->setTimestamp(time());
            $push->setDebug(true);
            $push->setSound('bike');
            
            $go = $push->send();
        }
        
        //send push notification if value is over defined warning value
        elseif($sensor_value > $sensor_warning_value && $sensor_value < $sensor_max_value)
        {
            $push = new Pushover();
            
            $push->setToken($pushover['appkey']);
            $push->setUser($pushover['userkey']);
            
            $push->setTitle("$project_title Temperatur über Warnwert");
            $push->setMessage("$sensor_name hat den definierten Warnwert überschritten! Aktueller Wert: $sensor_value $sensor_unit");
            $push->setUrl('http://home.mysash.de/index.php?site=sensor_show_data');
            $push->setUrlTitle('Sensorenübersicht');
            
            $push->setDevice('');
            $push->setPriority(1);
            $push->setRetry(60); 
            $push->setExpire(3600); 
            $push->setCallback('http://home.mysash.de/');
            $push->setTimestamp(time());
            $push->setDebug(true);
            $push->setSound('bike');
            
            $go = $push->send();
        }
        
        //send push notification if value is over defined maximum value
        elseif($sensor_value > $sensor_max_value)
        {
            $push = new Pushover();
            
            $push->setToken($pushover['appkey']);
            $push->setUser($pushover['userkey']);
            
            $push->setTitle("$project_title Temperatur zu hoch");
            $push->setMessage("$sensor_name hat den maximalen Temperaturwert überschritten! Aktueller Wert: $sensor_value $sensor_unit");
            $push->setUrl('http://home.mysash.de/index.php?site=sensor_show_data');
            $push->setUrlTitle('Sensorenübersicht');
            
            $push->setDevice('');
            $push->setPriority(1);
            $push->setRetry(60); 
            $push->setExpire(3600); 
            $push->setCallback('http://home.mysash.de/');
            $push->setTimestamp(time());
            $push->setDebug(true);
            $push->setSound('bike');
            
            $go = $push->send();
        }
    }
    
    //execute sql qry
    mysqli_query($con,$qry);
    
    //return http response code (only for usage in debugging purposes)
    echo "200 OK";
    
    //close mysql(i) connection
    mysqli_close($con);
}
}
else
//if token are not matching, so give error code
{
    die("403 Forbidden");
}
?>