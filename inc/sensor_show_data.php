<?php
$limit_24h      =       (1440/$sensor_int);
$limit_12h      =       (720/$sensor_int);
$limit_2h       =       (120/$sensor_int);
?>
<h1>Temperaturüberwachung</h1>

<script type="text/javascript">
<? include("graph_generate_data.php"); ?>
var options = {
    xaxis: {
        mode: "time",
        timezone: "browser",
        tickLength: 0,
        axisLabel: "Zeitraum",
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 12,
        axisLabelFontFamily: 'Open Sans, Verdana, Arial',
        axisLabelPadding: 10,
        color: "black"
    },
    yaxes: [{
            position: "right",
            color: "black",
            axisLabel: "Temperatur",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Open Sans, Verdana, Arial'
        }],
    /*legend: {
        noColumns: 1,
        labelBoxBorderColor: "#000000",
        position: "nw"
        container:$("#flot-legend"),
    },*/
    legend:{
        container: $("#flot-legend"),
        noColumns: 0,
        position: "nw",
        show: true,
    },
    grid: {
        hoverable: true,
        borderWidth: 2,
        backgroundColor: { colors: ["#ffd8d8","#fffde4", "#ffffff"] }
    }
};


    $.plot($("#flot-container #flot-placeholder"),
        [
            {label:"Raspberry Pi CPU Temperatur", data:data1},
            {label:"Balkon (Schatten)", data:data2},
        ],
        options
    );

/*
$(document).ready(function () {
    $.plot($("#flot-placeholder"), dataset, options);
    $("#flot-placeholder").UseTooltip();
});
*/
</script>
<article class="getdata">
    <form class="newdata" action="index.php?site=sensor_show_data" method="GET">
        <p>Zeige die letzten</p>
        <input class="newdata--enter" type="number" name="limit" value="30" />
        <p>Werte.</p>
        <input type="hidden" name="site" value="sensor_show_data" />
        <input class="newdata--submit" type="submit" name="submit" value="Aktualisieren" />
    </form>
</article>
<article>
    <ul class="last">
        <li><a href="?site=sensor_show_data&limit=<?php echo $limit_24h ?>">Zeige die letzten 24h</a></li>
        <li><a href="?site=sensor_show_data&limit=<?php echo $limit_12h ?>">Zeige die letzten 12h</a></li>
        <li><a href="?site=sensor_show_data&limit=<?php echo $limit_2h ?>">Zeige die letzten 2h</a></li>
    </p>
</article>
<style type="text/css">
#flot-legend {
    background-color: #dddddd;
    padding: 4px;
    margin-bottom: 8px;
    border-radius: 3px;
    border: 1px solid #E6E6E6;
    display: inline-block;
    margin: 0.8em auto;
}
</style>
<div id="flot-container">
    <div id="flot-legend"></div>
    <div id="flot-placeholder"></div>
</div>
