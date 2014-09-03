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

$(document).ready(function () {
    $.plot($("#flot-placeholder"), dataset, options);
    $("#flot-placeholder").UseTooltip();
});
</script>
<article class="getdata">
    <form class="newdata" action="?site=sensor_show_data" method="GET">
        <p>Zeige letzte</p>
        <input class="newdata--enter" type="number" name="limit" value="30" />
        <p>Werte.</p>
        <input type="hidden" name="site" value="sensor_show_data" />
        <input class="newdata--submit" type="submit" name="submit" value="Aktualisieren" />
    </form>
</article>
<article>
    <ul class="last">
        <li><a href="?site=sensor_show_data&limit=96">Zeige die letzten 24h</a></li>
        <li><a href="?site=sensor_show_data&limit=48">Zeige die letzten 12h</a></li>
        <li><a href="?site=sensor_show_data&limit=8">Zeige die letzten 2h</a></li>
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
