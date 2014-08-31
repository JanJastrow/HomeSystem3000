<script>
<? include("graph_generate_data.php"); ?>
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

<div id="flot-placeholder"></div>
