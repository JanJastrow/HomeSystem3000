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
$con=mysqli_connect($sql_server,$sql_username,$sql_password,$sql_db);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//define the sql qry
$qry            =     "INSERT INTO sensor_values (value, sensor_id, timestamp)
VALUES ('$sensor_value', '$sensor_id','$timestamp')";

//execute sql qry
mysqli_query($con,$qry);

//return http response code (only for usage in debugging purposes)
echo "200 OK";

//close mysql(i) connection
mysqli_close($con);
}
else
//if token are not matching, so give error code
{
    die("403 Forbidden");
}
?>