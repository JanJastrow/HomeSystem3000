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
$result = mysqli_query($con,"SELECT sensor_id from sensors where sensor_hardware_id = '$sensor_id'");
while($row = mysqli_fetch_array($result)) {

    $sensor_id     =       $row['sensor_id'];   



    //define the sql qry
    $qry            =     "INSERT INTO sensor_values (value, sensor_id, timestamp)
    VALUES ('$sensor_value', '$sensor_id','$timestamp')";
    echo $qry;
    
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