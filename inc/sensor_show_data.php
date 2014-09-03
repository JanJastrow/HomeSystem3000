<h1>Temperaturüberwachung</h1>


<script type="text/javascript">
<? include("graph_generate_data.php"); ?>
var options = {
    xaxis: {
        mode: "time",
        timezone: "browser",
        tickLength: 0,
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 12,
        axisLabelFontFamily: 'Verdana, Arial',
        axisLabelPadding: 10,
        color: "black"
    },
    yaxes: [{
            position: "right",
            color: "black",
            axisLabel: "Temperatur",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial'
        }],
    /*legend: {
        noColumns: 1,
        labelBoxBorderColor: "#000000",
        position: "nw"
        container:$("#flot-legend"),    
    },*/
legend:{         
            container:$("#flot-legend"),            
            noColumns: 0
        },    
    grid: {
        hoverable: true,
        borderWidth: 3,
        backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
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
        <li><a href="?site=sensor_show_data&limit=288">Zeige die letzten 24h</a></li>
        <li><a href="?site=sensor_show_data&limit=144">Zeige die letzten 12h</a></li>
        <li><a href="?site=sensor_show_data&limit=24">Zeige die letzten 2h</a></li>
    </p>
</article>
<style type="text/css">
#flotcontainer {
    width: 600px;
    height: 200px;
    text-align: left;
}

#flot-legend {
    background-color: #fff;
    padding: 2px;
    margin-bottom: 8px;
    border-radius: 3px 3px 3px 3px;
    border: 1px solid #E6E6E6;
    display: inline-block;
    margin: 0 auto;
}

</style>
<div id="flot-container">
    <div id="flot-placeholder"></div>
    <div id="flot-legend"></div>
</div>
