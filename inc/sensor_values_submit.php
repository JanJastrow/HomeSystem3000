<?php

$sec_token      =       "qDWFFX4ZQVTcyv9aMTJabwghh";

$token          =       $_GET['token'];

$sensor_value   =       $_GET['sensor_value'];
$sensor_id      =       $_GET['sensor_id'];
$timestamp      =       $_GET['timestamp'];

if($token == $sec_token)
{

$con=mysqli_connect("localhost","web836","eMGDvxo6","usr_web836_2");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$qry            =     "INSERT INTO sensor_values (value, sensor_id, timestamp)
VALUES ('$sensor_value', '$sensor_id','$timestamp')";

echo "200 OK";

mysqli_query($con,$qry);

mysqli_close($con);

}
else
{
    die("403 Forbidden");
}
?>