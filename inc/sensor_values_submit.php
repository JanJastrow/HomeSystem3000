<?php
require 'settings.inc.php';

$token          =       $_GET['token'];

$sensor_value   =       $_GET['sensor_value'];
$sensor_id      =       $_GET['sensor_id'];
$timestamp      =       $_GET['timestamp'];

if($token == $sec_token)
{

$con=mysqli_connect($sql_server,$sql_username,$sql_password,$sql_db);
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