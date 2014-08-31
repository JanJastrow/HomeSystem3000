/*

/js/vars.js

*/
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
    legend: {
        noColumns: 1,
        labelBoxBorderColor: "#000000",
        position: "nw"
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



var previousPoint = null, previousLabel = null;

$.fn.UseTooltip = function () {
    $(this).bind("plothover", function (event, pos, item) {
        if (item) {
            if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                previousPoint = item.dataIndex;
                previousLabel = item.series.label;
                $("#tooltip").remove();

                //console.log(item.datapoint);
                var x = item.datapoint[0];
                var y = item.datapoint[1];
                var d = new Date(x);

                var curr_date   =   d.getDate();
                var curr_month  =   d.getMonth() + 1; //Months are zero based
                var curr_year   =   d.getFullYear();

                var curr_hour   =   d.getHours();
                var curr_min    =   d.getMinutes();
                var curr_sec    =   d.getSeconds();

                d = (curr_date + "." + curr_month + "." + curr_year +" - " + curr_hour +":"+ curr_min +":"+ curr_sec );

                var color = item.series.color;


                //console.log(item);
                var unit = "°C";

                showTooltip(item.pageX, item.pageY, color,
                            "<strong>" + item.series.label + "</strong><br>" + d +
                            " : <strong>" + y + "</strong> °C");
            }
        } else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
};

function showTooltip(x, y, color, contents) {
    $('<div id="tooltip">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y - 40,
        left: x - 120,
        border: '2px solid ' + color,
        padding: '3px',
        'font-size': '9px',
        'border-radius': '5px',
        'background-color': '#fff',
        'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
        opacity: 0.9
    }).appendTo("body").fadeIn(200);
}
