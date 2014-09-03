<?php

require 'settings.inc.php';

?>
var dataset =
[
<?
if (empty ($_GET['limit'])) {
    $limit = 30;
} else {
    $limit = $_GET['limit'];
}

require('mysql.inc.php');

$x = 1;
$y = 1;

$result = mysqli_query($con,"SELECT name, sensor_id, sensor_html_color, sensor_symbol FROM sensors WHERE status = '1'");
$sensors_num = mysqli_num_rows($result);

while($row = mysqli_fetch_array($result)) {

    $sensor_name        =       $row['name'];
    $sensor_id          =       $row['sensor_id'];
    $sensor_html_color  =       $row['sensor_html_color'];
    $sensor_symbol      =       $row['sensor_symbol'];

    ?>
     {
        label: "<? echo $sensor_name ?>",
        data:[<?

    $result1 = mysqli_query($con,"SELECT value, timestamp FROM sensor_values WHERE sensor_id = '$sensor_id' order by value_id desc limit $limit");
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
