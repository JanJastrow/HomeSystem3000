<?php

/**
 * @company gering.it
 * @author Sascha Gering ($email)
 * @copyright 2014
 * @date 21:29 - 29.8.2014
 * @project Kein Projekt geladen
 */

require 'settings.inc.php';

?>
var dataset = 
[
<?
$limit = $_GET['limit'];

if (empty ($_GET['limit'])) {
    $limit = 30;
} else {
    $limit = $_GET['limit'];
}

$con=mysqli_connect($sql_server,$sql_username,$sql_password,$sql_db);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$x = 1;
$y = 1;

$result = mysqli_query($con,"SELECT name, sensor_1w_id, sensor_html_color, sensor_symbol FROM sensors WHERE status = '1'");
$sensors_num = mysqli_num_rows($result);

while($row = mysqli_fetch_array($result)) {
    
    $sensor_name        =       $row['name'];
    $sensor_1w_id       =       $row['sensor_1w_id'];
    $sensor_html_color  =       $row['sensor_html_color'];
    $sensor_symbol      =       $row['sensor_symbol'];

    ?>
     {
        label: "<? echo $sensor_name ?>",
        data:[<?
    
    $result1 = mysqli_query($con,"SELECT value, timestamp FROM sensor_values WHERE sensor_id = '$sensor_1w_id' order by value_id desc limit $limit");
    $value_count = mysqli_num_rows($result1);
    
    
    while($row1 = mysqli_fetch_array($result1)) 
    {
        $timestamp = $row1['timestamp'];
        $timestamp = $timestamp * 1000;

        ?>[<? echo $timestamp ?>, <? echo $row1['value'] ?>]<?
        
        if($x <> $value_count)
        {
            echo ",";
        }
        $x++;
    }
    $x = 1;
 ?>
],
        yaxis: 1,
        color: "<? echo $sensor_html_color; ?>",
        points: { symbol: "<? echo $sensor_symbol ?>", fillColor: "<? echo $sensor_html_color; ?>", show: true },
        lines: { show: true }
    }
    <?
    if($y < $sensors_num)
    {
        echo ",";
    }

    ?>

 <?  
   $y++; 
}
mysqli_close($con);
?>
];
